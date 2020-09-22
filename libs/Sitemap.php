<?php

declare(strict_types=1);

/**
 * Sitemap::modify('a','pepe');
 * Sitemap::remove('a');
 * Sitemap::add('a','2020-12-09','daily');
 */

/**
 * Para añadir, modificar o borrar urls de un archivo xml (sitemap).
 */
class Sitemap
{

	private static string $sitemapName = 'sitemap.xml';

	private static $sitemap = '';

	/**
	 * Cargar archivo.
	 */
	private static function loadSitemap()
	{
		if (file_exists(self::$sitemapName)) {
			self::$sitemap = simplexml_load_file(self::$sitemapName);
		}
	}

	/**
	 * Añadir una url nueva al archivo xml.
	 */
	public static function add($new, $lastmod, $changefreg)
	{
		self::loadSitemap();
		$loc = 'https:' . URL_BASE . $new;

		$item = self::$sitemap->addChild('url');
		$item->addChild('loc', $loc);
		$item->addChild('lastmod', $lastmod);
		$item->addChild('changefreg', $changefreg);
		self::save();
	}

	/**
	 * Borrar un objeto del archivo, buscando por el nombre de url de la publicación.
	 */
	public static function remove($search)
	{
		self::loadSitemap();
		$seachUrl = 'https:' . URL_BASE . $search;

		foreach (self::$sitemap->url as $lineXml) {

			if ($seachUrl == $lineXml->loc) {
				$dom = dom_import_simplexml($lineXml);
				$dom->parentNode->removeChild($dom);
				break;
			}
		}
		self::save();
	}

	/**
	 * Modificar un objeto del archivo, buscando por el nombre de url de la publicación.
	 */
	public static function modify($search, $new, $lastmod = '', $changefreg)
	{
		self::loadSitemap();
		$loc = 'https:' . URL_BASE . $search;

		foreach (self::$sitemap->url as $lineXml) {

			if ($loc == $lineXml->loc) {

				$lineXml->loc = 'https:' . URL_BASE . $new;

				if (!empty($lastmod)) {
					$lineXml->lastmod = $lastmod;
				}

				if (!empty($frec)) {
					$lineXml->changefreg = $changefreg;
				}
				break;
			}
		}
		self::save();
	}

	/**
	 * Sobrescribe el archivo xml.
	 */
	private static function save()
	{
		self::$sitemap->asXml(self::$sitemapName);
	}
}
