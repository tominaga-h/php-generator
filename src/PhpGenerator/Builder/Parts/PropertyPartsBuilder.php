<?php

namespace Hytmng\PhpGenerator\Builder\Parts;

use Hytmng\PhpGenerator\Builder\Parts\AbstractPartsBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpVisibilityType;
use Hytmng\PhpGenerator\Builder\Enum\PhpVariableType;
use Hytmng\PhpGenerator\Builder\Trait\Buildable;

/**
 * クラスのプロパティを構築するビルダー
 */
class PropertyPartsBuilder extends AbstractPartsBuilder
{
	use Buildable;

	// 変数名
	protected string $name;
	// 変数の型
	protected string $type;
	// アクセス権
	protected string $visibility;

	/**
	 * コンストラクタ
	 *
	 * @param string $name 変数名
	 * @param PhpVariableType|string $type 変数の型
	 * @param PhpVisibilityType $visibility 変数のアクセス権
	 */
	public function __construct(
		string $name,
		PhpVariableType|string $type,
		PhpVisibilityType $visibility
	) {
		$this->name = $name;
		$this->type = ($type instanceof PhpVariableType) ? $type->value : $type;
		$this->visibility = $visibility->value;
	}

	public function build(): string
	{
		return $this->buildStart()
			->buildVisibility()
			->buildType()
			->buildVariable()
			->buildEnd();
	}

	protected function buildVisibility(): self
	{
		$this->content .= $this->withSpaceRight($this->visibility);
		return $this;
	}

	protected function buildType(): self
	{
		$this->content .= $this->withSpaceRight($this->type);
		return $this;
	}

	protected function buildVariable(): self
	{
		$this->content .= $this->beVariable($this->name);
		return $this;
	}
}
