<?php
class CongviecModel
{
    public $task_id;
    public $name;
    public $description;
    public $start_date;
    public $due_date;
    public $category_id;
    public $category_name;

    function __construct() {
        $this->task_id = "";
        $this->name = "";
        $this->description = "";
        $this->start_date = "";
        $this->due_date = "";
        $this->category_id = "";
        $this->category_name = "";
    }
   
    public static function listAll() {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT task.id, task.name, task.description, task.start_date, task.due_date, category.name as catename FROM task LEFT JOIN category ON task.category_id=category.id";
        $result = $mysqli->query($query);
        $dscv = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $cv = new CongviecModel();
                $cv->task_id = $row["id"];
                $cv->name = $row["name"];
                $cv->description=$row["description"];
                $cv->start_date=$row["start_date"];
                $cv->due_date=$row["due_date"];
                $cv->category_name=$row["catename"];     
                $dscv[] = $cv; //add an item into array
            }
        }
        $mysqli->close();
        return $dscv;
    }
    
    public static function page($pageno) {

        if (empty($pageno)) {
            $pageno = 1;
        }

        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        

        $query = "SELECT COUNT(*)  FROM task";
        $result = $mysqli->query($query);
        $total_rows=mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT task.id, task.name, task.description, task.start_date, task.due_date, category.name as catename FROM task LEFT JOIN category ON task.category_id=category.id LIMIT $offset, $no_of_records_per_page";
        $result = $mysqli->query($sql);
        $dscv = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $cv = new CongviecModel();
                $cv->task_id = $row["id"];
                $cv->name = $row["name"];
                $cv->description=$row["description"];
                $cv->start_date=$row["start_date"];
                $cv->due_date=$row["due_date"];
                $cv->category_name=$row["catename"];     
                $dscv[] = $cv; //add an item into array
            }
        }
        $mysqli->close();
        return $dscv;
    }

    public static function add($cv)
    {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $id = $cv->task_id;
        $name = $cv->name;
        $description = $cv->description;
        $start_date = $cv->start_date;
        $due_date = $cv->due_date;
        $category_id = $cv->category_id;

        $query = "INSERT INTO task values ($id, '$name', '$description', '$start_date', '$due_date', '$category_id')";
        
        if ($mysqli->query($query))        
            return 1;        
        return 0;
    }
    
    public static function update($cv)
    {
        $mysqli = connect();
        $mysqli->query("SET NAMES utf8");
        $id = $cv->task_id;
        $name = $cv->name;
        $description = $cv->description;
        $start_date = $cv->start_date;
        $due_date = $cv->due_date;
        $category_id = $cv->category_id;

        $query = "UPDATE task SET  task.name= '$name', task.description = '$description', task.start_date ='$start_date',  task.due_date= '$due_date', task.category_id ='$category_id' WHERE task.id = '$id'";
    	
        if ($mysqli->query($query))        
            return 1;        
        return 0;
    }

    public static function delete($task_id)
    {
        $mysqli = connect();
        
        $mysqli->query("SET NAMES utf8");

        $query = "DELETE FROM TASK WHERE task.id = $task_id";
        
        if ($mysqli->query($query))        
            return 1;  
        $mysqli->close();    
        return 0;
    }

    public static function find($keyword) {
        $mysqli = connect();
        
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT task.id, task.name, task.description, task.start_date, task.due_date, category.name as catename FROM task LEFT JOIN category ON task.category_id=category.id WHERE   task.name LIKE '%$keyword%' or task.description LIKE '%$keyword%'";
        $result = $mysqli->query($query);
        $dscv = array();
        if ($result) 
        {            
            foreach ($result as $row) {
                $cv = new CongviecModel();
                $cv->task_id = $row["id"];
                $cv->name = $row["name"];
                $cv->description=$row["description"];
                $cv->start_date=$row["start_date"];
                $cv->due_date=$row["due_date"];
                $cv->category_name=$row["catename"];     
                $dscv[] = $cv; //add an item into array
            }
        }
        $mysqli->close();
        return $dscv;
    }

    public static function deleteMul($keyword) {
        $mysqli = connect();
        
        $mysqli->query("SET NAMES utf8");
        $query = "DELETE FROM TASK WHERE TASK.ID IN ($keyword)";
        
        if ($mysqli->query($query))        
            return 1;  
        $mysqli->close();    
        return 0;
    }


    public static function get($task_id) {
        $mysqli = connect();
        
        $mysqli->query("SET NAMES utf8");
        $query = "SELECT task.id, task.name, task.description, task.start_date, task.due_date, category.name as catname FROM task LEFT JOIN category ON task.category_id=category.id WHERE task.id = $task_id";
        $result = $mysqli->query($query);
    
        if  ($row = $result->fetch_object() ) {
            $cv = new CongviecModel();
            $cv->task_id = $row->task_id;
            $cv->name = $row->name;     
            $cv->description = $row->description;
            $cv->start_date = $row->start_date;   
            $cv->due_date = $row->due_date;   
            $cv->category_name = $row->category_name;   

        }

        $mysqli->close();
        return $cv;
    }
}  
?>
