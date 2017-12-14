# WebCMS

## Introduction

WebCMS is a content management system (CMS) based on PHP that allows a user to create, edit and delete his own content. All data are stored in a database, so the user can add, edit and remove his own content.

## Installation

The CMS runs on any Apache based system with a PHP and MySQL setup. For other systems than Linux, you have to provide the required packages by your own.

### Install all system dependencies

	sudo apt-get install apache2 php5 php5-xdebug php5-xsl php5-ldap php5-mysql mysql-client

### Clone the repository

	cd /var/www/
	git clone https://github.com/swaechter/webcms-php.git webcms.org (Your domain)

### Enable Apache mod_rewrite

	Edit the file /etc/apache2/apache2.conf and allow rewrite
	sudo a2enmod rewrite

### Increase the PHP and Apache file upload size

	Edit the file /etc/php5/apache2/php.ini and modify the value upload_max_filesize

### Create a virtual host

	Create an Apache virtual host for www.webcms.org that points to /var/www/webcms.org
	sudo a2ensite webcms.org

### Create the upload directory and set the permissions

	mkdir webcms.org/public/data/
	cd webcms.org
	sudo chown -R www-data:www-data public/data/
	sudo chmod -R 755 public/data/
	sudo chmod -R 644 public/data/*

### Create and import the database

	mysql -u root -p -e "CREATE DATABASE webcms_test;"
	mysql -u root -p -e "CREATE DATABASE webcms;"
	mysql -u root -p webcms < sql/webcms.sql

### Install composer

	php -r "readfile('https://getcomposer.org/installer');" | php

### Install all dependencies

	php composer.phar install

### Run the unit tests

	php index_tests.php

### Generate the documentation

	php index_documentation.php

### Edit the installation

	nano index.php

### Cleanup for production

	./Cleanup.sh

## License

WebCMS is licensed under the GNU GPL v3 or later:

	WebCMS - A content management system (CMS) based on PHP
	Copyright (C) 2015 Simon Wächter (waechter.simon@gmail.com)
	
	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program.  If not, see http://www.gnu.org/licenses/
