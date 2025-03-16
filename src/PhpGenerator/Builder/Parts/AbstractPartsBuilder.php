<?php

namespace Hytmng\PhpGenerator\Builder\Parts;

use Hytmng\PhpGenerator\Builder\AbstractBuilder;

abstract class AbstractPartsBuilder extends AbstractBuilder
{
	/**
	 * 名前情報
	 */
	protected string $name;

	/**
	 * パーツの説明
	 */
	protected string $description;
}
