# Leave Management Sysytem

## Installation 

Clone the git repo from the developer's github
`git clone https://github.com/munyua-arch/leave/`



## Setup

Install Composer php Package manager
`https://getcomposer.org/download/`

run the following commands in your terminal using composer
`composer install`

this command installs the missing codeigniter4 framework located in the vendor files.
In composer.json file, if ci4 has no current version, update the file 

>"require": {
>       "php": "^8.1",
>      "codeigniter4/framework": "^4.5.0"
> },

to the version that was committed to github

## Usage

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> The end of life date for PHP 7.4 was November 28, 2022.
> The end of life date for PHP 8.0 was November 26, 2023.
> If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> The end of life date for PHP 8.1 will be November 25, 2024.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
