<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hytmng\PhpGenerator\Builder\HtmlTagBuilder;

$builder = new HtmlTagBuilder('button');
$builder
	->addTagAttribute('id', 'button')
	->addTagAttribute('class', ['btn', 'btn-primary'])
	->addTagAttribute('style', [
		'background' => 'red',
		'color' => 'white',
		'padding' => '20px',
	])
	->setTagContent('Click me')
;

echo $builder->build() . PHP_EOL;

/**
 * <button id="button" class="btn btn-primary" style="background: red; color: white; padding: 20px;">
 *     Click me
 * </button>
 */
