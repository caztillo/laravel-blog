# laravel-blog
Laravel blog example

## Instructions 

1. Clone the repo:

`git clone https://github.com/caztillo/laravel-blog.git`

2. Install  dependencies with composer

`composer install`

3. Rename the .env.example file to .env and then run the key generator:

`cp .env.example .env`
`php artisan key:generate`

4. Edit the .env file to match your local environment and default settings
In particular set-up your database:

`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=[your_database_name]`
`DB_USERNAME=[your_database_user]`
`DB_PASSWORD=[your_database_user_password]`

5. Migrate and seed the database

`php artisan migrate --seed`

6. Start laravel server:

`php artisan serve`

That way you'll be able to login at `http://localhost/admin` using `admin@domain.com` and `admin` as your credentials.

Enjoy!
