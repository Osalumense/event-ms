# EventMS

## Overview
Event MS is a powerful and flexible web application built with Laravel and Tailwind CSS. It simplifies the process of organizing events, whether they are paid or free, by providing a seamless registration and check-in experience for participants.
* Note: It's still a work in progress. So, use with caution. Thank you!

## Features
- Create Events: Easily set up new events with details such as date, time, venue, and pricing.

- Registration: Allow users to register for events with a simple and intuitive registration form.

- Barcode Generation: Automatically generate unique barcodes for participants upon registration.

- Efficient Check-in: Streamline event management by scanning barcodes for quick and accurate participant check-in.

- Responsive Design: The application is designed to work seamlessly on various devices, ensuring a smooth user experience


## Setup GUide
- Clone the repository
- cd into project directory
- Copy .env.example to .env
- Run ```composer install``` to install composer dependencies
- Run ```npm install``` to install npm dependencies
- Run ```php artisan key:generate``` to generate application key
- Run ```php artisan migrate``` to create all tables
- Run ```php artisan db:seed --class=CreateAdminSeeder``` to seed the database with the default login details for admin
- Run ```php artisan serve``` to serve up the application
- The application can then be viewed on your local machine.

## Screenshots
   Homepage
   ![Homepage](https://user-images.githubusercontent.com/43953425/218332154-bb18af6d-f790-4507-af3e-6d1aef59cdd9.png)
   
   User create event page
   ![Created event registration page](https://user-images.githubusercontent.com/43953425/218332162-7c21cb2a-a05b-475a-a9a1-6dd2f7ad3fa5.png)
    
   Events registration
   ![create event](https://user-images.githubusercontent.com/43953425/218332160-fab736bc-0162-4e7a-acaf-7c86c6d5baa9.png)
