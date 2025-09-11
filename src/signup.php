<?php
 //Step 1. get database connection
 require('../config/database.php');
 //Step 2. get form-data
 $f_name = $_POST['fname'];
 $l_name = $_POST['lname'];
 $m_number = $_POST['mnumber'];
 $id_number = $_POST['idnumber'];
 $e_mail = $_POST['email'];
 $p_wd = $_POST['passwd'];


 //Step 3.
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
 if(!$res){
    echo "User has been created successfully !!!";
 } else {
    echo "Something wrong";
 }
?>