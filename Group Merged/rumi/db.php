<?php
session_start();
class DB
{
    public $host;
    public $user;
    public $pass;
    public $dbname;
    public $con;

    public function DB()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->dbname = "payrolldb";
        $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
    }

}