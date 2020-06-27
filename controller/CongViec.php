<?php

class CongviecController
{
    public function listAll()
    {
        $data = CongviecModel::listAll();        
        $VIEW = "./view/DanhSachCV.phtml";
        require("./template/template.phtml");
    }
    
    public function search($keyword)
    {
        $data = CongviecModel::find($keyword);
        $VIEW = "./view/DanhSachCV.phtml";
        require("./template/template.phtml");
    }

    public function page()
    {
        $pageno = $_REQUEST["number"];
        $data = CongviecModel::page($pageno);
        $VIEW = "./view/DanhSachCV.phtml";
        require("./template/template.phtml");
    }

    public function add()
    {
        $data = "";
        if (isset($_REQUEST["task_id"]))
        {
            $cv = new CongviecModel();
            $cv->task_id = $_REQUEST["task_id"];
            $cv->name = $_REQUEST["name"];
            $cv->description = $_REQUEST["description"];
            $cv->start_date = $_REQUEST["start_date"];
            $cv->due_date = $_REQUEST["due_date"];
            $cv->category_id = $_REQUEST["category_id"];
            $result = CongviecModel::add($cv);
            if ($result == 1)
                $data = "Thêm thành công";
            else
                $data = "Thêm bị lỗi";        
        };
        
        $VIEW = "./view/ThemCV.phtml";
        require("./template/template.phtml");
    }

    public function show()
    {
        $id = $_REQUEST["task_id"];
        $data = CongviecModel::get($id);
        $VIEW = "./view/ThongTinCV.phtml";
        require("./template/template.phtml");
    }

    public function delete()
    {
        $id = $_REQUEST["task_id"];
        $result = CongviecModel::delete($id);        
        $data = CongviecModel::listAll();        
        $VIEW = "./view/DanhSachCV.phtml";
        require("./template/template.phtml");
    }

    public function deleteMul($keyword)
    {
        $result = CongviecModel::deleteMul($keyword);
        $data = CongviecModel::listAll();        
        $VIEW = "./view/DanhSachCV.phtml";
        require("./template/template.phtml");
        if ($result == 1)
                $data = "Xóa thành công";
            else
                $data = "Xóa bị lỗi";
    }

    public function update()
    {
        $data = "";
        if (isset($_REQUEST["task_id"]))
        {
            $cv = new CongviecModel();
            $cv->task_id = $_REQUEST["task_id"];
            $cv->name = $_REQUEST["name"];
            $cv->description = $_REQUEST["description"];
            $cv->start_date = $_REQUEST["start_date"];
            $cv->due_date = $_REQUEST["due_date"];
            $cv->category_id = $_REQUEST["category_id"];
            $result = CongviecModel::update($cv);
            if ($result == 1)
                $data = "Cập nhật thành công";
            else
                $data = "Cập nhật bị lỗi";        
        };
        
        $VIEW = "./view/ThemCV.phtml";
        require("./template/template.phtml");
    }
}
?>
