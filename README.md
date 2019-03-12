# Crossfit Tracker RESTful API
PHP RESTful API for the Crossfit Tracker Application

## Stack
- PHP (v7)
- Symfony (v4)
- Doctrine (v2.5.11)

## Design Decisions
The Symfony framework was chosen when designing this API as the web client is written
in Angular and what both of these frameworks have in common is the use of Dependency Injection.

Doctrine was used as an Object Relational Mapping tool. Doctrine integrates seamlessly into
the Symfony framework.

I attempted to follow OOP principles as much as possible with the design of this application by ensuring
each object is responsible for its own behaviour and by abstracting the code as much as possible.


## Running the application

The most ideal way to run the application is using docker and docker compose.
If you have these installed, execute the following commands:

    $ docker-compose build
    $ docker-compose up -d
    
Now would be an ideal time to start up the frontend application as it takes roughly 5 seconds for the
API to start up.

If you do not have docker, you can run the following commands:

    $ composer install
    
Then you can run the dev web server:

    $ php -S localhost:8080 -t public

Make sure you have a local MySQL instance. The script to create the database is at the following location:

    $ .docker/mysql/scripts/init_db.sql

You will then need to modify the .env file to point to your local instance:

    DATABASE_URL=mysql://root:root@mysql:3306/crossfit_tracker
    # Comment out the above property and uncomment below for running locally
    #DATABASE_URL=mysql://root:root@localhost:3306/crossfit_tracker

From there, run the migrations to initialize the database:

    $ php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

The API will be available at http://localhost:8080