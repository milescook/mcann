<?php

namespace miles\craftmilesplugin;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\controllers\UsersController;
use craft\elements\User;
use craft\events\AuthenticateUserEvent;
use craft\events\DefineBehaviorsEvent;
use craft\events\FindLoginUserEvent;
use craft\events\RegisterComponentTypesEvent;
use miles\craftmilesplugin\behaviors\UserBehavior;
use yii\base\Event;

Event::on(
    UsersController::class,
    UsersController::EVENT_AFTER_FIND_LOGIN_USER,
    function (FindLoginUserEvent $event) {
        UserLoginEvent::userLogin($event);
    }
);

Event::on(
    User::class,
    User::EVENT_DEFINE_BEHAVIORS,
    static function(DefineBehaviorsEvent $event) {
        $event->behaviors['userBehavior'] = ['class' => UserBehavior::class];
    });

/**
 * miles-plugin plugin
 *
 * @method static Plugin getInstance()
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';

  

    /**
     * @return array<string>
     */
    public function fields() {
        return [
           'guid'
        ];
     }

    public function init(): void
    {
        parent::init();

     
        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() { // @phpstan-ignore-line
            $this->attachEventHandlers();
            // ...
        });
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
    }
}
