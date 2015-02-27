<?php

/**
 * This is the model class for table "knewall".
 *
 * The followings are the available columns in table 'knewall':
 * @property string $id
 * @property string $clas_id
 * @property string $create_time
 * @property string $update_time
 * @property string $title
 * @property string $text
 * @property string $subject_id
 * @property string $knowall_category_id
 * @property string $public
 *
 * The followings are the available model relations:
 * @property Clas $clas
 * @property Subject $subject
 * @property KnewallCategory $knewallCategory
 */
class Knowall extends CActiveRecord
{

	private $_url;
	public $thumbnail;
	public $deleteImage;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'knowall';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text, knowall_category_id', 'required'),
			array('id, create_time, update_time, public_time, knowall_category_id, vk_public_time', 'length', 'max'=>10),
			array('slug', 'ext.yiiext.components.translit.ETranslitFilter', 'translitAttribute' => 'slug', 'setOnEmpty' => false),
			array('slug', 'unique', 'on' => 'insert'),
			array('public_time', 'unique'),
			array('vk_img', 'safe'),
			array('title', 'length', 'max'=>255),
			array('public, deleteImage', 'length', 'max'=>1),
			array('thumbnail','file','types'=>'jpg,png,gif,jpeg,JPG,PNG,GIF,JPEG','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('vk_img, id, create_time, nausea, length, deleteImage, update_time,public_time, title, text, knowall_category_id, public,thumbnail', 'safe', 'on'=>'search'),
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
			// 'clas' => array(self::BELONGS_TO, 'Clas', 'clas_id'),
			// 'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
			'knowall_category' => array(self::BELONGS_TO, 'KnowallCategory', 'knowall_category_id'),
		);
	}

	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'create_time',
				'updateAttribute' => 'update_time',
				'setUpdateOnCreate'=>true,
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'public_time' => 'Public Time',
			'vk_public_time' => 'vk Public Time',
			'title' => 'Заголовок',
			'text' => 'Text',
			'knowall_category_id' => 'Категорія',
			'public' => 'Public',
			'thumbnail' => 'thumbnail',
			'deleteImage' => 'Удалить изображение',
			'length' => 'Длина',
			'nausea'=>'Тошнота',
			'vk_img'=>'vk img',
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
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('public_time',$this->public_time,true);
		$criteria->compare('vk_public_time',$this->vk_public_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('knowall_category_id',$this->knowall_category_id,true);
		$criteria->compare('public',$this->public,true);
		$criteria->compare('nausea',$this->nausea,true);
		$criteria->compare('vk_img',$this->vk_img,true);
		
		$criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Knewall the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeValidate(){

		$this->public_time = strtotime($this->public_time);


		return parent::beforeValidate();
	}

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
    	$this->public_time = strtotime($this->public_time);

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
    	$directory = Yii::app()->basePath . '/../img/knowall/thumbs/'.$this->uniqKnowallId();
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
			return '/img/knowall/thumbs/'.$this->uniqKnowallId(). '/' . $this->slug . '.' . $this->thumbnail_ext;
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

		return '/img/knowall/thumbs/'.$this->uniqKnowallId(). '/'. $fileName;
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

    public function getUrl(){
       if ($this->_url === null){
            $this->_url = Yii::app()->createUrl( '/knowall/' .  $this->knowall_category->slug . '/' . $this->slug );
       }
       return $this->_url;
    }
}
