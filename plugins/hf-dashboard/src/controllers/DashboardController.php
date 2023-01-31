<?php

namespace healthfirst\hfdashboard\controllers;

use Craft;
use craft\web\Controller;
use healthfirst\hfdashboard\Plugin;
use yii\web\Response;
use healthfirst\hfdashboard\models\AccessModel;
use healthfirst\hfdashboard\records\AccessRecord;

/**
 * Dashboard controller
 */
class DashboardController extends Controller
{

    protected array $allowAnonymous = [
        'register-hit',
    ];

    /**
     * hf-dashboard/register-hit action
     */
    public function actionRegisterHit(): Response
    {
        if (Craft::$app->request->getIsPost() === true) {

            $model = new AccessModel();
            $model->load(Craft::$app->request->post(), '');

            if ($model->validate()) {
                return $this->asJson(Plugin::$plugin->dashboardService->processData(Craft::$app->request->post()));
            }

            return $this->asJson(['success' => false, 'error' => $model->getErrorSummary(true)]);
        }

        return $this->asJson(['success' => false, 'error' => 'Must be $_POST data.']);
    }
}
