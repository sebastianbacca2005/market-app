<?php
//Step 1 .get databse acces
require('../config/database.php'),
//Step 2.get form-data
$f_name =$_POST['fname'];
$l_name = $_POST['lname'];
$m_number=$_POST['mnumber'];
$e_mail =$_POST['idnumber'];
$p_wl= $_POST['passwd'];
$enc_pass= password_hash($p_wd, PASSWORD_DEFAULT);

//step3.create query to insert into
$query = "
INSERT INTO users(
firstname,
mobile_number,
ide_number,
email,
password
)VALUES (
'$f_name',
'$l_name',
'$m_number',
'$e_mail',
'$p_wl',
)
";
//step 4.execute query
$res=pg_query($coon,$query);
//step 5.valite result
if($res){
    echo"user has been created successfully !!!";
}else{
    echo"something weong!";
}