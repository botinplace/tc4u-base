<?php
namespace MainApp\Controllers;

use Core\Controller;

class IndexController extends Controller {
    function __construct($pagedata=[]){
         parent::__construct($pagedata);
    }
    
    public function index() {
        $vars = [];
        $vars['mytasks_b'] = 'ПОКА!';
        $vars['key'] = 'key из контроллера!';
        $vars['value'] = 'value из контроллера!';
        $vars['mytasks_t'] = '{% if 1==1 %} ЛУПА {% endif %}';
        $vars['testvar1'] = [11,22,33,44,55];
        $vars['testvar']['myname'] =  ['нулевой',1,'Vторой',3,4,'Пятый'] ;
        $extra_vars = [];
        $extra_vars['authorconentblock'] = 'ПРИВЕТ!!!!!!';
        $this->render($vars);
    }
    
    public function indexPost() {
        
        if(isset($_POST['afile'])){
            var_dump( $_POST['afile'] );
        }
        
        if(isset($_FILES)){
            var_dump( $_FILES );
        }
            
    }
}