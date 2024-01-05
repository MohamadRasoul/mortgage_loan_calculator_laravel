<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>



# mortgage Loan Calculator

mortgage loan calculator using Laravel. Users can input loan details, including amount, interest rate, and term, with support for fixed terms and extra repayments. The application generates an amortization schedule and a recalculation schedule for shortened loans due to extra payments. Both schedules display a monthly payment breakdown, along with headers showing loan setup details and effective interest rates.


## Table of Contents

- [ERD (System Analysis)](#ERD-(System-Analysis))
- [Technology Used](#technology-used)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Local Project Link](#local-project-link)



## ERD (System Analysis)
* [Link For ERD](https://drive.google.com/file/d/1uaKgfgTvnQwzy3URpKVy4nSynzuHKkQd/view?usp=sharing)


## Technology Used
* [laravel 10](https://laravel.com/docs/10.x/releases)


## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP (>= 8.1)
- Composer
- Node.js and npm (for frontend assets)
- A web server (e.g., Apache, Nginx)
- MySQL or another database of your choice


## Installation

1. Clone the repository:
    ```shell script
    git clone https://github.com/MohamadRasoul/mortgage_loan_calculator_laravel.git
    ```


2. Navigate to the project folder:
    ```shell script
    cd mortgage_loan_calculator_laravel
    ```

3. Install PHP dependencies using Composer:
    ```shell script
    composer install
    ```


4. Copy the `.env.example` file to `.env`:
    ```shell script
    cp .env.example .env
    ```

5. Generate an application key:
    ```shell script
    php artisan key:generate
    ```

6. Configure your `.env` file with your database credentials and other settings.

7. Migrate and seed the database:
    ```shell script
    php artisan migrate --seed
    ```
8. Migrate and seed the database:
    ```shell script
    php artisan ser --port 8000
    ```

9. Install JavaScript dependencies and compile assets:
    ```shell script
    npm install & npm run dev
    ```

## Local Project Link
[Link to Dashboard.](http://localhost:8000/)

- **email :** test@test.com
- **password :** 12345678


