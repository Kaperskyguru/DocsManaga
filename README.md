# DocsManaga
This is a document management system project.

# Install php ^7.1 and composer

# To run the app
1. clone the repo
2. cd DocsManaga

# Install libraries
composer update

# Set up database
1. rename .env.example to .env.
2. Set your database credentials in .env file

# Run migrate
php artisan migrate --seed

# Build the App
php artisan serve
