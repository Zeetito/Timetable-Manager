### Model Structure

- id
- username
- firstname
- othername
- lastname
- gender
- identity_number
- index_number
- is_staff
- program_id
- class_group_id 
- email
- password

Eg:
- id: 1
- username: tito
- firstname: Jane
- othername: null
- lastname: Franklin
- gender: m
- identity_number: 21854512
- index_number: 8512451
- is_staff: 0
- program_id: 152
- class_group_id: 523 
- email: janefranklin32@gmail.com
- password: #hashed#


## Appended Attributes
    fullname,
    class_slug, eg: CS3-B
    

### Database Structure
- id
- username [string]
- firstname [string]
- othername [string]->nullable()
- lastname [string]->nullable()
- gender [char]
- identity_number [string]->nullable()
- index_number [string]->nullable()
- is_staff [boolean]
- program_id [foreignId]
- class_group_id [foreignId]
- email [string]
- password [string]

### RELATIONSHIPS
# ClassGroup

# Program
<!-- ------------------------ -->
# College

# Faculty

# Department

# Course

# Courses for Sem & Program mates

# ProgramMates

# Lecturers - forSem




