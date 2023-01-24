<?php
/**
 * Craft plugin for dashboard monitor
 *
 * @author     Ivan Pinheiro
 * @see        https://github.com/leowebguy
 * @copyright  Copyright (c) 2021, leowebguy
 * @license    MIT
 */

 namespace healthfirst\hfdashboard\variables;

 use healthfirst\hfdashboard\models\Access;
 use yii\db\Query;

class AccessMonitorVariable {

    public function getAccessMonitor () 
    {
        $query = new Query();
        // compose the query
        $query->select('id', 'ip')
            ->from('access_monitor')
            ->limit(10);
        $rows = $query->all();
        return $rows;

    }
}