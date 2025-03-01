# Laravel API Project

This is an open-source Laravel-based API project that provides a robust foundation for building RESTful APIs. It includes integration with **Spatie JWT** for authentication and **Spatie Swagger** for API documentation.

## Features

-   **JWT Authentication**: Secure your API endpoints using JSON Web Tokens (JWT) with the Spatie JWT package.
-   **Swagger API Documentation**: Automatically generate and serve API documentation using Spatie Swagger.
-   **RESTful API Structure**: Follows best practices for building scalable and maintainable APIs.
-   **Open Source**: Fully open-source and customizable to fit your project needs.

## Prerequisites

Before you begin, ensure you have the following installed:

-   PHP >= 8.0
-   Composer
-   Laravel >= 9.x
-   MySQL or any other supported database

## Installation

1. Clone the repository:
   git clone https://github.com/MrMahdiSh/baseLaravel
   cd your-repo-name

2. Install dependencies:
   composer install

3. Set up environment variables:

    - Copy .env.example to .env:
      cp .env.example .env
    - Update .env with your database credentials and other settings.

4. Generate application key:
   php artisan key:generate

5. Run migrations:
   php artisan migrate

6. Install Spatie JWT and Swagger packages:
   composer require spatie/laravel-jwt
   composer require spatie/laravel-swagger

7. Publish Swagger configuration:
   php artisan vendor:publish --provider="Spatie\Swagger\SwaggerServiceProvider"

8. Generate Swagger documentation:
   php artisan swagger:generate

9. Start the development server:
   php artisan serve

## Usage

-   Access the API documentation by navigating to `/api/documentation` in your browser.
-   Use JWT tokens for authentication in your API requests.

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bugfix.
3. Commit your changes.
4. Submit a pull request.

## License

This project is open-source and available under the MIT License.

## Acknowledgments

-   Spatie for their excellent Laravel packages.
-   Laravel for the amazing PHP framework.
