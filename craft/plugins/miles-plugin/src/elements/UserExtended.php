<?php
   namespace miles\craftmilesplugin\elements;
   use app\components\UppercaseBehavior;
use Craft;
use craft\elements\User;
use Yii;
   /**
   * This is the model class for table "user".
   *
   * @property string $guid
   */
   class UserExtended extends User {

    /**
     * @var string $guid
     */
     var $guid;

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
    public function attributeLabels(): array
    {
        $labels = parent::attributeLabels();
        $labels['guid'] = Craft::t('userGuid', 'User Guid'); // @phpstan-ignore-line
        
        return $labels;
    }

   
   }
?>