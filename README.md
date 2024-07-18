# Football API

## Project Brief

The purpose of this project is to integrate with the API-Football service to pull fixture and club data for the Premier League. The application focuses on two main objectives:
1. Retrieve and persist all fixtures in the Premier League and the associated clubs.
2. Fetch and store all fixtures for each club playing in the Premier League, including their matches in other competitions.

## Approach

This project follows the principles of Test-Driven Development (TDD) using Laravel. Below are the key aspects of the approach:

- **Daily Fixture Updates:** Fixture data will be pulled and updated daily, grouped by match day. This is achieved using Laravel's scheduler.
- **Periodic Club Data Updates:** Club data will be requested and updated every 14 days.
- **Result Data Persistence:** Once a match (fixture) has concluded, the result data will be fetched and stored in the database.

## Getting Started

To get started with the project, follow the instructions below.

### Prerequisites

- PHP (version 8.3 or higher)
- Composer
- MySQL
- Laravel (version 11 or higher)

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/repzlaw/football-api.git

2. Navigate to the project directory:
   ```bash
   cd kano-central

3. Install dependencies:
   ```bash
    composer install
    npm install
    npm run dev

4. Set up your .env file and generate an application key:
   ```bash
    cp .env.example .env
    php artisan key:generate

5. Run migrations:
   ```bash
   php artisan migrate

6. Link storage:
   ```bash
   php artisan storage:link

7. Serve the application:
   ```bash
   php artisan serve
