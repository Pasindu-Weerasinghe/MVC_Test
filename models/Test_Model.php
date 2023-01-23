<?php

class Test_Model extends Model{
    function __construct()
    {
        parent::__construct();
    }

    function printSomeThing(){
        echo 'Hello from test model';
    }
    function getData(){
        return $this->db->runQuery("SELECT * from user");
    }
}