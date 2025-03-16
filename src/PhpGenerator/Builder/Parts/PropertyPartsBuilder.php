<?php

namespace Hytmng\PhpGenerator\Builder\Parts;

use Hytmng\PhpGenerator\Builder\Parts\AbstractPartsBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpVisibilityType;
use Hytmng\PhpGenerator\Builder\Enum\PhpVariableType;

/**
 * クラスのプロパティを構築するビルダー
 */
class PropertyPartsBuilder extends AbstractPartsBuilder
{
	// 変数の型
	protected PhpVariableType|string $type;
	// アクセス権
	protected PhpVisibilityType $visibility;

	/**
	 * コンストラクタ
	 *
	 * @param string $name 名前
	 * @param PhpVariableType|string $type 変数の型
	 * @param PhpVisibilityType $visibility アクセス権
	 */
	public function __construct(
		string $name,
		PhpVariableType|string $type,
		PhpVisibilityType $visibility
	)
	{
		$this->name = $name;
		$this->type = ($type instanceof PhpVariableType) ? $type->value : $type;
		$this->visibility = $visibility;
		$this->content = '';
	}

	public function setDescription(string $description): self
	{
		$this->description = $description;
		return $this;
	}

	public function build(): string
	{
		return $this->content;
	}
}
