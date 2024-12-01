# Dockerized stack for Symfony project

#### Stack : php-apache2 mysql pma

## Requirements :
- Ubuntu 20.04 or higher
- docker and docker-compose (optionnal: docker desktop)
- an IDE (phpStorm, Vscode or else)
- Make on your local machine if you want to use the Makefile commands (optionnal)
- git (optionnal but better)

## How to set a new project
### Prepare
- `git clone` this project
- rename the main folder to your project name
  - `mv symfony-stack your-project-name`
- copy the .env.template file to .env and set the variables (Ports, project name, etc)
- Set your php version/image in the Dockerfile
- `FROM php:8.3-apache`

### Build
- `docker-compose up --build` OR `make build` to build the containers

### Install Symfony
- once the containers are up and running install Symfony :
  - access your php-apache container 
    - `docker exec -it php-container-id-or-name bash` OR `make php`
    - `composer createUser-project symfony/skeleton:"7.1.*" .`
- If you are building a microservice or console app or API you're good to go.
- If you need the packages for a webApp :
  - `composer require webapp`

#### Change the owner
- access your php container
  - `docker exec -it php-container-id-or-name bash` OR `make php`
  - go to var
    - `cd /var`
  - change the owner of the www folder
    - `chown -R www-data:www-data www`

- If you can't createUser a file on your local machine :
  - You might need to change the owner of your backend directory on your local machine too
    - `sudo chown -R $USER:$USER backend`

#### Sync to your GitHub repository
- `git init`
- Remove the origin:
- `git remote remove origin`
- Add your repository as origin:
- `git remote add origin your-repo-ssh-url`
- `git branch -M main` OR `git branch -M master`
- `git add .`
- `git commit -m "Initial commit"`
- `git push -u origin main` OR `git push -u origin master`

### Good to go ?
- check `localhost:8080` to see your app running or `localhost:PHP_APACHE_HOST_PORT` you have set in the .env file
- check `localhost:8088` to see your phpmyadmin or `localhost:PMA_HOST_PORT` you have set in the .env file
- your database is running on port `3308` or `MYSQL_PORT` you have set in the .env file
- At this point your containers should be running fine. You're ready to go 🚀!

- If something is wrong check your docker logs

