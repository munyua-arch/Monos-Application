## MONOS APPLICATION
## Installation
Clone the git repository from the developer's GitHub:

bash
Copy code
git clone https://github.com/munyua-arch/Monos-Application
Setup
Install Composer (PHP Package Manager):

Download Composer from https://getcomposer.org/download/.
Run the following command in your terminal using Composer:

bash
Copy code
composer install
This command will install the necessary dependencies, including the CodeIgniter4 framework, which is located in the vendor folder.

Update CodeIgniter4 Version:

If the composer.json file does not specify the current version of CI4, update the version as follows:
json
Copy code
"require": {
    "php": "^8.1",
    "codeigniter4/framework": "^4.5.0"
}
This ensures you’re using the version of CodeIgniter4 that was committed to GitHub.
Import the Database:

Import the monos.sql database file into your MySQL server.
Email Feature Configuration
Open the Config/Email.php file and configure your email address and app password to ensure smooth email functionality:
php
Copy code
public string $SMTPUser = 'YOUR_EMAIL_ADDRESS';
public string $SMTPPass = 'YOUR_APP_PASSWORD';
Leave the rest of the configuration as default.
Usage
We use GitHub issues in our main repository to track BUGS and approved DEVELOPMENT work packages. For SUPPORT and FEATURE REQUESTS, you can visit our forum.

This repository is a "distribution" built by our release preparation script. Issues related to it can be raised on the forum or as issues in the main repository.

Server Requirements
To run the Business Directory System, you need the following:

PHP Version: PHP 8.1 or higher.
Required Extensions:
intl
mbstring
Additionally, ensure these extensions are enabled in PHP:

json (enabled by default, do not disable)
mysqlnd (if you plan to use MySQL)
libcurl (if you plan to use the HTTP\CURLRequest library)
Warning: The end of life date for PHP 7.4 was November 28, 2022. The end of life date for PHP 8.0 was November 26, 2023. If you are still using PHP 7.4 or 8.0, you should upgrade immediately. The end of life date for PHP 8.1 will be November 25, 2024.

