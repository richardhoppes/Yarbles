##Requirements

PHP 5.3.0 (mainly for namespaces and type hinting)

##To Run Locally

###1. Modify your hosts file
*****
  
  Modify hosts file to include an entry for the framework.  Your development url can be whatever you choose.
  
  Example:

  127.0.0.1 webdev.yarbles.richardhoppes.com


###2. Change base_url property
*****

  Change base_url under the [development] section in config/AppConfig.ini to match your host entry

  Example: 

  base_url=http://webdev.yarbles.richardhoppes.com


###3. Create an apache vhosts entry
*****

  &lt;VirtualHost *:80&gt;

  DocumentRoot /path/to/project

  ServerName webdev.yarbles.richardhoppes.com

  &lt;/VirtualHost&gt;


###4. Start Apache and test it!
*****

Once Apache is running, go to http://***your-base-url*** in your browser.

By default, going to the root url shoudl run the main method in the hearbeat controller.  If it is working, you should see something like: 

{"status":"OK","application":"Test App","application_version":"1.0.0.final","framework":"Yarbles","framework_version":"2.0.0.beta"}