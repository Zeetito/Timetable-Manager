### Model Structure

- id
- program_id
- year
- division_number
- start_year
- end_year
- timestamps

Eg:
- id: 1
- program_id:152
- year: 3
- division_number: null
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
- division_number [integer]->nullable()
- start_year [string]
- end_year [string]
- timestamps [timestamps]

### RELATIONSHIPS
# College

# Faculty

# Department

# Users 

# Divisions

