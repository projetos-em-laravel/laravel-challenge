# Web, PHP, Laravel Skills

## TL;DR: The Laravel Challenge App Development

0. Run `composer install`
1. Run `npm install` (or `yarn install`)
2. Perform the configuration for a [fresh install of Laravel](https://laravel.com/docs/5.4/#installation)
3. Run `php artisan serve`
4. Browse to [http://localhost:8000](http://localhost:8000)

## Introduction

This php project is an application that provides control of users and events. This includes CRUD operations, emailing, exporting and importing CSV files.

## Getting Started

Install the dependencies with [composer][composer] and [npm][npm], then adjust the initial settings required for any Laravel project, such as php artisan key: generate.

### Install Dependencies

All 3rd-party dependencies are managed with the [Composer][composer]  and [npm][npm] managers.
If you have installed Composer globally, as recommended, you can simply run:

```
composer install
npm install
```
### Set up the .env file

Set up the .env file, if you prefer you can use the setting below to enable email sending:

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=laravelchallenge@gmail.com
MAIL_PASSWORD=ch462846
MAIL_ENCRYPTION=tls
```
### Preping the application

As any new [Laravel][lararel] install there is a couple steps to perform in order to get it going. If you are nunfamiliar follow [these instrunctions](https://laravel.com/docs/5.4/#web-server-configuration)

## Create a database
Create your database and configure the .env file with the information:

## Create your migration
Run the code below to create your tables in your database:

```
php artisan migrate
```

## Feed the database
Run the code below to feed your database tables:

```
php artisan db:seed
```

### Run the Application

The simplest way to run the app is through the `artisan server`, which relies on the built-in PHP server.
To start the web server, run the following command from the project's root directory:

```
php artisan serve
```

You can then browse to [http://localhost:8000](http://localhost:8000) in your web browser.




