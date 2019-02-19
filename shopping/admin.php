<?php
session_start();
$host = 'localhost';
$user='root';
$password = '';
$db = 'back';
$conn = mysqli_connect($host,$user,$password,$db);
$conn_error = mysqli_connect_error();
if($conn_error != null){
    echo "<p> We have a connection problem: " .$conn_error . "</p>";
}


//Удаляет продукт из списка
$namedel= filter_input(INPUT_POST,'namedel');
if ($namedel!=null){
    $query="DELETE FROM `prod` WHERE `id` = '$namedel'";
    $results = mysqli_query($conn, $query);
    header("Location:  prod.php?gender=".$gender."&update=1");
    die();
}

//Добавляет продукт в списки
$name=filter_input(INPUT_POST,'name');
$size=filter_input(INPUT_POST,'size');
$balance=filter_input(INPUT_POST,'balance');
$img=filter_input(INPUT_POST,'img');
$price=filter_input(INPUT_POST,'price');
$gender=filter_input(INPUT_POST,'gender');
if($name!=null){
    $query="SELECT * FROM `prod`";
    $results = mysqli_query($conn, $query);
    $id= mysqli_num_rows($results) + 1;
    echo mysqli_num_rows($results);
    $query="INSERT INTO `prod` (`id`, `gender`, `name`, `size`,`balance`, `img`, `price`) VALUES ('".$id."','".$gender."','".$name."','".$size."','".$balance."','','".$price."')";
    $results = mysqli_query($conn, $query);
    header("Location:  prod.php?gender=".$gender."&remember=1");
    die();
    //echo $query;
}


//Добавляет продукт в корзину
$basketid=filter_input(INPUT_GET,'basket');
if($basketid!=null){
    
    if ( isset($_SESSION['basket']) ) {
        $session = $_SESSION['basket'];
        echo "session was set ";
        if(array_key_exists($basketid,$session)){
            $value=$session[$basketid]+1;
        }
        else{
            $value=1;
        }
        $session[$basketid]=$value;
        $_SESSION['basket']=$session;
        echo $basketid."'s  count is ".$value;

    }
    else{
        echo "I created the session and key, now count is 1";
        $value=1;
        $_SESSION['basket']=array($basketid => $value);
    }
}


//Удаляет продукт из корзины
$remove=filter_input(INPUT_GET,'remove');
if($remove!=null){
    echo $remove;
    unset($_SESSION['basket'][$remove]);
}


//меняет кол-во продукта в корзине
$idc=filter_input(INPUT_GET,'idc');
$valuec=filter_input(INPUT_GET,'change');
if($idc!=null){
    $_SESSION['basket'][$idc]= $valuec;
    echo "[".$idc.",".$valuec."]";
}


//add img
$msg = '';
if(isset($_POST['insert'])){
    $target = "css/images".basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    $sql = "UPDATE `prod` SET `img`= ('".$image."') WHERE `img`=''";
    echo mysqli_query($conn, $sql);
    if(move_uploaded_file($_FILES['image']['name'], $target)){
        $msg = "Success";
    }else{
        $msg = "Fail";
    }
}

//Покупка
$buy=filter_input(INPUT_GET,'buy');
if($buy!=null){
    $session = $_SESSION['basket'];
    if(isset($_COOKIE['user'])){
        echo "buy1";
    }
    else{
        echo "buy0";
    }
}


mysqli_close($conn);













