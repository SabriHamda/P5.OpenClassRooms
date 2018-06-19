[![Codacy Badge](https://api.codacy.com/project/badge/Grade/56de77e63685493f95f6d0d97dd5f098)](https://www.codacy.com/app/SabriHamda/P5.OpenClassRooms?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=SabriHamda/P5.OpenClassRooms&amp;utm_campaign=Badge_Grade)
# Advanced PHP MVC Blog
> Projet 5 OpenClassrooms

##### Frontend screenshot 


![Alt text](https://hamda.ch/images/readme/front-screenshot.png?raw=true "front-end")

##### Dashboard screenshot 

![Alt text](https://hamda.ch/images/readme/dashboard-screenshot.png?raw=true "front-end")




Simple PHP blog system application based on the MVC pattern and written in PHP 7.0. 
This project can be used as a Base MVC "framework" to start your PHP project easily under good development patterns 
and good development practice and organization.

## Installing / Getting started

Before instalation you must configure virtual host on your machine click [here](http://www.numediaweb.com/configure-virtual-hosts/950) for more details.

### Installation with composer

```shell
php composer.phar install
```

Composer will create a new folder named vendor and install all dependencies in this folder.

### Initial Configuration

To safly start with this project we needs some configurations.
#### Database 
* create a new database, name it as you want.
* Import  ```config/p5_blog.sql ``` file into MySQL or MariaDB.
* Change the name of ```config/db_sample.php``` to ```config/db.php``` and set your connexion.

```php
<?php
return [
    'dsn'=> 'mysql:host=YOUR_HOST;dbname=YOUR_DB_NAME',
    'username'=> 'USERNAME',
    'password'=> 'PASSWORD'
];
``` 
#### Mailer
* The project use Swift Mailer , let's setup this file.
Go to ```config/``` and rename  ```mailer_sample.php``` to ```mailer.php```.

```php
<?php
return [
    'username' => 'YOUR_YOUSERNAME',
    'password' => 'YOUR_PASSWORD'
];
``` 


## Features

This MVC application has several features including :
* Admin dashboard to manage articles and comments.
* Add articles.
* Delete articles.
* Edit article. 
* user login. 
* register users.



## Links
This project is available online

- Project homepage: https://p5.hamda.ch
- Repository: https://github.com/SabriHamda/P5.OpenClassRooms
- Issue tracker: https://github.com/SabriHamda/P5.OpenClassRooms/issues
  - In case of sensitive bugs like security vulnerabilities, please contact
    sabri@hamda.ch directly instead of using issue tracker. We value your effort
    to improve the security and privacy of this project!



>I used the theme bootstrap Marble.
##### About Marble Theme

Marble is a free html5 bootstrap template with a clean and minimal design. Marble is ideal for portfolio or 
any other type of website you use it with. It has fixed left sidebar menu with offcanvas menu on mobile. 
Showcase your outstanding works professionally with the smooth animation upon scrolling on entire pages.
Alongside, share your amazing stories elegantly with the neat blog design of this Marble template.

>AUthor :
DESIGNED & DEVELOPED by FREEHTML5.co

* Website: http://freehtml5.co/




## Licensing

>The code in this project is licensed under MIT license.

Copyright (c) 2018 Sabri Hamda

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
