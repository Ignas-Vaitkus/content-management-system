# Content Management System

This project is a simple backend website that has a custom MVC framework built with [Doctrine ORM](https://github.com/doctrine/orm/) to manage models. The website has an Admin user, who can edit, delete and add pages for the regular user to see, whereas the regular user, can only browse the pages.

## Requirements

- MySQL Database
- PHP Interpreter
- Composer dependency manager

## How to Install

- Clone the repository to your xampp localhost directory.
- Run `config/mysql_database_init.sql` script on MySql Workbench to initialize the database. NOTE: There there are two DROP commands in the script! Check to see if it will not affect your existing databases or users.
- Then run the following commands in project root directory:

```
composer install
composer dump-autoload
php config/update-schema.php
php config/seeder.php
```

## How to Start

- Turn on your local Apache Web Server and MySQL Database.
- Open the path of the app, e.g: http://localhost/content-management-system.
- To open admin mode add `/Admin` to the url. e.g: http://localhost/content-management-system/Admin. Username: Admin, password: Password.

### Usage notes

- The routes are case sensitive.

### Study notes

- Implemented Singleton design pattern. Note: This pattern was only used in one place to save time.
- Implemented recursive view generation.
- The tracking of different routes is desired to be further improved.
- All page entities do not have to be retrieved for edit and add routes.
- Controllers were not really used in this project. This should be implemented in the future.
