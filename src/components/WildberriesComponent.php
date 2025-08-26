<?php

namespace wb\sdk\components;

use Yii;
use yii\base\Component;
use WB\SDK\WBAPI;
use yii\base\InvalidConfigException;

/**
 * Wildberries API component for Yii2
 */
class WildberriesComponent extends Component
{
    /**
     * @var string API key for Wildberries
     */
    public $apiKey;
    
    /**
     * @var WBAPI SDK instance
     */
    private $_sdk;
    
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        if (empty($this->apiKey)) {
            throw new InvalidConfigException('The "apiKey" property must be set.');
        }
        
        $this->_sdk = new WBAPI($this->apiKey);
    }
    
    /**
     * Returns SDK instance
     *
     * @return WBAPI
     */
    public function getSdk(): WBAPI
    {
        return $this->_sdk;
    }
    
    /**
     * Magic method for method calls to SDK
     *
     * @param string $name
     * @param array $params
     * @return mixed
     */
    public function __call($name, $params)
    {
        if (method_exists($this->_sdk, $name)) {
            return call_user_func_array([$this->_sdk, $name], $params);
        }
        
        return parent::__call($name, $params);
    }
    
    /**
     * Shortcut to content client
     *
     * @return \WB\SDK\Clients\ContentClient
     */
    public function getContent()
    {
        return $this->_sdk->content();
    }
    
    /**
     * Shortcut to prices client
     *
     * @return \WB\SDK\Clients\PricesClient
     */
    public function getPrices()
    {
        return $this->_sdk->prices();
    }
    
    /**
     * Shortcut to marketplace client
     *
     * @return \WB\SDK\Clients\MarketplaceClient
     */
    public function getMarketplace()
    {
        return $this->_sdk->marketplace();
    }
}
