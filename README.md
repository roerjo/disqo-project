# DISQO Project
A basic RESTful JSON API.

## Setup
I used Laravel Sails for local development and assumes that Docker is setup on the host machine.

After cloning the project and `cd`'ing into the project, run the following to spin up the enviornment:
```bash
./vendor/bin/sails up
```

Run the migrations:
```bash
./vendor/bin/sails artisan migrate
```

## Usage
### Get API token:
```bash
curl -d '{"email": "test@test.com", "password": "secret123", "password_confirmation": "secret123"}' -H "Content-Type: application/json" -X POST localhost/api/register
```

### See all notes associated with a user (paginated response):
```bash
curl -H "Content-Type: application/json" -H "Authorization: Bearer {token}" localhost/api/notes
```

### Create a note:
```bash
curl -d '{"title": "New note", "note": "This is a new note"}' -H "Content-Type: application/json" -H "Authorization: Bearer {token}" -X POST localhost/api/notes
```

### See a specific note:
```bash
curl -H "Content-Type: application/json" -H "Authorization: Bearer {token}" localhost/api/notes/{noteID}
```

### Update a note:
```bash
curl -d '{"title": "Updated note!", "note": "This is a new note"}' -H "Content-Type: application/json" -H "Authorization: Bearer {token}" -X PUT localhost/api/notes/{noteID}
```

### Delete a note:
```bash
curl -H "Content-Type: application/json" -H "Authorization: Bearer {token}" -X DELETE localhost/api/notes/{noteID}
```
