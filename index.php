<?php session_start();
    $ruta= !empty($_GET['url']) ? empty($_GET['url']):"Home/index";
    $array = explode("/", $ruta);
    $controller= $array[0];
    $metodo = "index";
    $parametro ="";
    if(!empty($array[1])){
        if(!empty($array[1] !="")){
            $metodo=  $array[1];
        }
    }
    if(!empty($array[2])){
        if(!empty($array[2] !="")){
            for($i=2; $i<count($array); $i++)
            {
                $parametro .= $array[$i].",";
            }
            $parametro = trim($parametro, ",");
        }
    }
    require_once 'config/config.php';
    $dirControllers="Controllers".$controller.".php";
    if(file_exists($controller)){
        require_once $controller;
        $controller =new $controller();
        if(method_exists($controller,$metodo)){
            $controller->$metodo($parametro);
        }else{
            echo "No existe el metodo";
        }
    }else{
        echo "No existe el controlador";
    }
    
    //antes
    if(isset($_SESSION['usuario'])) {
        header('location: principal.php');
    }else{
        header('location: login.php');
    }


?>