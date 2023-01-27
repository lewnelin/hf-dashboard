<?php

namespace healthfirst\hfdashboard\widgets;

use Craft;
use craft\base\Widget;
use Twig_Error_Loader as Twig_Error_LoaderAlias;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use craft\base\ConfigurableComponent;
/**
 *
 * @property mixed  $bodyHtml
 * @property mixed  $settingsHtml
 * @property string $title
 */
class AccessMonitor extends Widget
{
    

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('app', 'Access Monitor');
    }

    /**
     * @inheritdoc
     *
     * @throws Twig_Error_LoaderAlias
     * @throws Exception
     */
    public function getBodyHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate('_monitoraccess/index',
            [
                'widget' => $this
            ]);
    }

    /**
     * @inheritdoc
     *
     * @throws Twig_Error_LoaderAlias
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function getSettingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('_monitoraccess/_settings.twig', [
            'widget' => $this,
            'settings' => $this->getSettings(),
        ]);
    }
}