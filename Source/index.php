<?php
    if(!isset($_COOKIE["username"])){
        $controller = "HomeController";
        $action = "login";
        require 'Controller/'.$controller.'.php';
        $controllerObj = new $controller;
        $controllerObj->$action();
    }else{
        $controller = (isset($_GET['controller']))?ucfirst(strtolower($_GET["controller"])):"Home";
        if(isset($_GET["action"]))
            $action = ($_GET["action"]);
        else $action = "index";
        if(isset($_COOKIE["username"]) && $_COOKIE["username"] == "admin"){
            $controller = 'AdminController';
            require 'Controller/'.$controller.'.php';
            $controllerObj = new $controller;
            $id = (isset($_GET["id"]))?max((int)$_GET["id"], 1):1;
            if($action == "watch") $controllerObj->$action($id);
            else $controllerObj->$action();
        }else{
            $nameController = $controller;
            $controller = $controller.'Controller';
            require 'Controller/'.$controller.'.php';
            $controllerObj = new $controller;
            switch($nameController){
                case "Home":
                    switch($action){
                        case "index":
                            $page = (isset($_GET["page"]))?max((int)$_GET["page"], 1):1;
                            $controllerObj->$action($page);
                            break;
                        case "search":
                            $search_input = (isset($_GET["search-input"]))?$_GET["search-input"]:"";
                            $controllerObj->$action($search_input);
                            break;
                        default:
                            $controllerObj->$action();
                            break;
                    }
                    break;
                case "User":
                    switch($action){
                        case "getProfileOfUser":
                            $user = $_GET["username"];
                            $controllerObj->$action($user);
                            break;
                        case "getPlaylist":
                            $id = $_GET["id"];
                            $controllerObj->$action($id);
                            break;
                        default:
                            $controllerObj->$action();
                            break;
                    }
                    break;
                case "Video":
                    $id = (isset($_GET["id"]))?max((int)$_GET["id"], 1):1;
                    if($action == "watch") $controllerObj->$action($id);
                    else $controllerObj->$action();
                    break;
                default:
                    $controllerObj->$action();
                    break;
            }
        }
    }
?>