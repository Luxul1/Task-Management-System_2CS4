# Task-Management-System
This project is a RESTful API built using PHP and PostgreSQL that manages a task management system with Users, Projects, and Tasks modules. It follows a modular structure where each module supports full CRUD (Create, Read, Update, Delete) operations and is extended with analytics endpoints for reporting and data aggregation.

The system is designed to handle relationships between entities such as user_id, project_id, and task_id, allowing tasks to be assigned to users and grouped under specific projects. It also includes analytics features that provide insights such as tasks per project, task status filtering, and assigned tasks per user.

All endpoints return responses in JSON format and are tested using Postman. The API uses query-based routing for analytics endpoints and standard REST-style endpoints for CRUD operations.

This project demonstrates core backend development concepts including:

- REST API design
- CRUD operations
- Database integration (PostgreSQL)
- JOIN queries and data aggregation
- PHP architecture
- JSON response handling


DOCUMENTATION AND TESTING

Database Designer

This is the foundation of the system, a relational database designed for referential integrity. The “users” and “projects” tables act as master data sources, while the “tasks” tables serve as the central operational hub, linking work items to specific individuals and project categories using FOREIGN KEY constraints.

Author: Jojo

Data Analytics API Developer
Its primary function which is the GetTasksPerProject() uses a LEFT JOIN and COUNT aggregation. This allows the system to report on the total number of tasks assigned to each project, including projects that currently have zero tasks, sorted from highest to lowest volume.</

Author: Pujalte & Habacon

Crud API Developer

Utilizes a task class that extends a base model for object oriented database interaction. This API handles the lifecycle of a task.

- (GET): allows fetching all or single specific task using a task_id.<li>
- (POST): validates input data (e.g. name, status, user, project, due date) before performing an INSERT operation.<li>
- (PUT): provides flexibility to either update an entire task record or just the status of a task.<li>
- (DELETE): removes a record from the database and returns a success or failure message based on the rowCount.<li>

Author: Cortez
...
CHANGES 

Model API Development
- each part of the crud is integrated into a class, where it can be access by calling the object/function. 
- It can be seen throughout the system, where it also accomodates the four pillars of OOP, namely Encapsulation, Polymorphism, Inheritance, Abstraction.

Relationship API Development
- In here, it uses the JOIN syntax to allow the user to connect between different database tables. 

Task Management System

## Description 
This system developed using REST API to efficiently manage and track  tasks assigned to users. The backend handles data logic via PHP OOP, while providing a relational database for frontend.

## Roles

Database Designer - Joiamae Ruma
Model Developer - Kezzia Naomi Montano
Crud API Developer - Robert Daniel Cortez
Relationship API Developer - Cristal Jane Almendra
Data Analytics API Developer - Christian Pujalte & Justin Habacon
Documentation and Testing - Princess Kelly Garingarao

TESTING

The Task Management System has the following functions:
    - Tasks
        > RetrieveTask
        > CreateTask
        > UpdateTask
        > DeleteTask
    - Projects
        > getProjects
        > createProject
        > updateProject
        > deleteProject
    - Analytics
        > getTasksPerProject
        > getTaskStatus
        


