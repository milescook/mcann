<?php

namespace miles\craftmilesplugin;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\controllers\UsersController;
use craft\elements\User;
use craft\events\FindLoginUserEvent;
use miles\craftmilesplugin\elements\UserExtended;
use yii\base\Behavior;
use yii\base\Event;




class UserLoginEvent extends Behavior
{
    /**
     * @var string $guid
     */
    var $guid;

    /**
     * @param FindLoginUserEvent $LoginEvent
     */
    static function userLogin(FindLoginUserEvent $LoginEvent) : void
    {
        $guid = self::extractGuidFromEvent($LoginEvent);

        
        Craft::warning("User logged in: ".$LoginEvent->loginName." with UID ".$guid,"miles-plugin"); // @phpstan-ignore-line For test purposes step 2
        
    }

    /**
     * @return string GUID
     * In case we're using php without this support, we can write our own guid function
     */
    static function generateGuid() : string
    {
        if (function_exists('com_create_guid') === true)
        {
            $result = com_create_guid();
            if($result)
                return trim($result, '{}');

            throw new \Exception("Issue Creating guid using library");
        }
    
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    

    static function extractGuidFromEvent(FindLoginUserEvent $LoginEvent) : ?string
    {
        $loginName = $LoginEvent->loginName;
        $User = UserExtended::find()->username($loginName)->one();
        if(!isset($User->guid) || $User->guid==null)
        {
            $guid = self::generateGuid();
        
            $User->guid = $guid; // @phpstan-ignore-line
            Craft::$app->elements->saveElement($User); // @phpstan-ignore-line
            return $guid;
            
        }

        return null;
    }
}
