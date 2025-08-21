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
		$vars['city'] =[ ['name'=>'Спб','id'=>1],['name'=>'Msc','id'=>2],['name'=>'Ekb','id'=>3],['name'=>'Novosib','id'=>4] ];
        $vars['testvar']['myname'] =  ['нулевой',1,'Vторой',3,4,'Пятый'] ;
		$vars['errorMsg'] = Session::getFlash('error');
        $extra_vars = [];
        $extra_vars['authorconentblock'] = 'ПРИВЕТ!!!!!!';
        $this->render($vars);
    }
    
    public function indexPost() {
        
	    $data = Request::postAll();
	    
	    $validator = new Validator($data, [
	        'first_name' => 'required|max:100',
	        'last_name' => 'required|max:100'
	    ]);
	    
	    // Устанавливаем читаемые имена полей
	    $validator->setFieldNames([
	        'first_name' => 'Имя',
	        'last_name' => 'Фамилия'
	    ]);
	    
	
	    if (!$validator->validate()) {
	        $errors = $validator->errors();
	        Session::flash('error', $errors ? array_shift($errors)[0] : 'Ошибка');
	        $this->response->redirect( Request::currentUri() );
	    }


    }
	
}
