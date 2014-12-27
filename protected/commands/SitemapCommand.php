<?php

date_default_timezone_set('Europe/Kiev');

/**
 * Class SitemapCommand
 */
class SitemapCommand extends ConsoleCommand {

	private $siteUrl = 'http://shkolyar.info';

	/**
	 * Включаем режим "не создавать пид-файл"
	 */
	protected function testMode() {

		return true;
	}

	protected function process() {

		// sitemap.xml
		$doc = new DOMDocument('1.0', 'utf-8');
		$urlset = $doc->createElement('urlset');
		$doc->appendChild($urlset);
		$xmlns = $doc->createAttribute('xmlns');
		$urlset->appendChild($xmlns);
		$value = $doc->createTextNode('http://www.sitemaps.org/schemas/sitemap/0.9');
		$xmlns->appendChild($value);

		$this->addItem($doc, $urlset, array(
			'loc' => $this->siteUrl . '/',
			'priority' => '1.0',
			'changefreq' => 'daily',
			'lastmod' => time(),
			'is_domain' => true,
		));

		// Models Map
		$sources = array(
			'Article',
			'ArticleCategory',
		);

		foreach ($sources as $modelName) {

			$criteria = new CDbCriteria();

			if ($modelName == 'Article') {
				$criteria->condition = '(publish_date <= now() || publish_date IS NULL)';
				$criteria->order = 'lastmod DESC';
			} elseif ($modelName == 'ArticleCategory') {
				$criteria->order = 'parent_id, id';
			}
			$offset = 0;
			while (true) {

				$criteria->offset = $offset;
				$criteria->limit = 100;
				$items = CActiveRecord::model($modelName)->findAll($criteria);
				if (empty($items)) break;

				foreach ($items as $item) {

					$priority = '0.4';
					if ($modelName == 'Article') {
						$priority = '0.5';
						if (strtotime($item->publish_date) >= time() - 3600 * 24 * 7) {
							$priority = '0.9';
						} elseif (strtotime($item->publish_date) >= time() - 3600 * 24 * 30) {
							$priority = '0.8';
						}
					}

					$this->addItem($doc, $urlset, array(
						'loc' => $item->getUrl(false),
						'lastmod' => $modelName == 'ArticleCategory' ? strtotime('01.01.' . date('Y')) : $item->lastmod,
						'priority' => $priority,
						'changefreq' => $modelName == 'Article' ? 'monthly' : 'yearly',
					));
				}

				$offset = $offset + 100;
			}
		}

		$doc->formatOutput = true;
		$doc->save(dirname(__FILE__) ."/../../sitemap.xml");
	}

	/**
	 * @param $doc
	 * @param $urlset
	 * @param $attributes
	 */
	private function addItem(&$doc, &$urlset, $attributes) {

		$url = $doc->createElement('url');
		$urlset->appendChild($url);

		$loc = $doc->createElement('loc');
		$url->appendChild($loc);
		$urlValue = (isset($attributes['is_domain'])) ? $attributes['loc'] : $this->siteUrl . $attributes['loc'];

		$value = $doc->createTextNode($urlValue);
		$loc->appendChild($value);

		$lastmod = $doc->createElement('lastmod');
		$url->appendChild($lastmod);
		$value = $doc->createTextNode(date('Y-m-d', $attributes['lastmod']));
		$lastmod->appendChild($value);

		$priority = $doc->createElement('priority');
		$value = $doc->createTextNode($attributes['priority']);
		$priority->appendChild($value);
		$url->appendChild($priority);

		$changefreq = $doc->createElement('changefreq');
		$value = $doc->createTextNode($attributes['changefreq']);
		$changefreq->appendChild($value);
		$url->appendChild($changefreq);
	}
}
