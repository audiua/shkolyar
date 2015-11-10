<?php

function d($d=null){print_r($d); die;};
class PageWeightCommand extends CConsoleCommand
{

	private $_parseUrl=array();

    public function actionParse($url) {
    	Yii::app()->db->createCommand()->truncateTable(PageWeight::model()->tableName());
    	Yii::app()->db->createCommand()->truncateTable(PageWeightList::model()->tableName());


    	Yii::import('ext.curl.Curl');
    	require_once Yii::app()->basePath . '/extensions/simple_html_dom.php';

		$this->_parseUrl = parse_url($url);

		$page= new PageWeight;
		$page->url = '/journal';
		$page->parse = 0;
		if( ! $page->save() ){
			print_r( $page->getErrors() );
		}

		$page=null;		
    	do{

    		if($page){
    			$pageUrl=$this->_parseUrl['scheme'].'://'.$this->_parseUrl['host'].'/'.$page->url;
    		} else {
    			$pageUrl=$this->_parseUrl['scheme'].'://'.$this->_parseUrl['host'].'/journal';
    		}



    		$curl=new Curl;


	    	$response = $curl->get( $pageUrl );

	    	if($response['error']){
	    		// проверить ошибку
	    		print_r($response['error']);
	    	}

	    	if( $response['body'] ){
	    		// d($response['body']);

	    		$html = str_get_html($response['body']);

		    	foreach($html->find('a') as $element) { 

		    		// проверка ссылок
		    		$uri=$this->checkLink($element->href);
		    		if( ! $uri ){
		    			continue;
		    		}

		    		$pageWeight = PageWeight::model()->findByAttributes(array('url'=>$uri));
		    		if(!$pageWeight){

			    		// сохраняем только uri
			    		$pageWeight = new PageWeight;
			    		$pageWeight->url = $uri;
			    		$pageWeight->parse = 0;
			    		
			    		if( ! $pageWeight->save() ){
			    			print_r( $pageWeight->getErrors() );
			    		}
		    		}

		    		if($page){
			    		// сохраняем ссылки на странице
			    		$pageLink = new PageWeightList;
			    		$pageLink->page_in = $pageWeight->id;
			    		$pageLink->page_out = $page->id;
						$pageLink->save();
		    		}

		    	}
	    	}

	    	// флаг для смещения поиска по базе, еще не парсенных страниц
	    	if($page){
	    		$page->parse=1;
	    		$page->update();
	    	}

	    	// берем по одной страничке на парсинг ссылок
	    	$criteria=new CDbCriteria;
	    	$criteria->condition='t.parse=0';
	    	$page = PageWeight::model()->find($criteria);

    	} while($page);

    }



    private function checkLink($url){
		if( stripos($url, 'journal') === false ){
			return '';
		}
		$part = parse_url($url);


		if( ! isset($part['path'] ) || empty($part['path']) ){
			return '';
		} 

		if( $part['path']=='#' || $part['path']=='/' ){
			return '';
		}

		$type=array('rar', 'zip', 'pdf', 'gif', 'png', 'jpeg', 'jpg', 'txt','xml',);
		$typePart=explode('.', $url);
		if($typePart){
			$last=$typePart[count($typePart)-1];
			
			if( in_array(strtolower($last), $type) ){
				return '';
			}
		}

		$uri=( $part['path']{0} == '/' ) ? $part['path'] : '/'.$part['path'];
		$uri.= isset($part['query']) ? '?'. $part['query']: '' ;

    	return $uri;
    }







}