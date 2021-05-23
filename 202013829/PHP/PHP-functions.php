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
define("FOLDER_IMAGES", "images/");
define("FOLDER_CSS", "CSS/");
define("FOLDER_DATA", "data/");

define("FILE_PURCHASES", FOLDER_DATA . "purchases.txt");

define("FILE_LOGO", FOLDER_IMAGES ."logo.png");
define("FILE_CAMERA", FOLDER_IMAGES ."camera.jpg");
define("FILE_LAPTOP", FOLDER_IMAGES ."laptop.jpg");
define("FILE_PHONE", FOLDER_IMAGES ."phone.jpg");
define("FILE_GADGETS", FOLDER_IMAGES ."gadgets.jpg");
define("FILE_EARPHONES", FOLDER_IMAGES ."earphones.jpg");
define("FILE_AIRPODS", FOLDER_IMAGES ."airpods.jpg");
define("FILE_CHEATSHEET", FOLDER_DATA ."cheatsheet.txt");

#defining the costants for folder and functons!
define("FILE_STYLES", FOLDER_CSS . "styles.css");

define("PRODUCT_MAX_LENGHT", 12);
define("FNAME_MAX_LENGHT", 20);
define("LNAME_MAX_LENGHT", 15);
define("CITY_MAX_LENGHT", 8);
define("COMMENT_MIN_LENGHT", 0);
define("COMMENT_MAX_LENGHT", 200);
define("PRICE_MIN", 0);
define("PRICE_MAX", 10000.00);
define("QUANTITY_MIN", 0);
define("QUANTITY_MAX", 100);
define("LOCAL_TAX",12.05);


#declare global variables
$errorProductName = "";
$errorFirstName = "";
$errorLastName = "";
$errorCity = "";
$errorComment = "";
$errorPrice = "";
$errorQuantity = "";


#open doctype
#This function is used globally to create page top
function createPageTop($title)
{   
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");

    #echo some HTML code
    ?><!DOCTYPE html>
        <html> <head><meta charset="UTF-8"> 
                
                <link rel='stylesheet' type='text/css' href="<?php echo FILE_STYLES; ?>">
                
                <title><?php echo $title?></title></head> <body class = "bg-color">
                
                <meta  name ="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    createLogo();
    createNavigationMenu();
    //To handle the errors
       function manageError($errorNumber, $errorString, $errorFile, $errorLine)
        {
            echo "An error occured on the website. Please consult log for details.";
            
            echo "An error occured in the file '$errorFile', on line $errorLine"
                . ". Error: $errorNumber   -   $errorString";
            
            die();
        }
        //TO handle the exceptions
        function manageException($error)
        {
            echo "An error occured on the website. Please consult log for details.";
            
            echo "An error occured in the file '" . $error ->getFile(). "', on line ".
                    $error->getLine() . "Error: " . $error ->getMessage();
            die();
        }

        set_error_handler("manageError");
        set_exception_handler("manageException");    
}


#create page footer
#This function is used globally to create page bottom
function createPageBottom()
{
    ?>  
        </body>
        <footer> Copyright Tejvir Dhami (202013829) &#xA9; <?php echo date("Y"); ?> </footer>
    </html>
    
    <?php
}


#create a navigation menu
#This function is used globally to create Navigation menu at the top
function createNavigationMenu()
{
    #USE CONSTANTS to create a common navigation menu
    ?>  
        <nav class="navigation-menu">
            <a class="navigation-item" href="index.php"><b>Home page</b></a>
            <br>
            <a class="navigation-item" href="buyingpage.php"><b>Buying Page</b></a>
            <br>
            <a class="navigation-item" href="orders.php"><b>Orders</b></a>
            <br><br>
        </nav>
     <?php
}

# This function is used to create a Logo on every page
function createLogo()
{
    ?>  
        <img src="<?php echo FILE_LOGO ?>" class="page-logo" alt="US">
     <?php
}


#Function to create the description on home page
function createDescription()
{
    ?> 
        <div class="home-description">
            <h1>The Tej's Story</h1>
            <h2>Our History</h2>
            <h3>
               Our goal is clear: to become the best Electronics Shop in the Montreal area.
               To do that, we provide an unrivaled selection of the best quality gadgets,
               a unique and enjoyable shopping experience, and extraordinary customer service.
               Our comprehensive warranties, free shipping, and professional support ensure our customer's
               total satisfaction even after their order is complete.
            </h3>
            <br/><br/>
            <h1>&#x23F0;</h1>
            <h2>Opening Hours</h2>
            <h3>Come Visit</h3>
            <h3>
                Mon - Fri: 9am - 6pm <br/>
                Sat: 10am - 2pm <br/>
                Sun: Closed <br/>
                <br/><br/><br/><br/><br/><br/>
            </h3>
        </div>
    <?php
}

