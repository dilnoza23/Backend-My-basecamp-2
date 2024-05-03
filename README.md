### Project Basecamp Clone using Laravel and Vite.js

## Link http://basecamp.dilnozzt.beget.tech/

## Task
The primary tasks of this project include:
1. Implementing user authentication and authorization.
2. Creating projects with various details such as title, description
3. Adding task lists within projects.
4. Implementing file attachments for tasks and projects.

## Description
This project is a Basecamp clone developed using Laravel and Vite.js. Basecamp is a project management and collaboration tool, and this clone aims to replicate its core features, allowing users to create projects, assign tasks, adding thread for each project, and inside thread you can comment the thread. The application leverages Laravel for backend functionality and Vite.js for frontend development.

## Installation
To install and run this project locally, follow these steps:

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Navigate to the project directory:
   ```
   cd project-basecamp-clone
   ```

3. Install PHP dependencies using Composer:
   ```
   composer install
   ```

4. Install Node.js dependencies using npm or yarn:
   ```
   npm install
   ```

5. Create a copy of the `.env.example` file and rename it to `.env`. Update the database configuration in the `.env` file with your database credentials.

6. Generate an application key:
   ```
   php artisan key:generate
   ```

7. Run migrations to create the necessary database tables:
   ```
   php artisan migrate
   ```

8. Start the Laravel development server:
   ```
   php artisan serve
   ```

9. In a separate terminal window, start the Vite.js development server:
   ```
   npm run dev
   ```

10. Access the application in your web browser at `http://localhost:8000`.

## Usage
Once the application is set up and running, you can perform the following actions:

1. Register a new account or login with existing credentials.
2. Create new projects by providing relevant details such as title, description, and deadlines.
3. Add task lists within projects.
4. Attach files to tasks or projects for better collaboration.