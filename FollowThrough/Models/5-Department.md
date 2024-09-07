### Model Structure

name
college_id
faculty_id
location
timestamps

Eg:
- id: 1
- name: Department of Compute Science
- college_id: 4
- faculty_id: null
- location: https://maps.app.goo.gl/5rNwSwazqftBcfhC8


## Appended Attributes
<!-- - name: Eg 2024-2025,Semester 1 -->

### Database Structure
- id 
- name [string]
- college_id [foreignId]
- faculty_id [foreignId]->nullable()
- location [string] -{nullable}
- timestamps [timestamps]

### RELATIONSHIPS
# College

# Faculty

# Departments

# Programs

# Courses
<!-- ------------------ -->
# ClassGroups 

# Users

