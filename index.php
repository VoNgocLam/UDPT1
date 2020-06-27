<?php
require_once("./controller/Home.php");
require_once("./controller/CongViec.php");
require_once("./model/CongViec.php");
require_once("config/dbconnect.php");

$action = "";
if (isset($_REQUEST["action"]))
{    
    $action = $_REQUEST["action"];
}
 


switch ($action)
{
    case "list":      
        $controller = new CongviecController();
        $controller->listAll();
        break;
    case "page":
        $controller = new CongviecController();
        $controller->page();
        break;
    case "search":
        $controller = new CongviecController();
        $keyword = $_REQUEST["keyword"];
        $controller->search($keyword);
        break;
    case "add":
        $controller = new CongviecController();
        $controller->add();
        break;
    case "delete":
        $controller = new CongviecController();
        $controller->delete();
        break;
    case "update":
        $controller = new CongviecController();
        $controller->update();
        break;
    case "deleMul":
        $controller = new CongviecController();
        $keyword = $_REQUEST["ids"];
        $controller->deleteMul($keyword);
        break;
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}

?>


<script type="text/javascript">
    function checkForm()
    {
        var macv = document.getElementsByName("task_id")[0].value;
        var tencv = document.getElementsByName("name")[0].value;
        var motacv = document.getElementsByName("description")[0].value;
        var ngaybt = document.getElementsByName("start_date")[0].value;
        var ngaykt = document.getElementsByName("due_date")[0].value;
        var loaicv = document.getElementsByName("category_id")[0].value;
        if (macv == "" || tencv == "" || motacv == "" || ngaybt == "" ||ngaykt == "" || loaicv == "")
        {
            alert ("Nhập đầy đủ thông tin");
            return false;
        }
        return true;
    }
</script>
