<?PHP 
$to = "agurghis@yahoo.com"; 
$subject = "Messsage from website";
$headers = "Name: Form Mailer";
$forward = 1;
$location = "thankyou.html";

$date = date ("l, F jS, Y"); 
$time = date ("h:i A"); 



$msg = "Message sent from website on date  $date, hour: $time.\n\n\n\n"; 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	foreach ($_POST as $key => $value) { 
		$msg .= ucfirst ($key) ." : ". $value . "\n\n"; 
	}
}
else {
	foreach ($_GET as $key => $value) { 
		$msg .= ucfirst ($key) ." : ". $value . "\n\n"; 
	}
}

mail($to, $subject, $msg); 
if ($forward == 1) { 
    header ("Location:$location"); 
} 
else { 
    echo "Thank you for your message. We will contact you as soon as possible."; 
} 

?>