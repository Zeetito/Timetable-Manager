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

## CourseSchedule Class
    - Duration is in nearest whole number. factor for halves.

    - Factor: schedules could be specified as lab only, auditorium only or as alternating weekly or 2 weeks such that, this week lab, the next not... etc. 


    <!-- ----------------- -->
    The new ProgramStream eyi affclassskects Users. query regural user
    also affects Classgroups. Query Regular classgroups.
    Check StreamStatus of user

    Got To: Regular Users

<!-- TODO -->
<!-- analyse the logic proceed from there -->
