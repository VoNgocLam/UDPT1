<?php

class HomeController
{
    public function index()
    {
        $data = "Sinh viên thực hiện: 1612321 - Võ Ngọc Lâm";        
        $VIEW = "./view/TrangChu.phtml";
        require("./template/template.phtml");
    }
}
