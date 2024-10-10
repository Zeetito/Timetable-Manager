<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Course;
use App\Models\Program;
use App\Models\RoleUser;
use App\Models\Semester;
use App\Models\ClassGroup;
use App\Models\CourseUser;
use App\Models\SemesterUser;
use App\Models\CourseSchedule;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Resources\UserResource;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'firstname',
        'othername',
        'lastname',
        'gender',
        'identity_number',
        'index_number',
        'is_staff',
        // 'program_id',
        'class_group_id', 
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Appended attributes
    protected $appends = [
        'semester_id',
        'stream',
        // 'class_name'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Override the toArray method
    public function toArray()
    {
        // Use UserResource to transform the model's array
        return (new UserResource($this))->resolve();
    }

    // Override the toJson method
    public function toJson($options = 0)
    {
        // Use UserResource to transform the model's JSON representation
        return (new UserResource($this))->toJson($options);
    }

    // ATTRIBUTES
        // Get User Semester Attribute
        public function getSemesterIdAttribute()
        {
            return $this->user_semester()->id;
        }

        // Get stream Attribute
        public function getStreamAttribute()
        {
            return $this->class_group? $this->class_group->program_stream->type: null;
        }

        // Get registeredCoursesAttribute
        public function getRegisteredCoursesAttribute()
        {
            return $this->registered_courses_forSem();
        }

        // Get registered Credit hours
        public function getRegisteredCreditHoursAttribute()
        {
            return $this->registered_courses_forSem()->sum('credit_hour');
        }

        // Get department attribute
        public function getDepartmentAttribute()
        {

            if($this->is_staff){

                return $this->course() ? $this->course()->department : null;
            }else{

                return $this->program->department;
            }

        }

        // Get roleLevel
        public function getRoleLevelAttribute()
        {
            return $this->role ? $this->role->level : ($this->is_staff? 1 : 0);
        }

        protected function className(): Attribute
        {
            return Attribute::make(
                get: fn () => $this->get_classgroup_slug_name()
            );
        }

        


    // RELATIONSHIPS
        // RoleUser
        public function role_users()
        {
            return $this->hasOne(RoleUser::class, 'user_id');
        }

        // Roles
        public function role()
        {
            return $this->hasOneThrough(Role::class, RoleUser::class, 'user_id', 'id', 'id', 'role_id');
        }


        // Program
        public function getProgramAttribute()
        {
            return $this->class_group ? $this->class_group->program : null;
        }

        // ClassGroup
        public function class_group()
        {
            return $this->belongsTo(ClassGroup::class, 'class_group_id');
        }
        // ClassGroup
        public function classGroup()
        {
            return $this->belongsTo(ClassGroup::class);
        }

        // SemesterUser instances
        public function semester_user(){
           return $this->hasOne(SemesterUser::class,'user_id');
        }

        // User Semester - Current semester of user
        public function user_semester(){
            $instance = SemesterUser::where('user_id',$this->id)->first();

            if($instance){
                return $instance->semester;
            }else{
                return Semester::getActiveSemester();
            }
        }


        // Department
        public function department()
        {
            return $this->program->department;
        }

        // College
        public function college(){

            return $this->program->college;
        }



        // Course -- this applies to Staff
        public function course()
        {
            return Course::whereIn('id', CourseUser::where('user_id', $this->id)->pluck('course_id'))->first();
        }

        // FUNCTIONS
         // Get User Registered courses Courses
         public function registered_courses_forSem(){
            return Course::whereIn('id', CourseUser::where('user_id', $this->id)->pluck('course_id'))->get();
        }

        // Get ClassName Attribute
        public function get_classgroup_slug_name()
        {   
        
            // If the user is a staff member, return "None"
            if ($this->is_staff) {
                return "None";
            }

            if(!$this->program){
                return null;
            }
            // Split the text into words
            $words = explode(' ', $this->program->name);
                
            // Extract and concatenate the first letter of each word
            $firstLetters = '';
            foreach ($words as $word) {
                $firstLetters .= substr($word, 0, 1);
            }
            
            $result = substr($firstLetters, 1); 
        
            // Check if the class group is divided
            if ($this->class_group->is_divided == 1) {
                // Get the name of the division that contains the current user's ID
                $division = $this->class_group->divisions->whereIn('users_id', $this->id)->first();
                
                // If the division is found, return the full class name with division name
                if ($division) {
                    return $result.$this->class_group->year . '-' . $division->name;
                }
            }
            
            // Return the class name without division
            return $result . $this->class_group->year;
        }

    // STATIC FUNCTIONS

        // Get all staff
        public static function staff()
        {
            return self::where('is_staff', 1);
        }

        // Get all Students
        public static function students(){
            return self::where('is_staff',0);
        }

        // Get Regular Students
        public static function regular_students(){
            return User::students()->get()->filter(function ($user) {
                return $user->stream == 'regular';
            });
        }

        public static function idl_students(){
            return User::students()->get()->filter(function ($user) {
                return $user->stream == 'idl';
            });
        }

        public static function parallel_students(){
            return User::students()->get()->filter(function ($user) {
                return $user->stream == 'parallel';
            });
        }

        // CourseSchedule instances
        public function course_schedules(){
            return CourseSchedule::whereBelongsTo($this->registered_courses)->get();
        }

        // Get all Idl Students
        // public static function idl_students(){
        //     return self::whereIn('class_group_id',ClassGroup::idl_class_groups()->pluck('id'))->get();
        // }
    
}
