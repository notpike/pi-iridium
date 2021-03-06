<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## pi-iridium

![Image of Pi-Iridium Dashboard](doc/pi1.png)

HI! :D

This is my (alpha) gr-iridium web controler for the RPI. This application was built to act as a web UI for the existing [gr-iridium](https://github.com/muccc/gr-iridium) binary and [iridium-toolkit](https://github.com/muccc/iridium-toolkit) scripts. 

Built with Laravel 7 for PHP 7.2.5+ and MySQL for the DB, this was a exercise for me to become more proficient with PHP/Laravel development and learn more about how PHP handles websockets and async jobs. In my experience, Using PHP/Laravel wasn't the best use for this tech for building a dedicated controller for a RPI. Node.JS may be a better fit for any future progress with this web UI.

## Install
#### Required Software
- PHP 7+
- MySQL
- gr-iridium
- iridium-toolkit
- GNU Radio 

```
$ git clone https://github.com/notpike/pi-iridium
$ ./INIT.sh
```
After you run the INIT.sh script, update lines 48 and 49 the .env file found in the root directory of pi-iridium. Be sure to use the full system paths (ex. /home/user/gr-iridium) for gr-iridium and iridium-toolkit folders.

## Run
#### Local Server
If you want to run this localy use the following script.
```
$ ./START_LOCAL.sh
```

#### Remote Server
Remote services use this.
```
$ ./START.sh
```

#### Stop Service
To stop the service, use the script below.
```
$ ./STOP.sh
```

## Web Login
- User: iridium
- Pass: iridium

## Security
Below are known security issues for this alpha. No plans on correcting these for the alpha. Future versions of this will be done in Node.js. Also like I said, it's just an alpha. :)  

- DB creds are built from DB_INIT.sql (which is loaded by running INIT.sh) and creates user 'user' has a password of 'pass'. If you change this be sure the creds are reflected in the .env file.
- Websockets are PUBLIC
- Websockets API key pre-set in .env and bootstrap.js (Use node to reload)
- Downloads are NOT behind the web auth and can be downloaded without being loged in

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.



