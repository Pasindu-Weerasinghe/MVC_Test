<?php
class Test extends Controller{

    function __construct()
    {
        parent::__construct();
    }
    function index(){
        //echo 'I am from test in controller';
       // $this->model->printSomeThing();
       $this->view->users= $this->model->getData();
       $this->view->render('Test');
    }
}