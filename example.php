<?php

// Include the Wsoum CAPTCHA library
include('wcaptcha.lib.php');

// Set the api key
define('wcaptcha_api','API_KEY',true); // Your API key, you can get it from: https://captcha.wsoum.eu.org/get_key

// Setup the Wsoum CAPTCHA object
$wcaptcha = new wcaptcha(wcaptcha_api, 'ar');


if(isset($_POST["submit"])){
	

if(!empty($_POST["wcaptcha_input"])){

	// Check the validation of the sended CAPTCHA
	if ($wcaptcha->valid()){
	
		echo 'تم التحقق بنجاح';
	
	} else {
	
		echo 'رمز الكابتشا خاطئ';
	
	}

} else {
		echo 'لم تدخل رمز الكابتشا';
}

	
}

?>

<form action="" method="POST">
<h2>النموذج</h2>

<input type="text" name="name" placeholder="الاسم">

<?php
	
//  Print the CAPTCHA field
$wcaptcha->field(/*$background =*/ '#fafafa', /*$border =*/ '#000');

?>

<input type="submit" name="submit" value="ادخال">


</form>
