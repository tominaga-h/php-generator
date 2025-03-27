<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\Builder\AbstractBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpClassType;
use Hytmng\PhpGenerator\Builder\Parts\PropertyPartsBuilder;

/**
 * PHPのクラスを構築するビルダー
 */
class PhpClassBuilder extends AbstractBuilder
{
	// クラス名
	protected string $className;
	// クラスの型
	protected PhpClassType $classType;
	/** @var PropertyPartsBuilder[] $properties */
	protected array $properties; // クラスのプロパティ
	// クラスのメソッド
	protected array $methods;

	/**
	 * コンストラクタ
	 *
	 * @param string $className クラス名
	 * @param PhpClassType $classType クラスの型
	 */
	public function __construct(
		string $className,
		PhpClassType $classType = PhpClassType::DEFAULT
	)
	{
		$this->content = '';
		$this->className = $className;
		$this->classType = $classType;
		$this->properties = [];
		$this->methods = [];
	}

	/**
	 * クラスのプロパティを追加する
	 */
	public function addProperty(PropertyPartsBuilder $property): self
	{
		$this->properties[] = $property;
		return $this;
	}

	public function getClassName(): string
	{
		return $this->className;
	}

	public function build(): string
	{
		return $this->content;
	}
}
