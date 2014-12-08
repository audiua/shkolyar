<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property string $id
 * @property string $title
 * @property string $author
 * @property string $description
 * @property string $img
 * @property string $year
 * @property string $subject_id
 * @property string $slug
 * @property string $class_id
 * @property string $task_path
 *
 * The followings are the available model relations:
 * @property Subject $subject
 * @property Clas $class
 */
class Book extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
	}

	// именованое условие
	public function scopes(){
		$time=time();
        return array(
            'published'=>array(
                'condition'=>'t.create_time <= '.$time,
            ),
        );
    }

    private $_url;
    
	public function getUrl(){
	   if ($this->_url === null)
	       $this->_url = Yii::app()->createUrl('/'.$this->class->slug .'/'.$this->subject->slug.'/'.$this->slug);
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
			array('title, description, img, subject_id, slug, class_id, task_path, lang', 'required'),
			array('title, author, img, year, slug, task_path, properties,pagination', 'length', 'max'=>255),
			array('subject_id, class_id,public,created,ping_google,update_time', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, author, description, img, year, subject_id, slug, class_id, task_path', 'safe', 'on'=>'search'),
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
			'class' => array(self::BELONGS_TO, 'Clas', 'class_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Заголовок',
			'author' => 'Автор',
			'description' => 'Описание',
			'img' => 'Изображение',
			'year' => 'Год',
			'subject_id' => 'Предмет',
			'slug' => 'Slug',
			'class_id' => 'Класс',
			'task_path' => 'Task Path',
			'created' => 'Создано',
			'update_time' => 'Обновленно',
			'public' => 'Public',
			'properties'=>'Особености',
			'pagination'=>'Номерация',
			'ping_google'=>'Google'
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('subject_id',$this->subject_id,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('class_id',$this->class_id,true);
		$criteria->compare('task_path',$this->task_path,true);

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
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}




	public function beforeSave(){

		$this->created = strtotime($this->created);
		$this->update_time = strtotime($this->update_time);


		return parent::beforeSave();
	}

/*
	protected function afterFind() {
	   $create = date('d/m/Y', $this->created);
	   $update = date('d/m/Y', $this->update_time);
	   $this->created = $create;
	   $this->update_time = $update;
	   parent::afterFind();
	}
*/

}
