Iconized menu
=============

Allows you to create a menu with the corresponding favicon on the left of each item.

![Screenshot of the menu](https://raw.github.com/samdark/yii2-iconized-menu-widget/master/screenshot.png)

Installation
------------

Add the following to `require` section of your `composer.json`:

```
"samdark/yii2-iconized-menu-widget": "*"
```

Then do `composer install`.

Usage
-----

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
