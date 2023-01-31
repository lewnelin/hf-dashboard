<?php

namespace healthfirst\hfdashboard\records;

use craft\db\ActiveRecord;
use craft\db\SoftDeleteTrait;

class AccessRecord extends ActiveRecord
{
    use SoftDeleteTrait;

    public static function tableName()
    {
        return '{{%access_monitor}}';
    }
}
