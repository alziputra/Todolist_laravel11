# Todo Application with Laravel 11

This is a simple Todo application built using Laravel 11. Follow the instructions below to set up the project on your local machine.

## Requirements

-   PHP version 8.2 or higher (Laravel 11 requires PHP 8.2+)
-   Composer
-   MySQL or compatible database

## Installation Guide

### 1. Clone the repository

### 2. Create a Database

Create a MySQL database for your project. You can use the following command in MySQL:

```
CREATE DATABASE <databasename>;
```

### 3. Update .env File

Update the .env file to match your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 4. Run the Migrations

Run the migration to create the tb_todos table in your database:

```bash
php artisan migrate
```

#### 5. Serve the Application

Finally, you can start the Laravel development server:

```bash
php artisan serve
```

The application will be available at http://127.0.0.1:8000
