<?php

include_once("cooks.php");

include("db.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require '../includes/PHPMailer-master/src/Exception.php';
	require '../includes/PHPMailer-master/src/PHPMailer.php';
	require '../includes/PHPMailer-master/src/SMTP.php';
include '../includes/simple_html_dom.php';


$con=mysqli_connect($server, $db_user, $db_pwd,$db_name) //connect to the database server
or die ("Could not connect to mysql because ".mysqli_error());

mysqli_select_db($con,$db_name)  //select the database
or die ("Could not select to mysql because ".mysqli_error());

$sqlct = "SELECT * FROM Contact WHERE ID = 5 ";
$contactinf = mysqli_query($con, $sqlct);
$contactinf = mysqli_fetch_assoc($contactinf);



//prevent sql injection

//$username=mysql_real_escape_string($_POST["username"]);

$oldpassword = mysqli_real_escape_string($con,$_POST["oldpassword"]);

$password = mysqli_real_escape_string($con,$_POST["password"]);

$username = $_SESSION['username'];



//check if user is having account

$query = "select * from " . $table_name . " where username='$username'";

$result = mysqli_query($con,$query) or die('error');

$row = mysqli_fetch_array($result);

$email = $row['email'];

$match=0;

if (mysqli_num_rows($result)) {

	

	$dbpass=$row['password'];

	

	if(phpversion() >= 5.5)

			{

				if(password_verify($oldpassword, $dbpass))

				{

					$match=1;

					$pwd=password_hash($password,PASSWORD_DEFAULT);

				}

				

			}

	else

	{

		if(crypt($oldpassword,$dbpass)==$dbpass)

		{

			$match=1;	

			$pwd = crypt($password,'987654321');

		}

	}

	 if($match==1){

		

    //$pwd = crypt($password);

    $query = "update " . $table_name . "	 set password='$pwd' , activ_status=1 where username='$username'";

    $result = mysqli_query($con,$query) or die('error');





    //send email for the user with password



 $to = $email;
        $subject = $contactinf['Name']." | Password Reset";
    $_SESSION['passwordmess'] = "Your password was successfully reset!";
    $html = file_get_html("https://".$_SERVER['HTTP_HOST']."/Users/Emails/resetpasswordtemplate.php?message=".urlencode($_SESSION['errormessage']));
         
           
           // first check if $html->find exists

$cells = $html->find('html');

if(!empty($cells)){
	
	
	foreach($cells as $cell) {
     
         $mail  = new PHPMailer(); // defaults to using php "mail()"
         
         
         
         $mail->AddReplyTo($contactinf['Email'], $contactinf['Name']);
         $mail->SetFrom($contactinf['Email'], $contactinf['Name']);
         $mail->AddReplyTo($contactinf['Email'], $contactinf['Name']);
         $address = $to;
         $mail->AddAddress($to, $row['First_Name']);
         
         $mail->Subject    = $subject;
         
         
         $mail->isHTML(true);
         $mail->Body= $cell->outertext;
         
         
         
         
         
         if(!$mail->Send()) {
         	
         	
         	
         }
    
    
    
    
    
     
    
      echo'<script>location.href = "../account.php#changehe";</script>';
      
	}   
    
}
    
    

	 else{

	 	$_SESSION['passwordmess'] ="Your current password is incorrect.";		//passwordmismatch

	 }

} else {

	$_SESSION['passwordmess'] = "Cannot change password:Username/password mismatch";		//password mismatch

}



echo'<script>



window.location.href = "../account.php#changehe";



</script>';





?>