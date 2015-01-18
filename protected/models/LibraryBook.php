<?php

/**
 * This is the model class for table "library_book".
 *
 * The followings are the available columns in table 'library_book':
 * @property string $id
 * @property string $title
 * @property string $img_ext
 * @property string $description
 * @property string $author_id
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property LibraryAuthor $author
 */
class LibraryBook extends CActiveRecord
{
	private $_url;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'library_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, library_author_id, slug', 'required'),
			array('title', 'length', 'max'=>255),
			array('library_author_id, length, create_time, update_time,public_time', 'length', 'max'=>10),
			array('img_ext,public, description', 'safe'),
			array('slug', 'ext.yiiext.components.translit.ETranslitFilter', 'translitAttribute' => 'slug', 'setOnEmpty' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, img_ext, slug, length, nausea, description, library_author_id, create_time, update_time,public_time', 'safe', 'on'=>'search'),
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
			'library_author' => array(self::BELONGS_TO, 'LibraryAuthor', 'library_author_id'),
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
			'title' => 'Title',
			'img_ext' => 'Img Ext',
			'description' => 'Description',
			'library_author_id' => 'Author',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'slug' => 'slug',
			'public' => 'public',
			'public_time' => 'public_time',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('img_ext',$this->img_ext,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('library_author_id',$this->library_author_id,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);
		$criteria->compare('public_time',$this->update_time);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('public',$this->slug);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LibraryBook the static model class
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

		$authorDir = $dir.'/book_description';
		if( ! file_exists($authorDir)){
			mkdir($authorDir);
			chmod($authorDir, 0777);
		}

		$authorDir = $dir.'/'.$this->library_author->slug;
		if( ! file_exists($authorDir)){
			mkdir($authorDir);
			chmod($authorDir, 0777);
		}

		$writeDir = $authorDir . '/' . $this->slug;
		if( ! file_exists($writeDir)){
			mkdir($writeDir);
			chmod($writeDir, 0777);
		}

		$bookDir = $writeDir . '/book';
		if( ! file_exists($bookDir)){
			mkdir($bookDir);
			chmod($bookDir, 0777);
		}

		$jurnalDir = $writeDir . '/jurnal';
		if( ! file_exists($jurnalDir)){
			mkdir($jurnalDir);
			chmod($jurnalDir, 0777);
		}

		



		return parent::afterSave();
	}

	public function getUrl(){
	   if ($this->_url === null){
	        $this->_url = Yii::app()->createUrl( '/library/' . $this->library_author->slug . '/' . $this->slug );
	   }
	   return $this->_url;
	}
}
