### Model Structure

name
college_id
faculty_id
department_id
type
span
timestamps

Eg:
- id: 1
- name: BSc.Computer Science
- college_id: 4
- department_id: 2
- faculty_id: null
- type: ug (UnderGraduate)
- span: 4 (years)
- timestamps ()


## Appended Attributes
<!-- - name: Eg 2024-2025,Semester 1 -->

### Database Structure
- id 
- name [string]
- college_id [foreignId]
- faculty_id [foreignId]->nullable()
- department_id [foreignId]
- type [string]
- span [integer]
- timestamps [timestamps]

### RELATIONSHIPS
# College

# Faculty

# Departments

# ClassGroups 

# Users

<!-- ---------------- -->
