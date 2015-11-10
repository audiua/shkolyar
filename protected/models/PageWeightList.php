<?php

class PageWeightList extends CActiveRecord
{

    protected $_rules = array(
		array('page_in, page_out', 'required'),
		array('page_in, page_out,uri_in, anchor', 'safe'),
    );

	public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

	public function tableName()
    {
        return 'page_weight_list';
    }

	/**
	 * Названия атрибутов
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'id' 	  => 'ID',
			'page_in'   => 'Название',
			'page_out'   => 'Название',
			'uri_in'   => 'uri_in',
			'anchor'   => 'anchor',
		);
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function search() {

		$criteria = new CdbCriteria();
		$criteria->compare('id', $this->id);
		$criteria->compare('page_in', $this->page_in);
		$criteria->compare('page_out', $this->page_out);
		$criteria->compare('uri_in', $this->uri_in);
		$criteria->compare('anchor', $this->anchor);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array (
				'pageSize' => 50,
			)
		));
	}

}