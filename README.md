# Web-CMS

## Introduction

Web-CMS is a content management system (CMS) based on PHP that allows a user to create, edit and delete his own content. All data are stored in a database, so the user can add, edit and remove his own content.

## Installation

The CMS runs on any Apache based system with a PHP and MySQL setup. For other systems than Linux, you have to provide the required packages by your own.

### Install all system dependencies

	sudo apt-get install apache2 php5 php5-xsl php5-mysql mysql-client

### Clone the repository

	cd /var/www/
	git clone https://github.com/swaechter/web-cms.git
	cd web-cms

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

	rm composer.phar
	rm index_tests.php
	rm index_documentation.php

## License

Web-CMS is licensed under the GNU GPL v3 or later:

	Web-CMS - A content management system (CMS) based on PHP
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
