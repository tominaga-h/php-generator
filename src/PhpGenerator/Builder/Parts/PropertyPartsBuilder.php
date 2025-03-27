<?php

namespace Hytmng\PhpGenerator\Builder\Parts;

use Hytmng\PhpGenerator\Builder\Parts\AbstractPartsBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpVisibilityType;
use Hytmng\PhpGenerator\Builder\Enum\PhpVariableType;
use Hytmng\PhpGenerator\Builder\Trait\Buildable;
use Hytmng\PhpGenerator\Builder\Trait\Commentable;
use Hytmng\PhpGenerator\Builder\CommentBuilder;

/**
 * クラスのプロパティを構築するビルダー
 */
class PropertyPartsBuilder extends AbstractPartsBuilder
{
	use Buildable;
	use Commentable;

	// 変数名
	protected string $name;
	// 変数の型
	protected string $type;
	// アクセス権
	protected string $visibility;

	public function __construct() {
		$this->name = '';
		$this->type = '';
		$this->visibility = '';
	}

	/**
	 * 変数名を設定する
	 *
	 * @param string $name 変数名
	 */
	public function setVariableName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * 変数の型を設定する
	 *
	 * @param PhpVariableType|string $type 変数の型
	 */
	public function setVariableType(PhpVariableType|string $type): self
	{
		$this->type = ($type instanceof PhpVariableType) ? $type->value : $type;
		return $this;
	}

	/**
	 * アクセス権を設定する
	 *
	 * @param PhpVisibilityType $visibility 変数のアクセス権
	 */
	public function setVisibility(PhpVisibilityType $visibility): self
	{
		$this->visibility = $visibility->value;
		return $this;
	}

	public function build(): string
	{
		return $this->buildStart()
			->buildComment()
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
