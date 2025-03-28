<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hytmng\PhpGenerator\Builder\HtmlTagBuilder;

$builder = new HtmlTagBuilder('img');
$builder
	->addTagAttribute('src', 'https://example.com/image.jpg')
	->addTagAttribute('alt', 'image');

echo $builder->build() . PHP_EOL;

/**
 * <img src="https://example.com/image.jpg" alt="image" />
 */
