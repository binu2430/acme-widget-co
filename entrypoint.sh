#!/bin/sh

# Exit immediately if a command exits with a non-zero status
set -e

echo "Checking if .env file exists..."
if [ ! -f /var/www/html/.env ]; then
    echo "Creating .env file..."
    cp /var/www/html/.env.example /var/www/html/.env
    php artisan key:generate
else
    echo ".env file already exists, skipping key generation."
fi

# Ensure the database file exists for SQLite
echo "Ensuring SQLite database file exists..."
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite

# Ensure the .ssh directory exists
echo "Ensuring SSH directory exists..."
mkdir -p ~/.ssh
chmod 700 ~/.ssh

# Fix GitHub SSH host key issues
echo "Adding GitHub to known hosts..."
ssh-keyscan github.com >> ~/.ssh/known_hosts
chmod 600 ~/.ssh/known_hosts

# Run database migrations
php artisan migrate --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000
