<?php

namespace healthfirst\hfdashboard\controllers;

use Craft;
use craft\web\Controller;
use yii\web\Response;

/**
 * Dashboard controller
 */
class DashboardController extends Controller
{
    public $defaultAction = 'index';
    protected array|int|bool $allowAnonymous = self::ALLOW_ANONYMOUS_NEVER;

    /**
     * hf-dashboard/dashboard action
     */
    public function actionIndex(): Response
    {
        $entries = craft.entries().section('media', 'insights').all();
        var_dump($entries);
        die();


        $accessData = Access::all();
    }
}
