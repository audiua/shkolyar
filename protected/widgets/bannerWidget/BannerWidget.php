<?php

class BannerWidget extends CWidget{

	public $params = array();
	public $model=null;

	public function init(){
		
		$banner = Banner::model()->findByAttributes(array('name'=>$this->params['name']));
		if( $banner){
			$this->model = $banner;
		}

        parent::init();
    }

	public function run(){

       // передаем данные в представление виджета
       $this->render('index');
   }

}