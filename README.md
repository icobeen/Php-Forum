
# Php forum

forum project, a sophisticated amalgamation of cutting-edge features. From robust ReCAPTCHA integration and intricate date handling to dynamic environment variable management and formidable password hashing, our platform stands as a bastion of technological prowess. Designed to seamlessly blend security and functionality, our project is poised to redefine the forum experience while safeguarding user privacy with an impenetrable shield.
## Table of Contents
- [Index.php](#index-php)
- [Session,php, deconnexion.php,Login.php](#session-deconnexion-and-login-php)
- [Uploading Files and Images](#uploading-files-and-images)
- [date.php](#Dates-handling)
- [Additional Information](#additional-information)

  ## Index.php

  In the index.php file of this PHP forum project, you'll find a comprehensive setup aimed at ensuring smooth user interaction and robust data validation. At its core lies a ReCAPTCHA test seamlessly integrated to enhance security measures. Within designated zones on the interface, users are prompted to input vital information such as their name, last name, and age. Thanks to meticulous validation logic, any omission in these fields triggers clear error messages, guiding users toward completing the necessary information accurately. Moreover, the system is designed to promptly identify instances of invalid ReCAPTCHA entries, ensuring a stringent shield against automated bots. Through these thoughtful implementations, the index.php file not only fosters user engagement but also upholds the integrity and security of the forum environment. The empty() and isset() functions ,play pivotal roles in the validation process, ensuring that user inputs are accurately processed and errors are appropriately handled. The link here: " https://stackoverflow.com/questions/1219542/in-where-shall-i-use-isset-and-empty " provides valuable insights into the nuanced application of these functions
  ![index](https://github.com/icobeen/Php-Forum/assets/153369256/ec2c73f2-9ccd-4329-947b-14d7d598f713)

## Session,php, deconnexion.php,Login.php

In our project, we've implemented three crucial files dedicated to managing user sessions, handling environment variables, and enabling image uploads seamlessly within our PHP forum ecosystem.

login.php serves as the entry point where users input their credentials. Upon successful authentication, users are directed to session.php, where their session is initiated, ensuring secure access to forum features. Additionally, our system meticulously tracks user activity, recording visit counts to enhance user engagement and analytical insights, here's an example of using environement variables :
```php
<?php
if(empty($message)){ 
    if($username=="Ikram" && $password=="123"){
        session_start();
        $_SESSION["login"] = true;
        header("location:session.php");    
    }
}
?>

<?php      
session_start();
error_reporting(~E_WARNING);

if($_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
}
?>
<?php
if(empty($message)){   
    if($username=="Ikram" && $password=="123"){
        session_start();
        $_SESSION["login"] = true;
        header("location:session.php");    
    }
}
?>
```

## Uploading Files and Images

This PHP script allows users to upload files and images to the server. Here's how it works:

1. When a user submits a file through the form, the PHP script checks if the user is authorized by verifying the session variable `$_SESSION["autoriser"]`.
2. If the user is not authorized, they are redirected to the login page to authenticate.
3. The script checks the size and type of the uploaded file. It only allows files with the extensions `.jpeg` or `.png`, and the file size should not exceed 2MB.
4. If the file passes the validation checks, it is moved to the `uploads` directory on the server with a filename based on the user's login.
5. The user is then redirected to the `session.php` page.
Here's a simplified version of the PHP code responsible for handling file uploads:
```php
<?php
session_start();

// Check if user is authorized
if($_SESSION["autoriser"] != "oui"){
    header("location:login.php");
    exit();
}

// Check if file is uploaded
if($_FILES["photo"]["size"] > 0){
    // Validate file type and size
    if(!preg_match("#jpeg$|png$#",$_FILES["photo"]["type"])) {
        // Handle invalid file format
        $message = "<div class='erreur erreur_photo'>Format du fichier invalide (JPG/JPEG ou PNG seulement)!</div>";
    } elseif($_FILES["photo"]["size"] > 2000000) {
        // Handle file size limit exceeded
        $message = "<div class='erreur erreur_photo'>Fichier trop volumineux (Max: 2Mo)!</div>";
    } else {
        // Move uploaded file to uploads directory
        move_uploaded_file($_FILES["photo"]["tmp_name"], "./uploads/" . $_SESSION["login"] . ".png");
        header("location:./session.php");
    }
}
?>

```
## date.php

this script utilizes PHP's built-in functions to handle dates efficiently. It showcases techniques for processing user input, manipulating date values, and generating output messages based on the date input provided.
-Features:
Date Validation: Validates date input provided through a form submission.
Date Parsing: Parses the date string into day, month, and year components.
Date Conversion: Converts the date components into a human-readable format.
Error Handling: Provides feedback in case of invalid date format.

## Additional Information

Additionally, there's functionality in the script to save personal information to a file.txt upon successful login to the session. Moreover, there's a code snippet provided below that counts and displays the number of times a website has been visited:
```php
<?php

// Nom du fichier de compteur, Combien de fois une site est visitee
session_start();
$fp=fopen("cpt.txt", "r+");
$str=fgets($fp);

if ($_SESSION[' visited']!="yes") {

	// code...
	$str++;
	fseek($fp,0);
	fputs($fp,$str);
	
	$_SESSION['deja visitee']="oui";
}

echo $str;
?>


```
