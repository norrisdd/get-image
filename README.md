# get-image
A sample website application that accepts a URL on a form and returns a list of all images found on that page.

**Note**: The application does not take into account Javascript manipulation of the DOM, so sites heavily using frontend libraries such as Angular will not work with this.

 ## Libraries used
 - Slim Framework
 - Twig
 - PHPHtmlParser
 - Twitter Bootstrap (and dependencies)
 
 ## Installation
 1. PHP 7 is required with php-curl and php-mbstring packages.
 
 2. Install composer and run ``composer install`` in the base directory of the code checkout.
 
 3. Configure web server of choice (with support for ``.htaccess`` rewrite rules enabled) to point to the ``pub`` directory of the code checkout.

