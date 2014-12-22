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
 * @property string $knewall_category_id
 * @property string $public
 *
 * The followings are the available model relations:
 * @property Clas $clas
 * @property Subject $subject
 * @property KnewallCategory $knewallCategory
 */
class Knowall extends CActiveRecord
{
	public $image;
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
			array('id, clas_id, create_time, update_time, title, text, subject_id, knewall_category_id', 'required'),
			array('id, clas_id, create_time, update_time, subject_id, knewall_category_id', 'length', 'max'=>10),
			array('slug', 'ext.yiiext.components.translit.ETranslitFilter', 'translitAttribute' => 'slug', 'setOnEmpty' => false),
			array('title', 'length', 'max'=>255),
			array('public', 'length', 'max'=>1),
			array('image','file','types'=>'jpg,png,gif,jpeg,JPG,PNG,GIF,JPEG','allowEmpty'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, clas_id, create_time, update_time, title, text, subject_id, knowall_category_id, public', 'safe', 'on'=>'search'),
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
			'subject' => array(self::BELONGS_TO, 'Subject', 'subject_id'),
			'knowall_category' => array(self::BELONGS_TO, 'KnowallCategory', 'knowall_category_id'),
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
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'title' => 'Title',
			'text' => 'Text',
			'subject_id' => 'Subject',
			'knewall_category_id' => 'Knowall Category',
			'public' => 'Public',
			'image' => 'Image',
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
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('subject_id',$this->subject_id,true);
		$criteria->compare('knowall_category_id',$this->knewall_category_id,true);
		$criteria->compare('public',$this->public,true);

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

	public function afterSave(){
		if (!empty($this->image)) {
			$this->image->saveAs($this->image_directory . '/origin.'.$this->image_extension);
		}
	}
}
