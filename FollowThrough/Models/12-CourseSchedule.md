### Model Structure

- id
- course_id
- start_time
- end_time
- duration
- room_id
- day
- semester_id
- timestamps


Eg:
- id: 1
- course_id: 3
- start_time : 08:00:00
- end_time: 10:00:00
- duration: 2
- room_id: 45
- day: 4
- semester_id: 4
- timestamps: 


## Appended Attributes

    

### Database Structure
- id
- course_id [foreignId]
- start_time [Time]
- end_time [Time]
- duration [double]
- room_id [foreignId]
- day [integer]
- semester_id [foreignId]
- timestamps [Timestamps]


### RELATIONSHIPS
# Course



<!-- 
This model would be used to handle the timetable

This model is the cyclic schedule for all lectures
 -->

<!-- Process. -->
Parameters to find first.
- Students & Staff
- ClassGroup(s) with their number of Students as well.
- Classrooms available
- Times available
- available days

1.Foreach Course, Find a day out of the 5 week day that would be most suitable to fit the course.
And the best classroom to fit class based on the total number of students for all the classgroup(s)  involved.
The best time too comes in. A time that would present no conflict.

So in all the conflicts to check out for are
1. No staff has two or more courseSchedule for the same day and same time.
2. No Classgroup has two or more courseSchedule for the same day and same time.
3. no Classroom has more than one courseSchedule instace at the same time on the same day.
4. 


-----Yes...
So I would like to poulate this table based on the algorithm below.

1 Foreach course, find all the classgroups that are offering the course for the semester.
2. Find out the number of students in the related classgroups
3. Find out the staff or Staffs teaching the course for the semester.
4. Get the classrooms in the department of the related courses
4. Find The Best day out of the 5 days of the week such that, 
- The classroom to be assigned for the course is not taken by another course at the same time
- One Classgroup cannot have more than one courseSchedules at overlapping times on the same day
- No Staff has more than one couresSchedule at overlapping times on the same day.



-------------------------------
A function that would dispatch a job to run the scheduling function for select courses for a specific stream.

neede methods.
Every course should have a registered_stream attribute for the sem




