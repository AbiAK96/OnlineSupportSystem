# Online Support System

This web application, developed on the Laravel framework, offers an online support platform designed to aid service providers and sellers in providing post-sales assistance to their customers

## Requirements

- PHP version: 8.1.13
- Laravel version: 10
- MySQL version: 8.0.31
- Admin LTE version: 3.2

## Setup Instructions

- To get started and run the project, please follow these instructions:

- Transfer the project files to your local server's file directory.

- Utilize Composer to install the project dependencies. Execute the following command in the project's root directory:

- composer install

- Configure the database connection by updating the .env file with the appropriate MySQL database credentials.

- Execute the database migrations to create the required tables. Use the following command:

- run php artisan migrate

- Populate the database with agent user data by running the following command:

- run php artisan db:seed --class=UserSeeder

- Configure the SMTP mail server credentials in the .env file to enable email functionality.

- Ensure that the project is running on a web server. For testing purposes, you can utilize Laravel's built-in server:

- run project php artisan serve

How to Use

- Open your web browser and access the application using the provided URL. If you're using the built-in server, you can access it at http://localhost:8000.

- As a guest user, you can open a support ticket by providing the necessary details.

- Support agents can log in to the system to access and respond to the tickets.

- Customers can check the status of their tickets by entering the reference number provided when they opened the ticket.

## Screenshots

Screenshots of the application's output pages in the 'screenshots' folder.

## Notes
- The pagination feature is configured to show 10 tickets per page. In order to test the pagination functionality, please create a minimum of 11 tickets.
- To validate the email sending capability, double-check that your mail server credentials are accurately configured.
- If admin loged in all the tickets are showing
- Admin can assign tickets to other users
- Users can only see their tickets