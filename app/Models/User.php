<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Course;
use App\Models\Program;
use App\Models\Semester;
use App\Models\ClassGroup;
use App\Models\CourseUser;
use App\Models\SemesterUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
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
        'program_id',
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
        'semester_id'
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

    // ATTRIBUTES
        // Get User Semester Attribute
        public function getSemesterIdAttribute()
        {
            return $this->semester_user()->id;
        }

        // Get registeredCoursesAttribute
        public function getRegisteredCoursesAttribute()
        {
            return $this->registered_courses();
        }

        // Get registered Credit hours
        public function getRegisteredCreditHoursAttribute()
        {
            return $this->registered_courses()->sum('credit_hour');
        }


    // RELATIONSHIPS

        // Program
        public function program()
        {
            return $this->belongsTo(Program::class);
        }

        // ClassGroup
        public function class_group()
        {
            return $this->belongsTo(ClassGroup::class);
        }

        // SemesterUser
        public function semester_user(){
            $instance = SemesterUser::where('user_id',$this->id)->first();

            if($instance){
                return $instance->semester;
            }else{
                return Semester::getActiveSemester();
            }
        }

        // Get User Registered courses Courses
        public function registered_courses(){
            return Course::whereIn('id', CourseUser::where('user_id', $this->id)->pluck('course_id'))->get();
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

    
}
