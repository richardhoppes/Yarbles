Requirements:
PHP 5.3.0 (mainly for namespaces and type hinting)

To run Yarbles locally:

*Modify hosts file to include an entry for the framework.  Your development url can be whatever you choose.

For example:
127.0.0.1 webdev.yarbles.richardhoppes.com

*Change base_url under the [development] section in config/AppConfig.ini to match your host entry.

[development]
base_url=http://webdev.yarbles.richardhoppes.com

*Create an apache vhosts entry.

<VirtualHost *:80>
  DocumentRoot /path/to/project
  ServerName webdev.yarbles.richardhoppes.com
</VirtualHost>

*Start up Apache, and try it out!