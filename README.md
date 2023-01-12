# README

## Running the project

To run the project, close the repository and use *Docker Compose* to start on the _root folder_:

`docker compose up`

There should be 3 images running if everything works as expected:

* gila-api-1
* gila-db-1
* gila-front-1

## Running tests and populating the tables

When starting, there should not be any data on the database, to populate them you can run the _Unit Tests_ for the project and in the end you should have a valid populated database:

`docker exec -it gila-api-1 vendor/phpunit/phpunit/phpunit --process-isolation`

To view the Front-end part, you can connect a browser to http://localhost:3000

The API runs on port 8080 and the database on port 3600.

## Development

* This project was developed from scratch using PHP, MySQL and ReactJS (with NodeJS)
* All that is related to this project was created specifically for this project
* I created my own version of an ORM to make it simpler to execute CRUD actions on the database (and I'm very proud of it)
* Most of the code is using SOLID principles
* I used principles of TDD
* Most of the env variables are set in the Dockerfiles
* The database used is MySQL, but could be any other that has Stored Procedures, to connect to the databases I used PDO
* The queue is using the principle of FIFO and it pre-records the data using a Stored Procedure, which increases the velocity to send the notifications
* To autoload the PHP part I used PHP composer
* With a few changes, this could be added to a CI/CD pipeline and deploy the images as pods to kubernetes

## Known Issues

* I know that the users should have separated Subscribed and Channels, but to be honest, for me, it makes more sense to have both in just one array, where the user could use different channels for different subjects - I even added a form for that in the Front-end to show how that would work
* There are some endpoints that are not being used, check the routes.php file
* The environments (dev/prod/etc) needs some work
* The links on the Axios API are hardcoded
* The tests need to run with `--process-isolation` (or equivalent in the phpunit.xml), but some errors don't show with this option
* The code coverage needs to be improved
* The nodule_modules for the front end are added on pourpose, that allows the images to start much faster
* It needs to deal with failed queues
* I should pass all the code on a beautifier, but in the end I didn't have time for it

## Used Libraries

* docker compose
* php composer
* bramus/router
* react-router-dom
* axios
