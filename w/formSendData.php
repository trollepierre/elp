<?php
}else
{// Dès qu'on envoie
    if ((isset($_POST["email"]))&&(isset($_POST["firstname"]))&&(isset($_POST["lastname"]))&&(isset($_POST["subject"]))&&(isset($_POST["message"]))) 
    { // Check if the "from" input field is filled out
        $mail = htmlentities($email);  // virer les saloperies de code
        $irstname = htmlentities($firstname);  // virer les saloperies de code
        $ubject = htmlentities($subject);  // virer les saloperies de code
        $essage = htmlentities($message);  // virer les saloperies de code
        
        $irstname = $_POST["irstname"];
        $ubject = $_POST["ubject"];
        $essage = $_POST["essage"];
        
        $mailcheck = spamcheck($_POST["mail"]); // Check if "email" email address is valid
    
        if ($mailcheck==FALSE) 
        {
            echo "<script>alert('Mon alerte dit ".$mail." apres ce mail : ".$irstname." ok');</script>";
        echo "Invalid input";
            header('Location: index.php?bug=OK8');  
        }else{
        $temps = 3600*24;   //Vous passez en argument le temps de validité (en secondes)
    
        $mail = $_POST["mail"];
                        // send mail
        echo "<script>alert('Mon alerte dit ".$mail." apres ce mail : ".$irstname." ok');</script>";
        header('Location: index.php?bug=OK11'); 
        echo "Thank you for sending us feedback";
                                            ?>  </form><?php
        header('Location: index.php?bug=OK10'); 
        }
    }else{
        echo "<script>alert('Mon alerte dit ".$mail." apres ce mail : ".$irstname." ok');</script>";
        header('Location: index.php?bug=OK9');  
    }
}
?>
