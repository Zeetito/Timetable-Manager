### Model Structure

- id
- course_id
- start_time
- end_time
- room_id
- day
- semester_id
- timestamps


Eg:
- id: 1
- course_id: 3
- start_time : 08:00:00
- end_time: 10:00:00
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








