<?php

/**
 * This is the model class for table "textbook_clas".
 *
 * The followings are the available columns in table 'textbook_clas':
 * @property string $id
 * @property string $description
 * @property string $clas_id
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Clas $clas
 * @property TextbookSubject[] $textbookSubjects
 */
class TextbookClas extends CActiveRecord
{

	private $_url;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'textbook_clas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('clas_id', 'required'),
			array('clas_id, create_time, update_time', 'length', 'max'=>10),
			array('description,', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, clas_id, create_time, update_time', 'safe', 'on'=>'search'),
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
			'clas' => array(self::BELONGS_TO, 'Clas', 'clas_id'),
			'textbook_subject' => array(self::HAS_MANY, 'TextbookSubject', 'textbook_clas_id'),
			'textbook_book' => array(self::HAS_MANY, 'TextbookBook', 'textbook_subject_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'clas_id' => 'Clas',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('clas_id',$this->clas_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TextbookClas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAll(){

		$all = self::model()->findAll();
		if($all){
			foreach($all as $one){
				$result[$one->id]=$one->clas->title;
			}
		}
		return $result;
	}


	public function afterSave(){

		// создам папку для картинок
		$dir = Yii::app()->basePath . '/../img/textbook';
		$clasDir = $dir.'/'.$this->clas->slug;

		if(file_exists($dir)){

			if(! is_writable($dir)){
				chmod($dir, 0777);
			}

			if(!file_exists($clasDir)){
				mkdir($clasDir);
				chmod($clasDir, 0777);
			}

			if(! is_writable($clasDir)){
				chmod($clasDir, 0777);
			}
			
		}

		return parent::afterSave();
	}

	public function getUrl(){
	   if ($this->_url === null){
	       $this->_url = Yii::app()->createUrl('/textbook/'.$this->clas->slug);
	       $this->_url .= '/';
	   }
	   return $this->_url;
	}
}
