<?php

/**
 * This is the model class for table "writing".
 *
 * The followings are the available columns in table 'writing':
 * @property string $id
 * @property string $clas_id
 * @property string $subject_id
 * @property string $create_time
 * @property string $update_time
 * @property string $public_time
 * @property string $text
 * @property string $title
 * @property string $slug
 * @property integer $length
 * @property double $nausea
 * @property string $img_ext
 *
 * The followings are the available model relations:
 * @property Subject $subject
 * @property Clas $clas
 */
class Writing extends CActiveRecord
{

	private $_url;
	public $thumbnail;
	public $deleteImage;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'writing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clas_id, subject_id, text, title, slug', 'required'),
			array('length', 'numerical', 'integerOnly'=>true),
			array('nausea', 'numerical'),
			array('slug', 'ext.yiiext.components.translit.ETranslitFilter', 'translitAttribute' => 'slug', 'setOnEmpty' => false),
			array('clas_id, subject_id, create_time, update_time, public_time', 'length', 'max'=>10),
			array('title, slug', 'length', 'max'=>255),
			array('deleteImage,public', 'length', 'max'=>1),
			array('thumbnail','file','types'=>'jpg,png,gif,jpeg,JPG,PNG,GIF,JPEG','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, clas_id, thumbnail_ext, deleteImage, public, subject_id, create_time, update_time, public_time, text, title, slug, length, nausea, img_ext', 'safe', 'on'=>'search'),
		);
	}

	public function scopes()
    {
		$scopes = parent::scopes();

		$scopes['public'] = array(
			'condition' => 't.public = 1 AND t.public_time<'.time(),
		);

		return $scopes;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
			'clas' => array(self::BELONGS_TO, 'Clas', 'clas_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'clas_id' => 'Clas',
			'subject_id' => 'Subject',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'public_time' => 'Public Time',
			'text' => 'text',
			'title' => 'Title',
			'slug' => 'Slug',
			'length' => 'Length',
			'public' => 'Public',
			'nausea' => 'Nausea',
			'thumbnail_ext' => 'Img Ext',
			'thumbnail' => 'thumbnail',
			'deleteImage' => 'Удалить изображение',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('clas_id',$this->clas_id,true);
		$criteria->compare('subject_id',$this->subject_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('public_time',$this->public_time,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('public',$this->public);
		$criteria->compare('length',$this->length);
		$criteria->compare('nausea',$this->nausea);
		$criteria->compare('thumbnail_ext',$this->thumbnail_ext,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Writing the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// public function getUrl() {
	// 	return Yii::app()->baseUrl . '/writing/' . $this->clas . '/' . $this->slug;
 //    }

    public function beforeSave(){

		if( !empty($this->thumbnail) ){
			$this->_deleteImage();
			$this->thumbnail_ext = strtolower($this->thumbnail->getExtensionName());
		}
    
    	if ($this->deleteImage) {
    		$this->_deleteImage();
    	}

    	$this->length = Helper::getLength($this);
    	$this->nausea = str_replace(',', '.', $this->nausea) ;

    	return parent::beforeSave();
    }

    public function afterSave(){

    	if (!empty($this->thumbnail)) {

    		$this->thumbnail->saveAs($this->getImgDir() . '/' . $this->slug . '.' .$this->thumbnail_ext);
    		$this->getThumb(77,90,'crop');
    		$this->getThumb(250,170,'crop');
    		$this->getThumb(380,280,'crop');
    		$this->getThumb(140,100,'crop');
    	}

		return parent::afterSave();
    }

	protected function afterFind() {

		$this->public_time = date('d.m.Y H:i', $this->public_time);

        return parent::afterFind();
    }

    public function uniqKnowallId() {
		return md5($this->id . $this->slug);
    }

    public function getImgDir($mkdir = true){
    	$directory = Yii::app()->basePath . '/../img/writing/thumbs/'.$this->uniqKnowallId();
        if ($mkdir && file_exists($directory) == false) {
            mkdir($directory, 0777, true);
        }

        return $directory;
    }

    public function getThumb($width=null, $height=null, $mode='origin')
	{
		$dir = $this->getImgDir(false) . '/';
		$originFile = $dir . $this->slug . '.' . $this->thumbnail_ext;

		if (!is_file($originFile)) {
			return "http://www.placehold.it/{$width}x{$height}/EFEFEF/AAAAAA";
		}

		if ($mode == 'origin') {
			return '/img/writing/thumbs/'.$this->uniqKnowallId(). '/' . $this->slug . '.' . $this->thumbnail_ext;
		}

		$fileName = $this->slug . '_' . $width . 'x' . $height . '.' . $this->thumbnail_ext;
		$filePath = $dir . $fileName;
		if (!is_file($filePath)) {
			if ($mode == 'resize') {
				Yii::app()->image->load($originFile)->resize($width, $height)->save($filePath);
			} else {
				Yii::app()->image->cropSave($originFile, $width, $height, $filePath);
			}
		}

		return '/img/writing/thumbs/'.$this->uniqKnowallId(). '/'. $fileName;
	}

	private function _deleteImage() {
        if ($this->thumbnail_ext) {
            Yii::app()->file->set($this->getImgDir(false))->delete();
            $this->thumbnail_ext = '';
        }
    }

    public function beforeDelete() {

		$this->_deleteImage();

        return parent::beforeDelete();
    }

    public function forSitemap($mode='clas'){
    	$result = array();
    	$model = ucfirst($mode);
		$all = $model::model()->findAll();
		$time = time();
		foreach($all as $one){
			$flag = false;
			if($one->writing){

				foreach($one->writing as $article){

					// isset published book
					if($article->public && $article->public_time < $time){
						$flag = true;
						break;
					}
				}

				if($flag){
					$result[] = $one;
				}

			}
		}

		return $result;
    }

    /**
     * [getUrl description]
     * @return [type] [description]
     */
	public function getUrl(){
		if ($this->_url === null){
			$this->_url = '/writing/';

			if( $this->clas ){
				$this->_url .= $this->clas->slug.'/';
			}

			if( $this->subject ){
				$this->_url .= $this->subject->slug.'/';
			}
			
			$this->_url = Yii::app()->createUrl( $this->_url );

		}
		
		return $this->_url;
	}

	public function getArticleUrl(){
	   if ($this->_url === null){
	        $this->_url = Yii::app()->createUrl( '/writing/' . $this->clas->slug . '/'. $this->subject->slug . '/'. $this->slug );
	   }
	   return $this->_url;
	}
}
