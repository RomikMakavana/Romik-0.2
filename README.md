# Romik-0.2

Updated version of Romik-0.1 web framework with admin panel

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a system. Configuration instrations given below

### Prerequisites

What things you need to Run Romik-0.2

```
requires PHP 5.3
Mysql Database for admin panel
```

### Installing

You have to configure on one file.

Goto config\Configuration.php

```
//Default module
    const DEFAULT_CONTROLLER = "site"; 	// name of default controller
    const DEFAULT_ACTION = "index"; 	// name of method to run
//Server configurations
    const SERVER_NAME = "localhost"; 	// define host name 
    const DB_USERNAME = "root"; 		// define username 
    const DB_PASSWORD = ""; 			// define password
    const DB_NAME = "romik"; 			// define database name

    /*
     * name of admin side
     * that you will write to run backend side
     */
    const ADMIN_SIDE = 'admin';


    /*
    * Add list of css file and past that files to "css\" dir
    */
    public static $cssFiles = [
        'bootstrap\bootstrap.min.css',
        'style.css',
        'fontawesome\css\all.css',
    ];

    /*
    * Add list of js file and past that files to "js\" dir
    */
    public static $jsFiles = [
        'jquery.min.js',
        'bootstrap\bootstrap.min.js',
    ];

```

## Run

Now just go to browser and run the site

### Client Side

```
your.host\
```

### Backend Panel

default is "admin".
if you define some else, So run with that

```
your.host\admin
```
username and Password to login 
```
Username : superadmin
Password : superadmin
```

## Now Enjoy

Enjoy and develop your project with our framework, if you have query just comment or contact me from below link

## Built With

* [Bootstrap](https://getbootstrap.com/) - An open source toolkit for developing with HTML, CSS, and JS.
* [jQuery](https://jquery.com/) - JavaScript library.

## Authors

* **Romik Makavana** - *Web Developer* - [makavana_romik](https://twitter.com/makavana_romik)

## License

This Framework is licensed under the MIT License
