README
======

This directory should be used to place project specfic documentation including
but not limited to project notes, generated API/phpdoc documentation, or 
manual files generated or hand written.  Ideally, this directory would remain
in your development environment only and should not be deployed with your
application to it's final production location.

NOTE:
This application requires the Zend Framework.  Please make sure Zend Framework 
is available in your php_includes directory.

Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

Please replace the DocumentRoot path with the one where the application has been
extracted to.

`<VirtualHost *:80>
   # Update this line according to your system
   DocumentRoot "/usr/local/apache2/htdocs/php/addressbook/public"
   ServerName addressbook.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   # Update this line according to your system
   <Directory "/usr/local/apache2/htdocs/php/addressbook/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>
    
</VirtualHost>`
Next you need to edit your hosts file, add the following line to it.

`127.0.0.1   addressbook.local`

Setting Up Your Database
========================

The next step is to import the file addressbook.db.setup.sql into your MySQL Server

This will create the necessary table used by the application.


Configure MySQL Credentials
===========================

Update lines 11, 12 of application.ini file located in application/configs/
Insert the credentials of a MySQL user that has access to the addressbook table.
