<?php
 //Step 1. get database connection
 require('../config/database.php');
 //Step 2. get form-data
 $f_name = trim ($_POST['fname']);
 $l_name = trim ($_POST['lname']);
 $m_number = trim ($_POST['mnumber']);
 $id_number = trim ($_POST['idnumber']);
 $e_mail = trim ($_POST['email']);
 $p_wd = trim($_POST['passwd']);

 //$enc_pass = password_hash($p_wd, PASSWORD_DEFAULT);
$enc_pass = md5($p_wd);

$check_email = "
     SELECT
        u.email
     FROM
        users u
     WHERE
        email = '$e_mail' 
     LIMIT 1         
";
$res_check = pg_query($conn, $check_email);
if(pg_num_rows($res_check)> 0){
   echo "<scrip> alert('User already exists !!')</script>";
    header('refresh:0;url=signup.html');
} else{
 //Step 3 create quary to insert into
   $query = "
   INSERT INTO users (
   firstname,
   lastname,
   mobile_number, 
   ide_number,
   email,
   password)
   values (
   '$f_name',
   '$l_name',
   '$m_number',
   '$id_number',
   '$e_mail',
   '$p_wd'
   )
   ";
   //Step 4.
   $res = pg_query($conn, $query);

   //Step 5. Validation
   if($res){
      //echo "User has been created successfully !!!";
      echo "<scrip> alert('Succes !!! Go to login')</script>";
      header('refresh:0;url=signin.html');
   } else {
      echo "Something wrong";
   }
}


?>