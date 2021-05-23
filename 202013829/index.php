<!--#Revision history:
#
#DEVELOPER                      DATE                    COMMENTS
#Tejvir Dhami (202013829)   2021-01-30 Created      NetBeans project and empty folders.
#Tejvir Dhami (202013829)   2021-02-21 Created      Created Php common functions.
#Tejvir Dhami (202013829)   2021-02-23 Created      Created Home Page along with others.
#Tejvir Dhami (202013829)   2021-03-01 Created      Achieved almost 60% of the project.
#Tejvir Dhami (202013829)   2021-03-03 Created      Finished 80%.
#Tejvir Dhami (202013829)   2021-03-13 Created      Finished all the Pages 100%-->
<?php

#defining the costants for folder and functons!
define("FOLDER_PHP", "PHP/");
define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");

#importing the PHP common functions file    
require_once FILE_PHP_FUNCTIONS; #use constants

#Called the function to create the page top
createPageTop("Home Page");

#To create ads
createAdd();

#To create description
createDescription();

#To create page bottom
createpageBottom();
?>

