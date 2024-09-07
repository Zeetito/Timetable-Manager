### Model Structure

- id
- program_id
- year
- is_divided
- start_year
- end_year
- timestamps

Eg:
- id: 1
- program_id:152
- year: 3
- is_divided: 0
- end_year: 2022
- start_year: 2026
- timestamps:...


## Appended Attributes
    name,
    slug,
    size,
    class_divisions,

### Database Structure
- id
- program_id [foreignId]
- year [integer]->nullable()
- is_divided [boolean]->default(0)
- start_year [string]
- end_year [string]
- timestamps [timestamps]

### RELATIONSHIPS
# Program

# Users 

# Divisions
<!-- ---------------- -->
# College

# Faculty

# Department


