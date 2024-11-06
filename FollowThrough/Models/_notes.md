###

## Auth User is user 1 or two.

## User Class
    How would you get the department of a staff?
    Department_id is also needed on users table for that

## Semester Scope:
    There should be auth()->user() function instead of User::find(1) function.

## Course User
    After every semester, the instances for staff would have their semester_id updated to the next active semester's id. Just becaues staff don't have to do registration.

## Semester Class
   - The thrid semester is possible and may affect a number of stuff...
   - In Creating a new semester, the Frontend must cater for creating new Academic year too.

## Semester User Class
    - Note to check whether a student is a summer school student or not because of semester 3

## Program Class
    - Bring in Slug to make getting class name easier

## Role Class
    - Considering Permissions as well.

## ClassGroupCourse
    - currently handling instances for the active semester alone

## CourseSchedule Class
    - Duration is in nearest whole number. factor for halves.
    - Should be able to merge instances


    - Factor: schedules could be specified as lab only, auditorium only or as alternating weekly or 2 weeks such that, this week lab, the next not... etc. 
## CourseUser Class
    - There's current_elective_per user on the classgroups to determine how many electives a user can b assigned to


    <!-- ----------------- -->
    The new ProgramStream eyi affclassskects Users. query regural user
    also affects Classgroups. Query Regular classgroups.
    Check StreamStatus of user

    Got To: Regular Users

    Issues...
    - Both Blocks of a 3 or 4 credit hour couse are scheduled for the same day.
    - maybe, max courses per day
    - factor day weight
    
    - the remaining_duration_for_stream function for the course must factor the classgroups/divisions involved as well
    - Factor couses with divisions.
    

<!-- TODO -->
<!-- analyse the logic proceed from there -->