//Function to create the form
function createForm()
{
//Initialising the variables
$errorProductName = "";
$errorFirstName = "";
$errorLastName = "";
$errorCity = "";
$errorComment = "";
$errorPrice = "";
$errorQuantity = "";
    
$ProductName="";
$FirstName="";
$LastName="";
$City="";
$Comments="";
$Price="";
$Quantity="";
$Subtotal="";
$TaxPercentage="";
$TaxAmount="";
$GrandTotal="";
$FinalPrice="";
    
# To check if the save button is clicked
    if(isset($_POST["save"]))
    {
        #To get posted value
        $ProductName = htmlspecialchars(trim($_POST["productname"]));
        $FirstName = htmlspecialchars(trim($_POST["firstname"]));
        $LastName = htmlspecialchars(trim($_POST["lastname"]));
        $City = htmlspecialchars(trim($_POST["city"]));
        $Comments = htmlspecialchars(trim($_POST["comments"]));
        $Price = htmlspecialchars(trim($_POST["price"]));
        $Quantity = htmlspecialchars(trim($_POST["quantity"]));
        
        
        #To check the product name is empty
        if(!$ProductName == "")
        {//To check if it starts with P or p
        if(! (substr($ProductName, 0,1) == "P" ||  substr($ProductName, 0,1) == "p"))
          {
                $errorProductName = "The first word must be P or p.";
            }
            //To check that length is not exceeded
        elseif(mb_strlen($ProductName) > PRODUCT_MAX_LENGHT)
            {
                $errorProductName ="The product name contain more than ". PRODUCT_MAX_LENGHT . "Character";
            }
        }
        else
        {
            $errorProductName = "The product name can not be empty";
        }
        
        #To check if the First Name is empty
        
        if($FirstName == "")
        {
            
            $errorFirstName = "The first name can not be empty";
        }
        else
        {
             //To check that length is not exceeded
            if(mb_strlen($FirstName) > FNAME_MAX_LENGHT)
            {
                $errorFirstName ="The first name cannot contain more than ". FNAME_MAX_LENGHT . " Character";
            }
        }
        
       #To check if the Last Name is empty
        
        if($LastName == "")
        {
            
            $errorLastName = "The last name can not be empty";
        }
        else
        {
             //To check that length is not exceeded
            if(mb_strlen($LastName) > LNAME_MAX_LENGHT)
            {
                $errorLastName ="The last name cannot contain more than ". LNAME_MAX_LENGHT . " Character";
            }
        }
        
        #To check if the City Name is empty
        
        if($City == "")
        {
            
            $errorCity = "The city can not be empty";
        }
        else
        {
             //To check that length is not exceeded
            if(mb_strlen($City) > CITY_MAX_LENGHT)
            {
                $errorCity ="The city cannot contain more than ". CITY_MAX_LENGHT . " Character";
            }
        }       
        #To check if the Comment is empty
        if($Comments == "")
        {
            
            $errorComment = "The Comments can not be empty";
        }
        else
        { //To check that length is between minimum and maximum
            if( mb_strlen($Comments) < COMMENT_MIN_LENGHT || mb_strlen($Comments) > COMMENT_MAX_LENGHT)
            {
                $errorComment ="The comments must contain characters between " . COMMENT_MIN_LENGHT. " and "  . COMMENT_MAX_LENGHT . ".";
            }
        } 

        
        #check the Price is empty
        if($Price == "")
        {
            
            $errorPrice = "The Price can not be empty";
        }
         //To check that value entered is a number
        elseif (!is_numeric($Price))
        {
            
            $errorPrice = "Please enter a numeric value bettween" . PRICE_MIN . " and "
                    . PRICE_MAX;
        }
        else
        {
            //To check that value entered is between maximum and minimum price
            if($Price < PRICE_MIN || $Price > PRICE_MAX)
            {
                $errorPrice ="The Price must be between " . PRICE_MIN. " and "  . PRICE_MAX . ".";
            }
        } 
        #check the Quantuty is empty
        if($Quantity == "")
        {
            
            $errorQuantity = "The quantity can not be empty";
        }
        elseif (!is_numeric($Quantity))
        {
            //To check that value entered is numeric
            $errorQuantity = "Please enter a numeric value bettween" . QUANTITY_MIN . " and "
                    . QUANTITY_MAX;
        }
        else
        {
            //To check that value entered is between maximum and minimum quantity
            if($Quantity < QUANTITY_MIN || $Quantity > QUANTITY_MAX)
            {
                $errorQuantity ="The quantity must be between " . QUANTITY_MIN. " and "  . QUANTITY_MAX . ".";
            }
        }         
        
        
        
        #To check if there are any errors
        if($errorProductName== "" && $errorFirstName== "" && $errorLastName== "" && $errorCity== "" && $errorComment== "" && $errorPrice== "" && $errorQuantity== "")
        {
                
            #To calculate the tax and final prize
            $Subtotal = $Price * $Quantity;
            $TaxPercentage = LOCAL_TAX / 100;
            $TaxAmount = number_format($TaxPercentage * $Subtotal, 2) ;
            $GrandTotal = $Subtotal + $TaxAmount;
            $FinalPrice = number_format($GrandTotal , 2);
            
            #Array to store all the data
            $array = array($ProductName, $FirstName, $LastName, $City, $Comments, $Price ,$Quantity, $Subtotal, $TaxAmount, $FinalPrice);
            
            #To Convert array into json
            $jason = json_encode($array);
            
            #Write the json into txt file
            file_put_contents(FILE_PURCHASES , $jason . "\r\n", FILE_APPEND);
            
            //Show the success message
            ?><h2 class="successalert" >Congratulations, You have successfully made the purchase.</h2><?php
            
            #Empty the variables
            $ProductName=""; $FirstName=""; $LastName=""; $City=""; $Comments=""; $Price=""; $Quantity="";
            
    }
    else 
    {
        ?><p class="alert" >Please fill the form.</p><?php
    }
    }    
    
    #To create Form
    ?>
        <div class="frm">
        <form action="buyingpage.php" method="post">
         
        <p>
            <label>Product Name:</label><br>
            <input type="text" name="productname"  value="<?php echo $ProductName ?>"><br>
            <span class="validationWarning">
                <?php echo $errorProductName; ?>
            </span>
        </p>   

        <p>
            <label>Customer First Name:</label><br>
            <input type="text" name="firstname"  value="<?php echo $FirstName ?>"><br>
            <span class="validationWarning">
                <?php echo $errorFirstName; ?>
            </span>
        </p>          
            
            
        <p>
            <label>Customer Last Name:</label><br>
            <input type="text" name="lastname"  value="<?php echo $LastName ?>"><br>
            <span class="validationWarning">
                <?php echo $errorLastName; ?>
            </span>
        </p>
            
        <p>
            <label>City:</label><br>
            <input type="text" name="city" value="<?php echo $City ?>"><br>
            <span class="validationWarning">
                <?php echo $errorCity; ?>
            </span>
        </p>

        <p>
            <label>Comments:</label><br>
            <input type="text" name="comments" value="<?php echo $Comments ?>"><br>
            <span class="validationWarning">
                <?php echo $errorComment; ?>
            </span>
        </p>         

         <p>
            <label>Price:</label><br>
            <input type="text" name="price" value="<?php echo $Price ?>"><br>
            <span class="validationWarning">
                <?php echo $errorPrice; ?>
            </span>
        </p>
        
        <p>
            <label>Quantity:</label><br>
            <input type="text" name="quantity"  value="<?php echo $Quantity ?>"><br>
            <span class="validationWarning">
                <?php echo $errorQuantity; ?>
            </span>
        </p>
          
          <input type="submit" value="Save" name="save">
        </form>
        </div>
    <?php
}


