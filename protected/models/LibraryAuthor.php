<?php

/**
 * This is the model class for table "library_author".
 *
 * The followings are the available columns in table 'library_author':
 * @property string $id
 * @property string $author
 * @property string $create_time
 * @property string $update_time
 * @property string $biography
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property LibraryBook[] $libraryBooks
 */
class LibraryAuthor extends CActiveRecord
{

	public $_url;


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'library_author';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author, description, slug', 'required'),
			array('author, slug', 'length', 'max'=>255),
			array('public_time', 'unique'),
			array('public, description,vk_img', 'safe'),
			array('create_time,length, update_time,public_time,vk_public_time', 'length', 'max'=>10),
			array('slug', 'ext.yiiext.components.translit.ETranslitFilter', 'translitAttribute' => 'slug', 'setOnEmpty' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, author, nausea, length, create_time, update_time, description, slug,public_time,public', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'library_book' => array(self::HAS_MANY, 'LibraryBook', 'library_author_id'),
		);
	}

	public function scopes()
    {
		$scopes = parent::scopes();

		$scopes['public'] = array(
			'condition' => 't.`public` = 1 AND t.`public_time`<'.time(),
		);

		return $scopes;
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
			'author' => 'Author',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'description' => 'description',
			'slug' => 'Slug',
			'length' => 'Длина',
			'nausea'=>'Тошнота',
			'public' => 'public',
			'public_time' => 'public time',
			'vk_public_time' => 'vk public time',
			'vk_img' => 'vk img',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('public_time',$this->update_time);
		$criteria->compare('vk_img',$this->vk_img);
		$criteria->compare('vk_public_time',$this->vk_public_time);
		$criteria->compare('public',$this->slug);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibraryAuthor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeValidate(){

		$this->public_time = strtotime($this->public_time);


		return parent::beforeValidate();
	}

	protected function afterFind() {

		$this->public_time = date('d.m.Y H:i', $this->public_time);

        return parent::afterFind();
    }

	public function beforeSave(){

    	$this->length = Helper::getLength($this);
    	$this->nausea = str_replace(',', '.', $this->nausea) ;

    	return parent::beforeSave();
    }

    public static function getAll(){

		return CHtml::listData(self::model()->findAll(), 'id', 'author');

	}


	public function afterSave(){

		// создам папку для картинок
		$dir = Yii::app()->basePath . '/../img/library';
		if(	! file_exists($dir)){
			mkdir($dir);
			chmod($dir, 0777);
		}

		if( ! is_writable($dir)){
			chmod($dir, 0777);
		}

		$descriptionDir = $dir . '/description';
		if( ! file_exists($descriptionDir)){
			mkdir($descriptionDir);
			chmod($descriptionDir, 0777);
		}
		

		$authorDir = $dir.'/'.$this->slug;
		if( ! file_exists($authorDir)){
			mkdir($authorDir);
			chmod($authorDir, 0777);
		}

		return parent::afterSave();
	}




	public function getUrl(){
	   if ($this->_url === null){
	       $this->_url = Yii::app()->createUrl('/library/'.$this->slug);
	       $this->_url .= '/';
	   }
	   return $this->_url;
	}

	// модели для карты сайта
	public function forSitemap($full=null){
		$result = array();
		$all = self::model()->findAll();
		$time = time();
		foreach($all as $one){
			
			$flag = false;
			if($one->textbook_book){

				foreach($one->textbook_book as $book){

					// isset published book
					if($book->public && $book->public_time < $time){
						$flag = true;
						break;
					}
				}

				if($flag){
					$result[] = $one;
				}
				

			}

			$flag = false;
		}

		return $result;
	}



}
