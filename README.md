Модуль для интеграции Wildberries PHP SDK в Yii2 Basic Application.

## Установка

1. Установите пакет через Composer:

```bash
composer require your-username/yii2-wildberries-sdk
Добавьте модуль в конфигурацию приложения:

php
// config/web.php
return [
    'bootstrap' => ['wildberries'],
    'modules' => [
        'wildberries' => [
            'class' => \wb\sdk\Module::class,
            'apiKey' => 'your-api-key-here',
        ],
    ],
    'components' => [
        'wildberries' => [
            'class' => \wb\sdk\components\WildberriesComponent::class,
            'apiKey' => 'your-api-key-here',
        ],
    ],
    'params' => [
        'wbApiKey' => 'your-api-key-here',
    ],
];
Добавьте API ключ в .env файл:

text
WB_API_KEY=your-actual-api-key-here
Использование
Через компонент:
php
// В любом месте приложения
$categories = Yii::$app->wildberries->getContent()->categories()->getParentCategories();

// Или через shortcuts
$categories = Yii::$app->wildberries->content()->categories()->getParentCategories();
Через модуль:
php
$module = Yii::$app->getModule('wildberries');
$categories = $module->content()->categories()->getParentCategories();
В контроллере:
php
class SiteController extends Controller
{
    public function actionCategories()
    {
        $categories = Yii::$app->wildberries->content()->categories()->getParentCategories();
        
        return $this->render('categories', [
            'categories' => $categories['data'] ?? []
        ]);
    }
}
Консольные команды:
bash
# Тестирование соединения
php yii wildberries/test-connection

# Список категорий
php yii wildberries/categories

# Лимиты карточек
php yii wildberries/limits
Конфигурация
Модуль поддерживает несколько способов конфигурации:

Через параметры модуля:

php
'modules' => [
    'wildberries' => [
        'class' => \wb\sdk\Module::class,
        'apiKey' => 'your-key',
    ],
],
Через компонент:

php
'components' => [
    'wildberries' => [
        'class' => \wb\sdk\components\WildberriesComponent::class,
        'apiKey' => 'your-key',
    ],
],
Через переменные окружения (рекомендуется):

php
'apiKey' => getenv('WB_API_KEY'),
Лицензия
MIT
