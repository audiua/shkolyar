<?php

/**
 * Генератор карты сайта
 */
class SitemapController extends Controller{

private $siteUrl = 'http://shkolyar.info';
private $lastModify = array();

const ALWAYS = 'always';
const HOURLY = 'hourly';
const DAILY = 'daily';
const WEEKLY = 'weekly';
const MONTHLY = 'monthly';
const YEARLY = 'yearly';
const NEVER = 'never';

const CACHE_TIME = 86400;

protected $items = array();

public function actionIndex() {

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
        $this->addModels( TextbookClas::model()->forSitemap(), self::WEEKLY, 0.3);
        $this->addModels( TextbookSubject::model()->forSitemap(), self::WEEKLY, 0.5);
        $this->addModelsWithClas('textbook', TextbookClas::model()->forSitemap(), self::WEEKLY, 0.5);
        $this->addModels( TextbookBook::model()->public()->findAll(), self::WEEKLY, 0.8);
        // $this->addUrl('/writing/', self::WEEKLY, 0.5, Helper::lastTime('Writing') );
        // $this->addUrl('/library/', self::WEEKLY, 0.5, Helper::lastTime('Library') );
     
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
            'loc' => $this->siteUrl . $model->getArticleUrl(),
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


} // end class SitemapController