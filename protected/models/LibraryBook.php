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
			array('library_author_id, create_time, update_time', 'length', 'max'=>10),
			array('img_ext, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, img_ext, slug, description, library_author_id, create_time, update_time', 'safe', 'on'=>'search'),
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
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('slug',$this->slug,true);

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
}
