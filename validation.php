<?php
$email = $_POST['email'];

if(empty($email)){
    echo "Email is required";
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "Invalid email format";
}
else{
    echo "Valid Email";
}
?>
