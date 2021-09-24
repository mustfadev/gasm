<?php include'db.php';

//NameWebSite/api.php?user=admin&pass=123

@$name = $_GET['user'];
@$pass = $_GET['pass'];

$list = mysqli_query($db,"SELECT * FROM list where name='$name' AND pass='$pass'");
$list_R = mysqli_num_rows($list);

if(empty($name)){
    echo 'Error';
}elseif($list_R == 0){
    echo 'Error No data';
}elseif($list_R != 0){
    echo 'Login successful';
}


?>