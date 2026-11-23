# Blog Project
A PHP & MySQL blog application built during the ApexPlanet internship.

## Features (Task 2)
- Create, read, update and delete posts
- User registration and login with hashed passwords
- Session-based login state

## Database: `blog`
**users**: id (PK, auto increment), username (unique), password (hashed)
**posts**: id (PK, auto increment), title, content, created_at (timestamp)

The SQL is in `database/schema.sql`.

## Setup
1. Install XAMPP and start Apache and MySQL.
2. Import `database/schema.sql` in phpMyAdmin.
3. Copy the project to `C:\xampp\htdocs\blog`.
4. Open http://localhost/blog