<?php

class JjDonorLinkController extends FrontController{

	public function actionIndex($token=null){

		// d();

		if($token !== 'token'){
			Yii::app()->end();
		}

		$str = $this->getStr();

		$post = new ELivejournal('rompetrom', 'zmnxcbv123');
		$post->subject = 'Анонс '.$this->normalDate(time());
		$post->body = $str['description'] . $str['url'];
		if ($post->save())
		{
			echo "Entry's id: ".$post->id;
			echo "<br />Entry's url: ".$post->url;
		}
		else
		{
			echo '<b>Error (code '.$post->errorCode.'): </b>';
			echo $post->error;
		}

		Yii::app()->end();
	}

	private function getStr(){
		$time=time()-(7*24*60*60);
		$str =array();
		$criteria = new CDbCriteria;
		$criteria->condition='jj_public_time<'.$time;
		$criteria->addCondition('check_link=1');
		$criteria->order='jj_public_time ASC';

		$link = Link::model()->find($criteria);
		$link->jj_public_time = time();
		$link->update();
		$str['url']=$link->from_url;

		$page = $this->curl($link->from_url);

		file_put_contents(Yii::app()->basePath.'/runtime/tmp_page.txt', $page);
		$meta = get_meta_tags(Yii::app()->basePath.'/runtime/tmp_page.txt');
		$str['description'] = isset($meta['description'])? $meta['description'] : '' ;
		return $str;
	}

	protected function curl($url){
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		// curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30);
		return curl_exec($curl);
	}

	
	private function normalDate($date){
	    $month=array(
	    'January'=>"Січня",'February'=>"Лютого",'March'=>"Березня",
	    'April'=>"Квітня",'May'=>"Травня",'June'=>"Червня",
	    'July'=>"Липня",'August'=>"Серпня",'September'=>"Вересня",
	    'October'=>"Жовтня",'November'=>"Листопада",'December'=>"Грудня");

	    $a=$month[date("F", $date)];
	    $b=date("j",$date);
	    $c=date("Y", $date);
	    $t = date('H:i', $date);
	    return $b.' '.$a." ".$c.' року о '.$t;
	}

}





