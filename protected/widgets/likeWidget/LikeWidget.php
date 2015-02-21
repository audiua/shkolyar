<?php

class LikeWidget extends CWidget{

	public $params = array();

	public function init(){
        parent::init();
    }

	public function run(){

       // передаем данные в представление виджета
       $this->render('index');
   }

}