<?php

namespace healthfirst\hfdashboard\models;

use Craft;
use craft\base\Model;

/**
 * Access model
 */
class AccessModel extends Model
{
    public $ip;
    public $language;
    public $site;
    public $url;
    public $formInfo;
    
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            [['ip', 'site'], 'required'],
            [['language'], 'string', 'max' => 12],
            [['ip'], 'string', 'max' => 40],
            [['site', 'url'], 'string', 'max' => 90]
        ];
    }
}
