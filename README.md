# Movie Library Project

## Description
This project is a **Movie Library** built with **Laravel 10** that provides a **RESTful API**f for managing movies. It allows users to perform **CRUD operations** (Create, Read, Update, Delete) on movies, with the ability to filter movies by **genre** and sort them by **release year** (ascending and descending), or apply both filtering and sorting simultaneously. The project follows **repository design patterns** and incorporates **clean code** and **refactoring principles**.

### Key Features:
- **CRUD Operations**: Create, read, update, and delete movies in the library.
- **Filtering and Sorting**: Filter movies by genre, sort them by release year, or do both.
- **Repository Design Pattern**: Implements repositories and services for clean separation of concerns.
- **Form Requests**: Validation is handled by custom form request classes.
- **API Response Service**: Unified responses for API endpoints.
- **Pagination**: Results are paginated for better performance and usability.
- **Resources**: API responses are formatted using Laravel resources for a consistent structure.
- **Seeders**: Populate the database with initial data for testing and development.

### Technologies Used:
- **Laravel 10**
- **PHP**
- **MySQL**
- **XAMPP** (for local development environment)
- **Composer** (PHP dependency manager)
- **Postman Collection**: Contains all API requests for easy testing and interaction with the API.

---

## Installation

### Prerequisites

Ensure you have the following installed on your machine:
- **XAMPP**: For running MySQL and Apache servers locally.
- **Composer**: For PHP dependency management.
- **PHP**: Required for running Laravel.
- **MySQL**: Database for the project
- **Postman**: Required for testing the requestes.

### Steps to Run the Project

1. Clone the Repository  
   ```bash
   git clone https://github.com/TukaHeba/Movie_Library.git
2. Navigate to the Project Directory
   ```bash
   cd movie-library
3. Install Dependencies
   ```bash
   composer install
4. Create Environment File
   ```bash
   cp .env.example .env
Update the .env file with your database configuration (MySQL credentials, database name, etc.).
5. Generate Application Key
    ```bash
    php artisan key:generate
6. Run Migrations
    ```bash
    php artisan migrate
7. Seed the Database
    ```bash
    php artisan db:seed
8. Run the Application
    ```bash
    php artisan serve
9. Interact with the API and test the various endpoints via Postman collection 
    Get the collection from here: https://documenter.getpostman.com/view/34424205/2sAXjF9FSq
