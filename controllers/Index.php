<?php
class Index extends Controller{

    function __construct()
    {
        parent::__construct();
    }
    function index(){
        echo 'I am from index in controller';
    }
}