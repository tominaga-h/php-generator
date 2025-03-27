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
	// クラスの名前空間
	protected array $namespaces;
	/** @var PropertyPartsBuilder[] $properties */
	protected array $properties; // クラスのプロパティ
	// クラスのメソッド
	protected array $methods;

	// 名前空間の区切り文字
	private const NAMESPACE_SEPARATOR = '\\';

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
		$this->namespaces = [];
		$this->properties = [];
		$this->methods = [];
	}

	/**
	 * 名前空間を設定する
	 *
	 * 使用方法:
	 * - setNamespace('Root\\Package\\SubPackage')
	 * - setNamespace('Root')->setNamespace('Package')->setNamespace('SubPackage')
	 *
	 * @param string $namespace 名前空間
	 * @return self
	 */
	public function setNamespace(string $namespace): self
	{
		if (\str_starts_with($namespace, self::NAMESPACE_SEPARATOR)) {
			$namespace = ltrim($namespace, self::NAMESPACE_SEPARATOR);
		}

		if (\str_ends_with($namespace, self::NAMESPACE_SEPARATOR)) {
			$namespace = rtrim($namespace, self::NAMESPACE_SEPARATOR);
		}

		if (\str_contains($namespace, self::NAMESPACE_SEPARATOR)) {
			$namespaces = \explode(self::NAMESPACE_SEPARATOR, $namespace);
			$this->namespaces = \array_merge($this->namespaces, $namespaces);
			return $this;
		}

		$this->namespaces[] = $namespace;
		return $this;
	}
	/**
	 * @return string 名前空間の文字列
	 */
	public function getNamespace(): string
	{
		return \implode(self::NAMESPACE_SEPARATOR, $this->namespaces);
	}

	/**
	 * クラスのプロパティを追加する
	 */
	public function addProperty(PropertyPartsBuilder $property): self
	{
		$this->properties[] = $property;
		return $this;
	}

	public function build(): string
	{
		return $this->content;
	}
}
