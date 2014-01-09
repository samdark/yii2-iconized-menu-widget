Iconized menu
=============

Allows you to create a menu with the corresponding favicon on the left of each item.

```php
use samdark\widgets;
echo IconizedMenu::widget([
	'items' => [
		['label' => 'Yii Framework', 'url' => 'http://yiiframework.com/'],
		['label' => 'RMCreative', 'url' => 'http://rmcreative.ru/', 'items' => [
			['label' => 'Yii Framework Russia', 'url' => 'http://yiiframework.ru/'],
		]],
		['label' => 'Twitter', 'url' => 'http://twitter.com/'],
	],
]);
```
