# Laravel Task Management API

A RESTful API for managing tasks with tags, built with Laravel 12.

## Requirements

- **PHP**: ^8.4.0
- **Laravel**: ^12.52.0
- **MySQL**: 8.0+ (via Docker)
- **Docker** & **Docker Compose**
- **Composer**: Latest version

## Installation (Using Docker)

1. Clone the repository

2. Copy the environment file:
```bash
cp .env.example .env
```

3. Start the Docker containers:
```bash
make dev
```

This command will:
- Build and start the containers
- Install Composer dependencies
- Generate application key
- Run migrations

4. Access the application at: **http://localhost:8337**

## Migrations & Seeders

### Running Migrations

```bash
make migrate
```

### Running Seeders

```bash
make seed
```

## Testing

### Run All Tests

```bash
make test
```

## API Request Examples

### 1. Get All Tasks

```bash
curl -X GET http://localhost:8337/api/tasks \
  -H "Accept: application/json"
```

### 2. Create a New Task

```bash
curl -X POST http://localhost:8337/api/tasks \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Complete the project",
    "description": "Finish the Laravel task management API",
    "is_done": false,
    "tags": ["work", "urgent"]
  }'
```

### 3. Update a Task

```bash
curl -X PUT http://localhost:8337/api/tasks/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Updated task title",
    "is_done": true,
    "tags": ["completed", "work"]
  }'
```
