<?php
/**
 * Plugin Name: Daily moon
 * Description: Daily moon information for modern witches: moon phase, illumination, moon cycle, moonrise and moonset, moon sign.
 */

require plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

use DailyMoon\Wordpress\Bootstrap;
use Pimple\Container;
use DailyMoon\DailyMoonProvider;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = new Container();
$container->register(new DailyMoonProvider());

/** @var Bootstrap */
$container[Bootstrap::class]();
