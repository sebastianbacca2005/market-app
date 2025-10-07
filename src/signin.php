<?php
//step1. get database connection
$e_mail = $_POST['email'];
$p_wd = $_POST['passwd'];

 //$enc_pass = password_hash($p_wd, PASSWORD_DEFAULT);
$enc_pass = md5($p_wd);

//Step 3. query to validate data
$sql_check_user = "
select 
 	u.email,
 	u.password
from 
	users u 
where	
	u.email = '$e_mail' and 
	u.password = '$enc_pass'
limit 1	

";

//step 4. execute query
$res_check = pg_query($conn, $sql_check_user);

if(pg_num_rows($res_check)> 0){
   echo "User exist. Go to main page !!!!";
   header('refresh:0;url=main.php');

} else {
    echo "Verify data";
}