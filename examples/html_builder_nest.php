<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hytmng\PhpGenerator\Builder\HtmlTagBuilder;

$outer = new HtmlTagBuilder('div');
$middle = new HtmlTagBuilder('p');
$inner = new HtmlTagBuilder('span');

$inner->setTagContent('inner');
$middle->setTagContent('middle')->appendChild($inner);
$outer->setTagContent('outer')->appendChild($middle);

echo $outer->build() . PHP_EOL;

/**
 * <div>
 *     outer
 *     <p>
 *         middle
 *         <span>
 *             inner
 *         </span>
 *     </p>
 * </div>
 */

