# Laravel To-Do
![https://github.com/WiGeeky/todo/actions/](https://img.shields.io/badge/Coverage-100%25-brightgreen?style=flat-square)
![](https://github.styleci.io/repos/491945425/shield)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/WiGeeky/todo/main?style=flat-square)](https://github.com/WiGeeky/todo/actions/)

This Laravel 7.x package is a sample laravel package that adds the to-do functionality to your existing laravel project.

## Installation
You will need to install this package from packagist:

```sh
composer require wigeeky/todo
```
This package is made to work out of the box, however, if you need to 
customize this package's prefix and middlewares, you can publish the 
project configuration file:
```sh
php artisan vendor:publish --provider="WiGeeky\Todo\TodoServiceProvider" --tag="config"
```

## Entities
This package uses 3 entities to provide the to-do functionality:
* User (Provided by your main Laravel project)
* Task (Tasks that belong to a user)
* Label (System-wide labels that belong to tasks)

## Routes
By default, this package provides a RESTful API separated for each resource:

### Task
```
GET   /api/tasks                # List of tasks for the logged in user
GET   /api/tasks/{task}         # Get details about a specific task
POST  /api/tasks                # Create a new task for the logged in user
PUT   /api/tasks/{task}         # Update a task's name and description
PATCH /api/tasks/{task}         # Update a task's status
POST  /api/tasks/{task}/labels  # Add a label to the current task
```

### Label
```
GET  /api/labels # List of all system-wide labels that user has used so far
POST /api/labels # Add a new label to the system
```