<?php

/**
 * Генератор карты сайта
 */
class SitemapController extends FrontController{

public $keywords='Шкільний інформаційний портал, гдз, гдз онлайн, підручники, підручники онлайн, всезнайка, художня література, шкільні твори';
public $description='Шкільний інформаційний портал, для середніх загальноосвітніх шкіл України. Даний портал створено з метою зібрати усі потрібні для навчання в школі матеріали, в одному місці.';
public $canonical;
public $param;

private $siteUrl = 'http://shkolyar.info';
private $lastModify = array();

const ALWAYS = 'always';
const HOURLY = 'hourly';
const DAILY = 'daily';
const WEEKLY = 'weekly';
const MONTHLY = 'monthly';
const YEARLY = 'yearly';
const NEVER = 'never';

// 4 часа
const CACHE_TIME = 14400;

protected $items = array();

public function filters() {
    return array(
        // array( 'COutputCache', 'duration'=> 60, ),
        // убираем дубли ссылок
        array('DuplicateFilter')
    );
}


public function actionIndex() {

    $this->pageTitle = 'sitemap.xml';
    $this->description = 'sitemap.xml';
    $this->keywords = 'sitemap.xml';

    header("Content-type: text/xml");

    if($this->beginCache('sitemap', array('duration'=>self::CACHE_TIME)) ){

        $this->addUrl('/', self::DAILY, 0.9, Helper::lastTime() );
    	
        $this->addUrl('/about', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','about') );
    	$this->addUrl('/contacts', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','contacts') );
    	$this->addUrl('/advertiser', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','advertiser') );
    	$this->addUrl('/rules', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','rules') );
    	$this->addUrl('/rightholder', self::MONTHLY, 0.1, Helper::lastDescriptionTime('site','page','rightholder') );
    	
        $this->addUrl('/gdz/', self::WEEKLY, 0.5, Helper::lastTime('GdzBook') );
        $this->addModels( GdzClas::model()->forSitemap(), self::WEEKLY, 0.3);
        $this->addModels( GdzSubject::model()->forSitemap(), self::WEEKLY, 0.5);
        $this->addModelsWithClas('gdz', GdzClas::model()->forSitemap(), self::WEEKLY, 0.5);
        $this->addModels( GdzBook::model()->public()->findAll(), self::WEEKLY, 0.8);
        
        $this->addUrl('/textbook/', self::WEEKLY, 0.5, Helper::lastTime('TextbookBook') );
        $this->addModels( TClas::model()->forSitemap(), self::WEEKLY, 0.3, 'textbook');
        // $this->addModelsTextbook( TSubject::model()->forSitemap(5), self::WEEKLY, 0.5, 5);
        // $this->addModelsTextbook( TSubject::model()->forSitemap(6), self::WEEKLY, 0.5, 6);
        // $this->addModelsTextbook( TSubject::model()->forSitemap(7), self::WEEKLY, 0.5, 7);
        // $this->addModelsTextbook( TSubject::model()->forSitemap(8), self::WEEKLY, 0.5, 8);
        // $this->addModelsTextbook( TSubject::model()->forSitemap(9), self::WEEKLY, 0.5, 9);
        // $this->addModelsTextbook( TSubject::model()->forSitemap(10), self::WEEKLY, 0.5, 10);
        // $this->addModelsTextbook( TSubject::model()->forSitemap(11), self::WEEKLY, 0.5, 11);
        // $this->addModels( TextbookBook::model()->public()->findAll(), self::WEEKLY, 0.8);

     
        $this->addUrl('/knowall/', self::WEEKLY, 0.5, Helper::lastTime('Knowall') );
        $this->addModels( KnowallCategory::model()->forSitemap(), self::WEEKLY, 0.5);
    	$this->addModels( Knowall::model()->public()->findAll(), self::WEEKLY, 0.8);
        
        $this->addUrl('/writing/', self::WEEKLY, 0.5, Helper::lastTime('Writing') );
        $this->addModels( Writing::model()->forSitemap('clas'), self::WEEKLY, 0.5, 'writing');
        $this->addModels( Writing::model()->forSitemap('subject'), self::WEEKLY, 0.5, 'writing');
        $this->addWritingWithClas( Writing::model()->public()->findAll(), self::WEEKLY, 0.5);
        $this->addWritingModels( Writing::model()->public()->findAll(), self::WEEKLY, 0.8);
        // $this->addModels( Writing::model()->public()->findAll(), self::WEEKLY, 0.8);
    	// $this->addModels( Writing::model()->public()->findAll(), self::WEEKLY, 0.8);

        $this->addUrl('/library/', self::WEEKLY, 0.5, Helper::lastTime('LibraryBook') );
        $this->addModels( LibraryAuthor::model()->findAll(), self::WEEKLY, 0.8);
        $this->addModels( LibraryBook::model()->public()->findAll(), self::WEEKLY, 0.8);
        // $this->addModels( LibraryBook::model()->forSitemap(), self::WEEKLY, 0.3);
        // $this->addUrl('/library/', self::WEEKLY, 0.5, Helper::lastTime('LibraryBook') );
        // $this->addModels( KnowallCategory::model()->forSitemap(), self::WEEKLY, 0.3);
        // $this->addModels( Knowall::model()->public()->findAll(), self::WEEKLY, 0.3);

    	$xml = $this->create();
        echo $xml;

        $this->endCache(); 
    } 
}

public function actionSitemap(){
    if($this->beginCache('sitemapHtml', array('duration'=>self::CACHE_TIME)) ){

        $this->pageTitle = 'sitemap';
        $this->description = 'sitemap';
        $this->keywords = 'sitemap';
        $this->render('sitemap');
        $this->endCache(); 
    }
}

 /**
 * @param $url
 * @param string $changeFreq
 * @param float $priority
 * @param int $lastmod
 */
public function addUrl($url, $changeFreq=self::DAILY, $priority=0.5, $lastMod=0){

    $item = array(
        'loc' => $this->siteUrl . $url,
        'changefreq' => $changeFreq,
        'priority' => $priority
    );
    if ($lastMod){
        $item['lastmod'] = $this->dateToW3C($lastMod);
		}

    $this->items[] = $item;
}

/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addModels($models, $changeFreq=self::DAILY, $priority=0.5, $mode=null){
    $time=time();

    foreach ($models as $model){

        //  добаляем в карту только опубликованные
        if( isset($model->public_time) ){
            if( $time < $model->public_time ){
                continue;
            }
        }

        $item = array(
            'loc' => $this->siteUrl . $model->getUrl($mode),
            'changefreq' => $changeFreq,
            'priority' => $priority
        );

        if ($model->hasAttribute('update_time')){

        	if(isset($model->public_time)){
        		if($model->public_time > $model->update_time){
        			$item['lastmod'] = $this->dateToW3C($model->public_time);
        		} else {
        			$item['lastmod'] = $this->dateToW3C((int)$model->update_time);
        		}
        	} else {
                
            	$item['lastmod'] = $this->dateToW3C((int)$model->update_time);
        	}


        }

        $this->items[] = $item;
    }
}

/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addModelsTextbook($models, $changeFreq=self::DAILY, $priority=0.5, $clas){
    $time=time();

    foreach ($models as $model){

        $item = array(
            'loc' => $this->siteUrl . '/textbook/'.$clas.'-clas'. $model->getUrl(),
            'changefreq' => $changeFreq,
            'priority' => $priority
        );

        if ($model->hasAttribute('update_time')){

            if(isset($model->public_time)){
                if($model->public_time > $model->update_time){
                    $item['lastmod'] = $this->dateToW3C($model->public_time);
                } else {
                    $item['lastmod'] = $this->dateToW3C((int)$model->update_time);
                }
            } else {
                
                $item['lastmod'] = $this->dateToW3C((int)$model->update_time);
            }


        }

        $this->items[] = $item;
    }
}

/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addWritingModels($models, $changeFreq=self::DAILY, $priority=0.5){
    $time=time();

    foreach ($models as $model){

        //  добаляем в карту только опубликованные
        if( isset($model->public_time) ){
            if( $time < $model->public_time ){
                continue;
            }
        }

        $item = array(
            'loc' => $this->siteUrl . $model->getUrl(),
            'changefreq' => $changeFreq,
            'priority' => $priority
        );

        if ($model->hasAttribute('update_time')){

            if(isset($model->public_time)){
                if($model->public_time > $model->update_time){
                    $item['lastmod'] = $this->dateToW3C($model->public_time);
                } else {
                    $item['lastmod'] = $this->dateToW3C((int)$model->update_time);
                }
            } else {
                
                $item['lastmod'] = $this->dateToW3C((int)$model->update_time);
            }


        }

        $this->items[] = $item;
    }
}

/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addModelsWithClas($mode, $models, $changeFreq=self::DAILY, $priority=0.5){
    $time=time();
    $subjects = $mode.'_subject';
    $books = $mode.'_book';

    foreach ($models as $model){


        if($model->$subjects){
            foreach($model->$subjects as $subject){
                $flag = true;
                if($subject->$books){
                    foreach($subject->$books as $book){

                        // isset published book
                        if($book->public && $book->public_time < $time){
                            $flag = false;
                            break;
                        }
                    }

                    if($flag){
                        continue;
                    }
                }


                $item = array(
                    'loc' => $this->siteUrl . $subject->getUrl($model->clas->slug),
                    'changefreq' => $changeFreq,
                    'priority' => $priority
                );


                if ($subject->hasAttribute('update_time')){

                    if(isset($subject->public_time)){
                        if($subject->public_time > $subject->update_time){
                            $item['lastmod'] = $this->dateToW3C($subject->public_time);
                        } else {
                            $item['lastmod'] = $this->dateToW3C((int)$subject->update_time);
                        }
                    } else {
                        
                        $item['lastmod'] = $this->dateToW3C((int)$subject->update_time);
                    }


                }

                $this->items[] = $item;

            }
        }


    }


    
}


/**
 * @param CActiveRecord[] $models
 * @param string $changeFreq
 * @param float $priority
 */
public function addWritingWithClas($models, $changeFreq=self::DAILY, $priority=0.5){
    $time=time();

    foreach ($models as $model){

        if( ! $model->public || $model->public_time > $time){
            continue;
        }
        
        $item = array(
            'loc' => $this->siteUrl . $model->getUrl($model->clas->slug),
            'changefreq' => $changeFreq,
            'priority' => $priority
        );

        if(isset($model->public_time)){
            if($model->public_time > $model->update_time){
                $item['lastmod'] = $this->dateToW3C($model->public_time);
            } else {
                $item['lastmod'] = $this->dateToW3C((int)$model->update_time);
            }
        } else {
            
            $item['lastmod'] = $this->dateToW3C((int)$model->update_time);
        }



        $this->items[] = $item;

    }


    
}


/**
 * @return string XML code
 */
public function create()
{
    $dom = new DOMDocument('1.0', 'utf-8');
    $urlset = $dom->createElement('urlset');
    $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
    foreach($this->items as $item)
    {
        $url = $dom->createElement('url');

        foreach ($item as $key=>$value)
        {
            $elem = $dom->createElement($key);
            $elem->appendChild($dom->createTextNode($value));
            $url->appendChild($elem);
        }

        $urlset->appendChild($url);
    }
    $dom->appendChild($urlset);

    return $dom->saveXML();
}

protected function dateToW3C($date){

    if (is_int($date)){
        $dateTime = new DateTime(date('Y-m-d\TH:i:sP',$date));
        return $dateTime->format(DateTime::W3C);
    } else {

        $dateTime = new DateTime(date('Y-m-d\TH:i:sP',strtotime($date)));
        return $dateTime->format(DateTime::W3C);
    }
}


}