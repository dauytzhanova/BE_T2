<?php
session_start();



//Добавляет продукт в корзину
$basketid=filter_input(INPUT_GET,'basket');
if($basketid!=null){
    $session = session('basket');
    if (isset($session)) {
        echo "session was set ";
        if (isset($session[$basketid])){
            $value=$session[$basketid]+1;
            $session[$basketid]=$value;
        }
        else{
            $session[$basketid]=1;
        }
        session(['basket'=>$session]);
        echo $basketid."'s  count is ".$value;

    }
    else{
        echo "I created the session and key, now count is 1";
        $value=1;
        $session=array($basketid => $value);
        session(['basket'=>$session]);
    }
}

//Удаляет продукт из корзины
$remove=filter_input(INPUT_GET,'remove');
if($remove!=null){
    $session = session('basket');
    unset($session[$remove]);
    echo $remove;
}

//меняет кол-во продукта в корзине
$idc=filter_input(INPUT_GET,'idc');
$valuec=filter_input(INPUT_GET,'change');
if($idc!=null){
    $session = session('basket');
    $session[$idc]=$valuec;
    session(['basket'=>$session]);
    echo "[".$idc.",".$valuec."]";
}


//Покупка
$buy=filter_input(INPUT_POST,'buy');
if(isset($buy)){
    $session = session('basket');
    if(isset($_COOKIE['user'])){
        echo "buy1";
    }
    else{
        echo "buy0";
    }
}

