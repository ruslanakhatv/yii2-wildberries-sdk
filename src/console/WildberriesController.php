<?php

namespace wb\sdk\console;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Wildberries console commands
 */
class WildberriesController extends Controller
{
    /**
     * Test Wildberries API connection
     *
     * @return int
     */
    public function actionTestConnection()
    {
        $this->stdout("Testing Wildberries API connection...\n", Console::BOLD);
        
        try {
            $module = Yii::$app->getModule('wildberries');
            $categories = $module->content()->categories()->getParentCategories();
            
            if (isset($categories['data'])) {
                $this->stdout("✓ Connection successful!\n", Console::FG_GREEN);
                $this->stdout("Found " . count($categories['data']) . " parent categories\n");
                return ExitCode::OK;
            } else {
                $this->stdout("✗ Connection failed: No data received\n", Console::FG_RED);
                return ExitCode::SOFTWARE;
            }
            
        } catch (\Exception $e) {
            $this->stdout("✗ Connection failed: " . $e->getMessage() . "\n", Console::FG_RED);
            return ExitCode::SOFTWARE;
        }
    }
    
    /**
     * List parent categories
     *
     * @return int
     */
    public function actionCategories()
    {
        try {
            $module = Yii::$app->getModule('wildberries');
            $categories = $module->content()->categories()->getParentCategories();
            
            if (isset($categories['data'])) {
                $this->stdout("Parent categories:\n", Console::BOLD);
                foreach ($categories['data'] as $category) {
                    $this->stdout("• {$category['name']} (ID: {$category['id']})\n");
                }
                return ExitCode::OK;
            }
            
        } catch (\Exception $e) {
            $this->stdout("Error: " . $e->getMessage() . "\n", Console::FG_RED);
            return ExitCode::SOFTWARE;
        }
    }
    
    /**
     * Get card limits
     *
     * @return int
     */
    public function actionLimits()
    {
        try {
            $module = Yii::$app->getModule('wildberries');
            $limits = $module->content()->cards()->getLimits();
            
            if (isset($limits['data'])) {
                $this->stdout("Card limits:\n", Console::BOLD);
                $this->stdout("Free limits: {$limits['data']['freeLimits']}\n");
                $this->stdout("Paid limits: {$limits['data']['paidLimits']}\n");
                return ExitCode::OK;
            }
            
        } catch (\Exception $e) {
            $this->stdout("Error: " . $e->getMessage() . "\n", Console::FG_RED);
            return ExitCode::SOFTWARE;
        }
    }
}
