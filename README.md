# Table of Contents
- [Description](#description)
- [Features Implemented](#features-implemented)
- [Pending Features](#pending-features)
- [Installation](#installation)

# Description

This is a Laravel-based Cinema Reservation System designed to manage movie showtimes, reservations, and seat purchases. The system interacts with the **OMDb API** to fetch movie details and uses **Redis** for caching and lock management. The solution includes several core features:

- **Create showtimes** from movie data fetched from the OMDb API.
- **Reserve seats** for a movie showtime, ensuring seats are not double-booked.
- **Buy seats** by confirming reservations, ensuring the reservation is valid.
- **Cache movie data** to optimize performance.
- **Logging execution times** for all API requests to track performance.

# Features Implemented

1. **Fetching Movie Details**  
   Movie data is fetched from the OMDb API and stored in Redis for caching. If the OMDb API is unavailable, the cached data is returned.

2. **Showtime Management**  
   Showtimes are created with a movie's details and a list of available seats. Each showtime is stored in the database with details like movie title, auditorium, and showtime start time.

3. **Seat Reservation**  
   Seats can be reserved for a given showtime. Reservations are subject to constraints:
    - Reserved seats are contiguous.
    - Reserved seats cannot be purchased twice.
    - A reservation expires after 10 minutes.

4. **Seat Purchase**  
   Once reserved, a seat can be purchased. Reservations can only be confirmed if they are still valid and within the expiration window.

5. **Caching with Redis**  
   Movie data fetched from the OMDb API is cached using Redis to reduce API calls and improve performance. If the API call fails, cached data is used.

6. **Logging Execution Time**  
   The execution time for all routes is logged using middleware to track performance.

7. **Queue Handling and Concurrency**  
   Jobs are dispatched for tasks that take time to process (like expiring reservations), and locks are used to prevent race conditions during seat reservation.

# Pending Features

### Unit and Integration Tests

Unfortunately, due to time constraints, unit and integration tests have not been created. However, I would approach this as follows:
Unit Tests for handlers, factories, validators, providers, etc. to ensure that the business logic functions correctly.
Integration Tests for routes, ensuring that the system behaves as expected when interacting with other services (e.g., the OMDb API, Redis, and the database).
Pest Testing: The tests would be written using the Pest testing framework to take advantage of a simpler syntax and more expressive test cases.
---

# Installation
### 1. Clone project

First, clone the project from Git repository.

`git clone <repository-url>`

### 2. Install Docker and Laravel Sail
Make sure you have Docker installed on your machine, as Laravel Sail relies on Docker for environment setup. If you don't have it, you can install Docker from the official website.

Once Docker is installed, you'll use Sail, which is Laravel’s command-line interface for interacting with Docker.

Sail is included as a development dependency in Laravel projects, so if you're working with a project that already has Sail configured, you can proceed to the next steps.

### 3. Install Dependencies Using Composer
Run composer install to install the necessary PHP dependencies. You’ll use Sail to run this command within the Docker container.

```
./vendor/bin/sail up -d
./vendor/bin/sail composer install
```

### 4. Set Up the .env File
You’ll need to copy the .env.example file to .env and configure your environment variables.
`cp .env.example .env`

### 5. Generate an Application Key
Run the following command to generate an application key.
`./vendor/bin/sail artisan key:generate`

### 6. Run Migrations
Run the following command to run the database migrations.
`./vendor/bin/sail artisan migrate`

### 7. Run queue worker
Run the following command to run the queue worker.
`./vendor/bin/sail artisan queue:work`

### 8. Use application
You can now access the application on http://0.0.0.0. See available requests in the Postman collection attached in .postman folder or in cUrls.txt file.
