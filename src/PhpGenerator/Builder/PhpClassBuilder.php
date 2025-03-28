<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\PhpSyntax;
use Hytmng\PhpGenerator\Builder\AbstractBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpClassType;
use Hytmng\PhpGenerator\Builder\Parts\PropertyPartsBuilder;
use Hytmng\PhpGenerator\Builder\Trait\Buildable;

/**
 * PHPのクラスを構築するビルダー
 */
class PhpClassBuilder extends AbstractBuilder
{
	use Buildable;

	// クラス名
	protected string $className;
	// クラスの型
	protected PhpClassType $classType;
	// 継承元クラス
	protected ?string $extends;
	// 実装元インターフェース
	protected array $implements;
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
		$this->extends = null;
		$this->implements = [];
	}

	protected function basename(string $class): string
	{
		return \basename(\str_replace(PhpSyntax::NAMESPACE_SEPARATOR, '/', $class));
	}

	protected function containsNamespace(string $class): bool
	{
		return \str_contains($class, PhpSyntax::NAMESPACE_SEPARATOR);
	}

	/**
	 * 継承元のクラスを設定する
	 */
	public function extends(string $class): self
	{
		if ($this->containsNamespace($class)) {
			$class = $this->basename($class);
		}

		$this->extends = $class;
		return $this;
	}

	public function buildExtends(): self
	{
		if (!\is_null($this->extends)) {
			$this->content .= 'extends ' . $this->extends;
		}

		return $this;
	}

	/**
	 * 実装元のインターフェースを設定する
	 */
	public function implements(string $interface): self
	{
		if ($this->containsNamespace($interface)) {
			$interface = $this->basename($interface);
		}

		$this->implements[] = $interface;
		return $this;
	}

	public function buildImplements(): self
	{
		if (\count($this->implements) !== 0) {
			$this->content .= 'implements ' . \implode(', ', $this->implements);
		}

		return $this;
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
