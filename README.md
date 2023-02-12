# EMS

## Description
An event management system.
It is still a work in progress...

## Screenshot
   Homepage
   https://user-images.githubusercontent.com/43953425/218332154-bb18af6d-f790-4507-af3e-6d1aef59cdd9.png
   
   
   User create event page
   [Created event registration page](https://user-images.githubusercontent.com/43953425/218332160-fab736bc-0162-4e7a-acaf-7c86c6d5baa9.png)
    
   Events registration
   [create event](https://user-images.githubusercontent.com/43953425/218332162-7c21cb2a-a05b-475a-a9a1-6dd2f7ad3fa5.png)


## Steps to run in local machine
- Clone the repository
- cd into project directory
- Copy .env.example to .env
- Run ```composer install``` to install composer dependencies
- Run ```npm install``` to install npm dependencies
- Run ```php artisan key:generate``` to generate application key
- Run ```php artisan migrate``` to create all tables
- Run ```php artisan db:seed --class=CreateAdminSeeder``` to seed the database with the default login details for admin, counsellor and user
- Run ```php artisan serve``` to serve up the application
- The application can then be viewed on your local machine.

# Event Management System
# event-ms
