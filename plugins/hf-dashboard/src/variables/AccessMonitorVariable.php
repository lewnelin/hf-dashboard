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

use yii\db\Query;

class AccessMonitorVariable
{

    /**
     * @return array
     */
    public function getAccessMonitor()
    {
        $query = new Query();

        // compose the query
        $query->select(['COUNT(*) AS cnt', 'page'])
            ->from('access_monitor')
            ->groupBy('page');
        $rows = $query->all();

        return $rows;
    }
}