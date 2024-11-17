<p align="center"><a href="https://gergotar.comhttps://gergotar.com" target="_blank"><img src="https://gergotar.com/img/logo.png" width="40" alt="Gergő Tar Logo"></a></p>

## About the Project

The project was created for the blog post [Laravel Controllers: From Simple to Scalable](https://gergotar.com/blog/postslaravel-controllers-from-simple-to-scalable). The post guides you through the basics of creating a controller and explores options for scaling. You will learn about resource controllers, policies, form requests, and service-driven architecture.

## Installation Steps

To get started with this project, follow these steps:

1. Install the dependencies:

    ```sh
    composer install
    ```

2. Run the database migrations and seed the database:

    ```sh
    php artisan migrate --seed
    ```

3. Create a symbolic link from `public/storage` to `storage/app/public`:

    ```sh
    php artisan storage:link
    ```

4. Install Node dependencies and build assets:

    ```sh
    yarn install & yarn build
    ```

5. Serve the application:

    ```sh
    php artisan serve
    ```

6. Visit http://localhost:8000

## Running Tests

To run the tests, use the following command:

```sh
php artisan test
```

## Authentication

For the login functionality, Laravel Breeze was used.
Two users are created with the seeders:

Regular User:

-   Username: `john.doe@mail.com`
-   Password: `password`

Admin User:

-   Username: `admin@example.com`
-   Password: `password`

## License

This project is licensed under the MIT License - see [LICENSE](LICENSE.md)
