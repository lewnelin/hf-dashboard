<?php

namespace healthfirst\hfdashboard;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use yii\base\Event;
use craft\services\Dashboard;
use craft\web\View;
use craft\events\RegisterComponentTypesEvent;
use craft\web\twig\variables\CraftVariable;
use craft\events\RegisterTemplateRootsEvent;
use healthfirst\hfdashboard\widgets\AccessMonitor;
use healthfirst\hfdashboard\variables\AccessMonitorVariable;
use healthfirst\hfdashboard\models\Settings;

/**
 * hf-dashboard plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 * @author Arthur Nascimento <aairesvieiradonascim@healthfirst.org>
 * @copyright Arthur Nascimento
 * @license https://craftcms.github.io/license/ Craft License
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0';
    public bool $hasCpSettings = true;
    public bool $hasCpSection = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init()
    {
        parent::init();

        Event::on(Dashboard::class, Dashboard::EVENT_REGISTER_WIDGET_TYPES, static function(RegisterComponentTypesEvent $event) {
            $event->types[] = AccessMonitor::class;
        });

        Event::on(
            View::class,
            View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
            static function(RegisterTemplateRootsEvent $event) {
                $event->roots['_monitoraccess'] = __DIR__ . '/templates';
            }
        );

        /**
         * Craft Variable
         */
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('accessMonitor', AccessMonitorVariable::class);
            }
        );
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('hf-dashboard/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