#create an AD
function createAdd()
{
    //Using array to display pictures randomly
     $ads = array(FILE_CAMERA, FILE_PHONE, FILE_LAPTOP, FILE_AIRPODS, FILE_EARPHONES, FILE_GADGETS);
     
     shuffle($ads);
     //To choose a special product to be shown with full width and red border
     if($ads[0]==FILE_LAPTOP)
     {
         echo "<a href='https://www.amazon.ca'><img class='specialproduct' src='" . $ads[0] . "'></img></a>";
     }
     else
     {
        echo "<a href='https://www.amazon.ca'><img class='advertising-picture' src='" . $ads[0] . "'></img></a>";
     }
}

//To read the purchase text file and put the data in a table
//This fuction reads the datad from the text file bu convertinfg the json into array then putting the array in the table
function readPurchase()
{
    echo '<h2 class ="orderdescription">These are your orders!</h2>';
    //To create table
              ?><table class="tbl">
                <th class="box">Product Id</th>
                <th class="box">First Name</th>
                <th class="box">Last Name</th>
                <th class="box">City</th>
                <th class="box">Comments</th>
                <th class="box">Price</th>
                <th class="box">Quantity</th>
                <th class="box">Subtotal</th>
                <th class="box">Taxes</th>
                <th class="box">Grand Total</th>
              
            <?php 
            //To check if the file exists
        if (file_exists(FILE_PURCHASES)){
        $fileHandle = fopen(FILE_PURCHASES , "r") or die("Can not open the file"); 
       
        //To check line by line
        while(!feof($fileHandle))
        {
            $data = array(json_decode(fgets($fileHandle)));

    //To create The Table body
       foreach ((array)$data as $value)
       {
           echo "<tr>";
           foreach ((array)$value as $element) {
                 echo '<td class="box">'.$element.'</td>';
           } 
          echo "</tr>";
       } 

        }
      echo "</table>";
      
    }
    //LINK to downlaod the cheat sheet
    ?>
                <div class="downloadsheet"><h2><a  href="<?php echo FILE_CHEATSHEET;?>" download>Download Cheat Sheet</a></h2></div></br></br></br></br>
      <?php
}