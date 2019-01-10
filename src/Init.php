<?php

namespace LSVH\WordPress\DynamicConfig;

defined('ABSPATH') or die();

class Init
{
	private static $slash = '/';
	private static $admin_dir = '/wp-admin';

	public static function url_without_path()
	{
		return self::get_protocol() . self::get_domain();
	}

	public static function url_with_path($install_dir = '')
	{
		return self::url_without_path() . self::get_path($install_dir);
	}

	public static function force_protocol($to = 'https') {
		$p = self::get_protocol();
		$protocol = !empty($to) && strpos($p, $to) === false ? $to.'://' : $p;
		self::do_redirect($protocol . self::get_domain());
	}

	public static function force_subdomain($to = 'www.') {
		$d = self::get_domain();
		$domain = !empty($to) && strpos($d, $to) === false ? $to . $d : $d;
		self::do_redirect(self::get_protocol() . $domain);
	}

	public static function force_domain($to) {
		$d = self::get_domain();
		$domain = $d !== $to ? $to : $d;
		self::do_redirect(self::get_protocol() . $domain);
	}

	public static function avoid_subdomain($from = 'www.') {
		$d = self::get_domain();
		$domain = !empty($from) && strpos($d, $from) === false ? $d : strstr($d, $from);
		self::do_redirect(self::get_protocol() . $domain);
	}

	private static function do_redirect($to) {
		if (self::get_protocol() . self::get_domain() !== $to) {
			$request = $_SERVER['REQUEST_URI'];
			header('Location: ' . $to . $request);
			exit();
		}
	}

	private static function get_path($install_dir = '') {
		$backtrace = debug_backtrace();
		$backtrace = !empty($backtrace) && is_array($backtrace) ? array_values(array_filter($backtrace, function($x) {
			return is_array($x) && array_key_exists('file', $x) && basename($x['file']) === 'wp-config.php';
		})) : [];
		
		$root = rtrim($_SERVER['DOCUMENT_ROOT'], self::$slash);
		$dir = rtrim(dirname(empty($backtrace) ? '' : $backtrace[0]['file']), self::$slash);
		$file_dir = rtrim(dirname($_SERVER['SCRIPT_FILENAME']), self::$slash);

		$path_dif = substr($file_dir, strlen($dir));

		$dir .= $path_dif;
		$path = substr($dir, strlen($root));

		$is_admin = strpos($path, self::$admin_dir) !== false;
		$path_without_admin = trim($is_admin ? strstr($path, self::$admin_dir, true) : $path, self::$slash);

		$is_install_dir = !empty($install_dir) && strpos($path_without_admin, $install_dir) !== false;
		$path_without_install_dir = $is_install_dir ? strstr($path_without_admin, $install_dir, true) : $path_without_admin;

		$path_with_slashes = empty($path_without_install_dir) ? '' : self::$slash . trim($path_without_install_dir, self::$slash);

		return empty($path_with_slashes) ? '' : $path_with_slashes;
	}

	private static function get_domain() {
		$host = $_SERVER['HTTP_HOST'];
		$name = $_SERVER['SERVER_NAME'];
		return empty($host) ? $name : $host;
	}

	private static function get_protocol() {
		$is_secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
		return 'http' . ( $is_secure ? 's' : '' ) . '://';
	}
}