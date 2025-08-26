<?php

namespace wb\sdk;

use Yii;
use yii\base\Module as BaseModule;
use WB\SDK\WBAPI;

/**
 * Wildberries SDK module for Yii2
 */
class Module extends BaseModule
{
    /**
     * @var string API key for Wildberries
     */
    public $apiKey;
    
    /**
     * @var array SDK configuration
     */
    public $sdkConfig = [];
    
    /**
     * @var WBAPI|null SDK instance
     */
    private $_sdk;
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        // Set default API key from params if not set
        if (empty($this->apiKey) && isset(Yii::$app->params['wbApiKey'])) {
            $this->apiKey = Yii::$app->params['wbApiKey'];
        }
        
        // Initialize SDK
        $this->getSdk();
    }
    
    /**
     * Returns SDK instance
     *
     * @return WBAPI
     * @throws \yii\base\InvalidConfigException
     */
    public function getSdk(): WBAPI
    {
        if ($this->_sdk === null) {
            if (empty($this->apiKey)) {
                throw new \yii\base\InvalidConfigException('Wildberries API key is not configured.');
            }
            
            $this->_sdk = new WBAPI($this->apiKey);
        }
        
        return $this->_sdk;
    }
    
    /**
     * Sets SDK instance
     *
     * @param WBAPI $sdk
     */
    public function setSdk(WBAPI $sdk): void
    {
        $this->_sdk = $sdk;
    }
    
    /**
     * Shortcut to content client
     *
     * @return \WB\SDK\Clients\ContentClient
     */
    public function content()
    {
        return $this->getSdk()->content();
    }
    
    /**
     * Shortcut to prices client
     *
     * @return \WB\SDK\Clients\PricesClient
     */
    public function prices()
    {
        return $this->getSdk()->prices();
    }
    
    /**
     * Shortcut to marketplace client
     *
     * @return \WB\SDK\Clients\MarketplaceClient
     */
    public function marketplace()
    {
        return $this->getSdk()->marketplace();
    }
}
