<?php

    // Checking if the user is coming through a POST request and not by using a URL copy/paste (a GET request)
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // echo "Submitted";
        echo '<div class="alert alert-danger" role="alert">Please note that email() PHP function doesn\'t work on localhosts!</div>';


        // Assigning variables
        // $userName  = filter_var($_POST['username'], FILTER_SANITIZE_STRING); // Deprecated
        $userName  = htmlspecialchars($_POST['username']);

        $email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $cellPhone = filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT);

        // $message   = filter_var($_POST['message'], FILTER_SANITIZE_STRING); // Deprecated
        $message   = htmlspecialchars($_POST['message']);



        /*
        // 2nd method for showing errors
        $usernameError = ""; // Just defining the variable
        $messageError = "";  // Just defining the variable
        if (strlen($userName) <= 3) {
            $usernameError = "Username must be larger than 3 characters";
        }
        if (strlen($message) < 10) {
            $messageError = "Message must be larger than 10 characters";
        }
        */
        
    
        // 1st method for showing errors
        // Creating an array of all errors possible
        // Validation
        $formErrors = array();

        if (strlen($userName) <= 3) {
            $formErrors[] = "Username must be larger than <strong>3</strong> characters";
        }

        if (strlen($message) < 10) {
            $formErrors[] = "Message must be larger than <strong>10</strong> characters";
        }
        
        // In case of No Errors, Mail is sent.  Mail(To, Subject, Message, Headers, Parameters)
        $headers = 'From:' . $email . '\r\n';

        if (empty($formErrors)) {
            mail('john.doe@example.com', 'Contact Form', $message, $headers); // Mail Function DOESN'T work using LOCAL or FREE HOSTS, it requires SMTP server for sending emails    // https://www.php.net/manual/en/function.mail.php

            $userName       = '';
            $email          = '';
            $cellPhone      = '';
            $message        = '';
            $successMessage = '<div class="alert alert-success>We have received your message successfully.</div>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--Bootstrap 3-->
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--Bootstrap 3-->
        <title>Contact Form</title>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900,900i">
        <link rel="stylesheet" href="css/style.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--Form start-->
        <div class="container">
            <h1 class="text-center">Contact Us</h1>
            <form class="my-contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <?php
                    /* 1st method for showing errors */
                    if (! empty($formErrors)) { 
                ?>
                        <div class="php-errors alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php 
                                foreach ($formErrors as $error) {
                                    echo $error . "<br>";
                                }
                            ?>
                        </div> 
                <?php
                    }
                ?>
                <?php
                    if (isset($successMessage)) {
                        echo $successMessage;
                    }
                ?>
                    <div class="form-group">
                        <input    class="username form-control" type="text"  name="username"  placeholder="Type in your Username" value="<?php if (isset($userName)) {echo $userName;} ?>"> <!-- Used the if condition to repopulate the HTML Form after detecting validation errors -->
                        <i class="fa fa-user fa-fw" aria-hidden="true"></i>
                        <span class="asterisk">*</span>
                        <div class="alert alert-danger my-custom-alert">Username must be larger than <strong>3</strong> characters</div>
                    </div>
                    <?php /* 2nd method */ /* if (isset($usernameError)) {echo $usernameError;} */ ?>
                        <div class="form-group">
                            <input    class="email form-control" type="email" name="email"     placeholder="Type in a valid Email" value="<?php if (isset($email)) {echo $email;} ?>"> <!-- Used the if condition to repopulate the HTML Form after detecting validation errors -->
                            <i class="fa fa-envelope fa-fw" aria-hidden="true"></i>
                            <span class="asterisk">*</span>
                            <div class="alert alert-danger my-custom-alert">Email can't be <strong>Empty</strong></div>
                        </div>
                    <input    class="form-control" type="text"  name="cellphone" placeholder="Type in your Cellphone Number" value="<?php if (isset($cellPhone)) {echo $cellPhone;} ?>"> <!-- Used the if condition to repopulate the HTML Form after detecting validation errors -->
                    <i class="fa fa-phone fa-fw" aria-hidden="true"></i>
                    <div class="form-group">
                        <textarea class="message form-control"              name="message"   placeholder="Type in your Message!"><?php if (isset($message)) {echo $message;} ?></textarea> <!-- Used the if condition to repopulate the HTML Form after detecting validation errors -->
                        <span class="asterisk">*</span>
                        <div class="alert alert-danger my-custom-alert">Message must be larger than <strong>10</strong> characters</div>
                    </div>
                    <?php /* 2nd method */ /* if (isset($messageError)) {echo $messageError;} */ ?>
                    <input    class="btn btn-success" type="submit" value="Submit Your Message">
                    <i class="fa fa-paper-plane fa-fw send-icon" aria-hidden="true"></i>
            </form>
        </div>
        <!--Form end-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>