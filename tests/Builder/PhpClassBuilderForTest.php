<?php

namespace Tests\Builder;

use Hytmng\PhpGenerator\Builder\PhpClassBuilder;
use Hytmng\PhpGenerator\Builder\PhpClassType;

/**
 * PhpClassBuilderを継承しテスト用のメソッドを追加したクラス
 */
class PhpClassBuilderForTest extends PhpClassBuilder
{
	public function __construct(
		string $className,
		PhpClassType $classType = PhpClassType::DEFAULT
	)
	{
		parent::__construct($className, $classType);
	}

	/**
	 * @return string[] 名前空間の配列
	 */
	public function getNamespaces(): array
	{
		return $this->namespaces;
	}

}
