<?php

namespace app\common\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

class PrimaryKeyBehavior extends AttributeBehavior
{
  public $primaryKeyAttribute = 'id';

  public $value;

  public function init()
  {
    parent::init();

    if (empty($this->attributes)) {
      $this->attributes = [
        BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->primaryKeyAttribute],
      ];
    }
  }

  protected function getValue($event)
  {
    return Yii::$app->db->createCommand('select UUID()')->queryScalar();
  }
}
