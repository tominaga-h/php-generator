<?php

namespace Hytmng\PhpGenerator\Builder;


use Hytmng\PhpGenerator\Builder\AbstractBuilder;
use Hytmng\PhpGenerator\Builder\Trait\Buildable;
use Hytmng\PhpGenerator\Builder\Trait\Formattable;
use Hytmng\PhpGenerator\Symbol;

/**
 * HTMLタグを生成するビルダー
 */
class HtmlTagBuilder extends AbstractBuilder
{
	use Buildable, Formattable;

	// タグの名前
	protected string $tagName = '';
	// セルフクロージングタグかどうか
	protected bool $isSelfClosing = false;
	// タグの属性
	protected array $tagAttributes;
	// タグの内容
	protected string $tagContent;
	/** @var HtmlTagBuilder[] $children */
	protected array $children; // 子要素ビルダー

	// 強制的にセルフクロージングタグになるタグ（br、imgなど）
	protected const VOID_TAGS = [
		'br',
		'img',
		'input',
		'link',
		'meta',
		'hr',
		'area',
	];

	public function __construct(string $tagName)
	{
		$this->setTagName($tagName);
		$this->tagAttributes = [];
		$this->tagContent = '';
		$this->children = [];
	}

	/**
	 * タグ名を設定する
	 */
	public function setTagName(string $tagName): self
	{
		$this->tagName = $tagName;

		if ($this->isVoidTag()) {
			$this->setAsSelfClosingTag(); // セルフクロージングタグに設定
		}
		return $this;
	}

	/**
	 * 指定されたタグ名がセルフクロージングタグ(br、imgなど）かどうかを返す
	 */
	public function isVoidTag(): bool
	{
		return \in_array($this->tagName, self::VOID_TAGS);
	}

	/**
	 * 閉じタグを使わないタグ（セルフクロージングタグ）に設定する
	 */
	public function setAsSelfClosingTag(): self
	{
		$this->isSelfClosing = true;
		return $this;
	}

	/**
	 * タグの内容を設定する
	 *
	 * @throws \RuntimeException セルフクロージングタグに内容を設定しようとした場合
	 */
	public function setTagContent(string $content): self
	{
		if ($this->isSelfClosing) {
			throw new \RuntimeException('セルフクロージングタグには内容を設定できません');
		}

		$this->tagContent = $content;
		return $this;
	}


	protected function buildTagContent(): self
	{
		$this->content .= $this->insertIndent($this->tagContent);
		return $this;
	}

	/**
	 * 子要素を追加する
	 *
	 * @param HtmlTagBuilder $child 追加する子要素のビルダー
	 */
	public function appendChild(HtmlTagBuilder $child): self
	{
		$this->children[] = $child;
		return $this;
	}

	public function buildChildrenTags(): self
	{
		foreach ($this->children as $child) {
			$code = $child->build();
			$this->content .= $this->insertIndent($code);
		}

		return $this;
	}

	/**
	 * タグの属性を追加する
	 *
	 * @throws \Exception 同じ属性が既に存在した場合
	 */
	public function addTagAttribute(string $name, string|array $value): self
	{
		if (isset($this->tagAttributes[$name])) {
			throw new \Exception('同じ属性が既に存在します');
		}

		$this->tagAttributes[$name] = $value;
		return $this;
	}

	/**
	 * すべての属性をビルドする
	 */
	protected function buildTagAttributes(): self
	{
		foreach ($this->tagAttributes as $name => $value) {
			// 各属性間に半角スペースを追加する
			$this->buildSpace();

			if (\is_array($value)) {
				$this->buildArrayAttribute($name, $value);
			} else {
				$this->buildAttribute($name, $value);
			}
		}

		return $this;
	}

	protected function buildAttribute(string $name, string $value): self
	{
		$this->content .= $this->attachAttribute($name, $value);
		return $this;
	}

	protected function buildArrayAttribute(string $name, array $value): self
	{
		if ($name === 'style') {
			$this->buildStyleAttribute($value);
		} else {
			$this->content .= $this->attachArrayAttribute($name, $value);
		}

		return $this;
	}

	protected function buildStyleAttribute(array $value): self
	{
		/**
		 * ['background-color' => 'red', 'color' => 'blue']
		 * => style="background-color: red; color: blue;"
		 */

		$styles = [];
		foreach ($value as $key => $val) {
			$styles[] = "{$key}: {$val};";
		}

		$this->content .= $this->attachArrayAttribute('style', $styles);
		return $this;
	}



	public function build(): string
	{
		if ($this->isSelfClosing) {
			// オープンタグのみビルド
			return $this->buildStart()
				->buildOpenTagStart()
				->buildTagAttributes()
				->buildOpenTagEnd()
				->buildEnd()
				->getCode();
		}

		return $this->buildStart()
			->buildOpenTagStart()
			->buildTagAttributes()
			->buildOpenTagEnd()
			->buildTagContent()
			->buildChildrenTags()
			->buildCloseTag()
			->buildEnd()
			->getCode();
	}

	protected function buildOpenTagStart(): self
	{
		$this->content = '<' . $this->tagName;
		return $this;
	}

	protected function buildOpenTagEnd(): self
	{
		if ($this->isSelfClosing) {
			// セルフクロージングタグの場合は改行を付与しない
			$this->content .= $this->withSpaceLeft('/>');
		} else {
			$this->content .= $this->withNewLine('>');
		}

		return $this;
	}

	protected function buildCloseTag(): self
	{
		if (!$this->isSelfClosing) {
			$this->content .= "</{$this->tagName}>";
		}

		return $this;
	}

	protected function buildEnd(): self
	{
		// なにもしない
		return $this;
	}

	/**
	 * 属性の名称と配列の値を結合する
	 *
	 * @param string $name 属性の名称
	 * @param array $value 属性の値
	 * @return string
	 */
	protected function attachArrayAttribute(string $name, array $value): string
	{
		return $name . '="' . \implode(' ', $value) . '"';
	}

	/**
	 * 属性の名称と値を結合する
	 *
	 * @param string $name 属性の名称
	 * @param string $value 属性の値
	 * @return string
	 */
	protected function attachAttribute(string $name, string $value): string
	{
		return $name . '="' . $value . '"';
	}


}
