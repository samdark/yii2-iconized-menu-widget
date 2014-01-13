<?php
namespace samdark\iconizedMenu;

use Yii;
use yii\helpers\Html;

/**
 * IconizedMenu automatically adds favicons in front of menu links.
 *
 * ```php
 * use samdark\iconizedMenu;
 * echo Menu::widget([
 *     'items' => [
 *         ['label' => 'Yii Framework', 'url' => 'http://yiiframework.com/'],
 *         ['label' => 'RMCreative', 'url' => 'http://rmcreative.ru/', 'items' => [
 *             ['label' => 'Yii Framework Russia', 'url' => 'http://yiiframework.ru/'],
 *         ],
 *         ['label' => 'Twitter', 'url' => 'http://twitter.com/'],
 *     ],
 * ]);
 * ```
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Menu extends \yii\widgets\Menu
{
	public $useSprites = true;
	public $yandexBaseUrl = 'http://favicon.yandex.net/favicon/';
	public $iconizerBaseUrl = 'http://www.google.com/s2/favicons?domain=';

	private $spriteUrl = null;
	private $itemOffset = 0;

	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'iconized');

		Yii::$app->view->registerCss(
<<<CSS
.iconized li {
	background: no-repeat 0 50%;
}

.iconized a {
	padding-left: 20px;
}
CSS
		, [], 'samdark/IconizedMenu');

		if($this->useSprites) {
			$domains = $this->fetchDomains($this->items);
			$this->spriteUrl = $this->yandexBaseUrl . implode('/', $domains);
		}
	}

	private function fetchDomains($items, &$domains = [])
	{
		foreach ($items as $item) {
			if (!empty($item['url'])) {
				$components = parse_url($item['url']);
				$domains[] = $components['host'];
			}
			if (!empty($item['items'])) {
				$this->fetchDomains($item['items'], $domains);
			}
		}
		return $domains;
	}

	/**
	 * Renders the content of a menu item.
	 * Note that the container and the sub-menus are not rendered here.
	 * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
	 * @return string the rendering result
	 */
	protected function renderItem($item)
	{
		if (isset($item['url'])) {
			if($this->useSprites) {
				$spriteUrl = $this->spriteUrl;
				$item['template'] = "<a href=\"{url}\" style=\"background: no-repeat 0 {$this->itemOffset}px url($spriteUrl);\">{label}</a>";
				$this->itemOffset -= 16;
			} else {
				$components = parse_url($item['url']);
				$iconUrl = $this->iconizerBaseUrl . $components['host'];
				$item['template'] = "<a href=\"{url}\" style=\"background: no-repeat url($iconUrl)\">{label}</a>";
			}
		}
		return parent::renderItem($item);
	}

	public function run()
	{
		parent::run();
		$this->itemOffset = 0;
	}
}
