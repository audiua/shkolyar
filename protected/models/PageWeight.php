<?php

class PageWeight extends CActiveRecord
{

    protected $_rules = array(
		array('url', 'required'),
		array('url', 'safe'),
		array('parse', 'safe'),
    );

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function tableName()
    {
        return 'page_weight';
    }

    public function relations()
    {
        return array(
            'link_out' => array(
                self::HAS_MANY,
                'PageWeightList',
                'page_out',
                'together' => true,
            ),
            'link_in' => array(
                self::HAS_MANY,
                'PageWeightList',
                'page_in',
                'together' => true,
            )
        );
    }

	/**
	 * Названия атрибутов
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' 	  => 'ID',
			'url'   => 'Название',
			'parse'   => 'Название',
		);
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function search() {

		$criteria = new CdbCriteria();
		$criteria->compare('id', $this->id);
		$criteria->compare('url', $this->url);
		$criteria->compare('parse', $this->parse);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array (
				'pageSize' => 500,
			)
		));
	}

}