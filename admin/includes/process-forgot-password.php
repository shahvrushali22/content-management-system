<?php
  include_once ("admin_connection.php");
  if(isset($_POST['forgot_password'])){
      $email = $_POST['email'];

      $query = "SELECT * FROM users WHERE email = '{$email}'";
      $result = mysqli_query($connection,$query);

      //if(mysqli_num_rows($result)==1){
          $length = 50;
          $token = bin2hex(openssl_random_pseudo_bytes($length));
          $query = "UPDATE users SET token='{$token}' WHERE email='{$email}'";
          $result = mysqli_query($connection, $query);

          //code to send email
          $to = $email;
        $subject="RESET PASSWORD!!";

        $message = "To reset your password please click the below link<br>";
        $message .="<a href='http://localhost/blog-cms1/admin/reset.php?token={$token}'>http://localhost/blog-cms1/admin/reset.php?token={$token}</a>";

$header = "From:noreply@cms.com\r\n";
$header .= "MIME-version: 1.0\r\n";
$header .= "Content-Type: text/html\r\n";

if(mail($to, $subject, $message, $header)){
    echo "sent";
}else{
    echo "failed";
}

  }