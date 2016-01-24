<?php

/**
 * This is the model class for table "clas".
 *
 * The followings are the available columns in table 'clas':
 * @property string $id
 * @property string $title
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property Book[] $books
 * @property Subject[] $subjects
 */
class TClas extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 't_clas';
	}

    private $_url;
    
	public function getUrl($mode=null){
	   if ($this->_url === null){
	   		if($mode){
	        	$this->_url = Yii::app()->createUrl('/'.$mode.'/'.$this->slug);
	   		} else {
	        	$this->_url = Yii::app()->createUrl('/'.$this->slug);
	   		}
	   }
	   return $this->_url;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, slug', 'required'),
			array('title, slug', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, slug', 'safe', 'on'=>'search'),
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'gdz_clas'=>array(self::HAS_ONE, 'GdzClas', 'clas_id'),
			'gdz_book' => array(self::HAS_MANY, 'GdzBook', 'clas_id'),
			'gdz_subject' => array(self::HAS_MANY, 'GdzSubject', 'clas_id'),
			'writing' => array(self::HAS_MANY, 'Writing', 'clas_id'),
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
			'slug' => 'Slug',
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
		$criteria->compare('slug',$this->slug,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Clas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public static function getAll(){
		return CHtml::listData(self::model()->findAll(), 'id', 'title');
	}

	// модели для карты сайта
	public function forSitemap($full=null){
		$result = array();
		$all = self::model()->findAll();
		$time = time();
		foreach($all as $one){
			$flag = false;
			if($one->gdz_book){

				foreach($one->gdz_book as $book){

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
		}

		return $result;
	}

}
