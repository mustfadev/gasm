<?php include'db.php';

function ago($time){
$periods = array("ثانية", "دقيقة", "ساعة", "يوم", "أسبوع", "شهر", "سنة", "عشر سنوات");
$lengths = array("60","60","24","7","4.35","12","10");
$now = time();
$difference = $now - $time;
$tense = "منذ";
for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
$difference /= $lengths[$j];
}
$difference = round($difference);
if($difference != 1) {
$periods[$j];
}
return "$tense $difference $periods[$j]";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="">
    <title><?=$row['name']?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="/css/stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Navbar</a>
    </nav>

    <main role="main" class="container">
        <div class="text-left mt-5 pt-5">            
            <?php
             $list = mysqli_query($db,"SELECT * FROM list");
             if(isset($_POST['submit'])){
                $UserName = filter_var($_POST['UserName'], FILTER_SANITIZE_STRING);
                $Password = filter_var($_POST['Password'], FILTER_SANITIZE_STRING);
                $select = filter_var($_POST['select'], FILTER_SANITIZE_STRING);
                $time = time(); 
                if(empty($UserName) || empty($Password)){
                    no("Field cannot be empty");
                }else{
                    $sql = mysqli_query($db,"INSERT INTO `list`(`name`, `pass`, `time`, `time2`) VALUES ('$UserName','$Password','$select','$time')");
                    if(isset($sql)){
                        yes("yes");
                    }
                }
            }
            
            ?>
            
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <small class="form-text text-muted">👤 Select UserName.</small>
                            <input type="text" name="UserName" class="form-control" placeholder="Enter UserName">
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="form-group">
                            <small class="form-text text-muted">🔐 Select Password.</small>
                            <input type="password" name="Password" class="form-control" placeholder="Enter Password">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <select name="select" class="form-control">
                        <option value="1">⏱ 1 Day</option>
                        <option value="7">⏱ 7 Day</option>
                        <option value="30">⏱ 30 Day</option>
                    </select>
                    <small class="form-text text-muted">⏰ Select User Activation Time.</small>
                </div>
                
                <button type="submit"  name="submit" value="submit" class="btn btn-dark">Add User</button>
            </form>
            
            <br> <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">UserName</th>
                        <th scope="col">Password</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($list as $l):?>
                    <tr>
<?php  
if($l['time'] == '1'){
    $timeMSG = time(); 
    $timeout = $timeMSG - 87000;
    mysqli_query($db,"delete from list where time2 < $timeout");
}elseif($l['time'] == '7'){
    $timeMSG = time(); 
    $timeout = $timeMSG - 609000;
    mysqli_query($db,"delete from list where time2 < $timeout");
}elseif($l['time'] == '30'){
    $timeMSG = time(); 
    $timeout = $timeMSG - 2610000;
    mysqli_query($db,"delete from list where time2 < $timeout");
}
?>
                        <th scope="row"><?=$l['id']?></th>
                        <td><?=$l['name']?></td>
                        <td><?=$l['pass']?></td>
                        <td><?=ago($l['time2'])?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>