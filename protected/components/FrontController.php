<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller{


	const CACHE_TIME = 14400;

	public $param;
	public $cache;
	private $_cacheId='cache';
	
	public $keywords='';
	public $description='';

	public function init(){
		$this->param = $this->getActionParams();
		if( ! Yii::app()->user->isGuest){
			$this->_cacheId = 'cacheDummy';
		}

		$this->cache = Yii::app()->getComponent($this->_cacheId);
	}


	public function beforeAction($action){

		// технические работы из админки
		if( $action->id !== 'login'){
			$break = Setting::model()->cache(3600)->findByAttributes(array('field'=>'teh_break'));
			if($break && $break->value){
				$this->renderPartial('application.helpers.support');
				Yii::app()->end();
			}
		}
		
		return parent::beforeAction($action);
	}

	public function getInsideLink(){

		if (Yii::app()->user->isGuest) {
			return '';
		}

		$str = '<li>';
		$str .= CHtml::link(Yii::app()->user->role, array('/inside/admin'), array('target'=>'_blank', 'class'=>'btn btn-default'));
		$str .= '</li>';
		return $str;

	}
}