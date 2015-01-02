<?php

/**
 * This is the model class for table "textbook_subject".
 *
 * The followings are the available columns in table 'textbook_subject':
 * @property string $id
 * @property string $description
 * @property string $create_time
 * @property string $update_time
 * @property string $subject_id
 * @property string $textbook_clas_id
 *
 * The followings are the available model relations:
 * @property Subject $subject
 * @property TextbookClas $textbookClas
 */
class TextbookSubject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'textbook_subject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject_id, textbook_clas_id', 'required'),
			array('create_time, update_time, subject_id, textbook_clas_id', 'length', 'max'=>10),
			array('description,', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, description, create_time, update_time, subject_id, textbook_clas_id', 'safe', 'on'=>'search'),
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
			'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
			'textbook_clas' => array(self::BELONGS_TO, 'TextbookClas', 'textbook_clas_id'),
			'textbook_book' => array(self::HAS_MANY, 'TextbookBook', 'textbook_subject_id'),
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
			'description' => 'Description',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'subject_id' => 'Subject',
			'textbook_clas_id' => 'Textbook Clas',
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
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('subject_id',$this->subject_id,true);
		$criteria->compare('textbook_clas_id',$this->textbook_clas_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TextbookSubject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getAll(){

		$all = self::model()->findAll();
		if($all){
			foreach($all as $one){
				$result[$one->id]=$one->subject->title;
			}
		}
		return $result;
	}
}
