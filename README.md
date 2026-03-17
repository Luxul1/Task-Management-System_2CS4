# Task-Management-System
DOCUMENTATION AND TESTING

Database Designer

This is the foundation of the system, a relational database designed for referential integrity. The “users” and “projects” tables act as master data sources, while the “tasks” tables serve as the central operational hub, linking work items to specific individuals and project categories using FOREIGN KEY constraints.<

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


Task Management System

## Description 
This system developed using RESTful API to efficiently manage and track  tasks assigned to users. The backend handles data logic via PHP OOP, while providing a relational database for frontend.

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
        > 
    - Projects
    - Analytics


