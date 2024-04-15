# Project tracking

This project helps employees to keep track of our customers' projects.

## Features

- Manage employees
- Manage project owners

## Libraries used

- TailwindCSS (https://tailwindcss.com/)
- DaisyUI (https://daisyui.com/)
- ChartJS (https://www.chartjs.org/)

## Requirements 

- PHP >=8.2
- Symfony CLI
- Composer

## Installation

1. Clone the repository
2. Install dependencies with `composer install`
3. Create a `.env.local` file and set your database credentials
4. Create the database with `php bin/console doctrine:database:create`
5. Run datafixtures with `php bin/console doctrine:fixtures:load`
6. Start the server with `symfony serve`
7. Open your browser and go to `http://localhost:8000`


