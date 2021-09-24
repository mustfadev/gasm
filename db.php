<?php
//error_reporting(0);
$db = mysqli_connect('localhost' , 'root' , '' , 'apiUsers') OR  die('Not Connected'); mysqli_set_charset ($db , 'utf8');

$Version = "1.0"; // اصدار السكربت


$query = mysqli_query($db,"select * from settings");
$row = mysqli_fetch_assoc($query);

function get_rows($connection,$query){
$res = mysqli_query($connection,$query);
$result = array();   
if($res->num_rows !=0):
while($row = mysqli_fetch_array($res,MYSQLI_ASSOC))
    $result[] = $row;
    endif;
    return $result;
}

function r($sec,$url){
echo'<meta http-equiv="Refresh" content="'.$sec.'; url='.$url.'" />';
}

function yes($done){
 echo '<div class="alert alert-success" role="alert">'.$done.'</div>';
}

function no($error){
 echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
}

?>