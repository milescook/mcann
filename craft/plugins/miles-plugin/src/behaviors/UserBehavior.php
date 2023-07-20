<?php

// myplugin/src/behaviors/UserBehavior.php

namespace miles\craftmilesplugin\behaviors;

use Craft;
use craft\elements\User;
use yii\base\Behavior;

class UserBehavior extends Behavior
{
    /**
     * @return array<string>
     */
    public function customFields()
    {
        return array(
            
            'guid' => 'User GUID'
        );
    }

 
     /**
      *  @return array<string>
      */
      public function attributeLabels() {
        return [
           'guid' => 'GUID'
        ];
     }
 


}