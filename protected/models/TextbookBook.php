<?php

/**
 * This is the model class for table "textbook_book".
 *
 * The followings are the available columns in table 'textbook_book':
 * @property string $id
 * @property string $title
 * @property string $author
 * @property string $textbook_clas_id
 * @property string $textbook_subject_id
 * @property string $slug
 * @property string $img
 * @property string $description
 * @property string $year
 * @property string $properties
 * @property string $pagination
 * @property string $lang
 * @property string $public
 * @property string $create_time
 * @property string $update_time
 * @property string $public_time
 *
 * The followings are the available model relations:
 * @property TextbookSubject $textbookSubject
 * @property TextbookClas $textbookClas
 */
class TextbookBook extends CActiveRecord
{
	public $subject_id;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'textbook_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, author, textbook_clas_id, textbook_subject_id, slug', 'required'),
			array('title, author, slug, year, properties', 'length', 'max'=>255),
			array('textbook_clas_id, textbook_subject_id, create_time, update_time, public_time', 'length', 'max'=>10),
			array('public', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, author, textbook_clas_id, textbook_subject_id, slug, img, description, year, properties, pagination, lang, public, create_time, update_time, public_time', 'safe', 'on'=>'search'),
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
			'textbook_subject' => array(self::BELONGS_TO, 'TextbookSubject', 'textbook_subject_id'),
			'textbook_clas' => array(self::BELONGS_TO, 'TextbookClas', 'textbook_clas_id'),
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
			'title' => 'Title',
			'author' => 'Author',
			'textbook_clas_id' => 'Textbook Clas',
			'textbook_subject_id' => 'Textbook Subject',
			'slug' => 'Slug',
			'img' => 'Img',
			'description' => 'Description',
			'year' => 'Year',
			'properties' => 'Properties',
			'pagination' => 'Pagination',
			'lang' => 'Lang',
			'public' => 'Public',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'public_time' => 'Public Time',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('textbook_clas_id',$this->textbook_clas_id,true);
		$criteria->compare('textbook_subject_id',$this->textbook_subject_id,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('properties',$this->properties,true);
		$criteria->compare('pagination',$this->pagination,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('public',$this->public,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('public_time',$this->public_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>50,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TextbookBook the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeValidate(){

		$this->public_time = strtotime($this->public_time);


		return parent::beforeValidate();
	}
}
