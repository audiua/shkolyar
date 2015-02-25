<?php

class LikeWidget extends CWidget{

	public $params = array();

	public function init(){
        parent::init();
        if(!isset($this->params['id'])){
        	$this->params['id'] = '';
        }
    }

	public function run(){

       // передаем данные в представление виджета
       $this->render('index', array('id'=>$this->params['id']));
   }

}