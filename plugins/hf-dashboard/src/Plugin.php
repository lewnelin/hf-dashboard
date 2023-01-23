<?php

namespace healthfirst\hfdashboard;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
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

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
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
