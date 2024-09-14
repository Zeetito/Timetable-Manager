### Model Structure

value
start_date
end_date
is_active
academic_year_id

Eg:
- id: 1
- value: 1
- start_date: 2025-01-06
- end_date: 2025-04-23
- is_active: 1
- academic_year_id: 1


## Appended Attributes
- name: Eg 2024-2025,Semester 1

### Database Structure
- id 
- value [integer]
- start_date [date]
- end_date [date]
- academic_year_id [foreignId]
- is_active [boolean]
- timestamps [timestamps]

unique ['academic_year_id,value']

### RELATIONSHIPS
# Academic Year
<!-- ----------------- -->
# Courses

# CourseSchedule

# CustomCourseSchedule

### Notes
## Semester 3
# There could be a semester 3 but only staff and related students can see it.