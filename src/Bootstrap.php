<?php

namespace wb\sdk;

use Yii;
use yii\base\BootstrapInterface;

/**
 * Bootstrap class for auto-loading module
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        // Add module to application if not already configured
        if (!isset($app->getModules()['wildberries'])) {
            $app->setModule('wildberries', [
                'class' => Module::class,
            ]);
        }
        
        // Add console commands if this is a console application
        if ($app instanceof \yii\console\Application) {
            $app->controllerMap['wildberries'] = [
                'class' => \wb\sdk\console\WildberriesController::class,
            ];
        }
    }
}
