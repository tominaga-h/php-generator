<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\Symbol;
use Hytmng\PhpGenerator\Builder\AbstractBuilder;
class PhpFileBuilder extends AbstractBuilder
{
	// ファイルの名前
	protected string $fileName;
	// ファイルの名前空間
	protected array $namespaces;

	public function __construct(string $fileName)
	{
		$this->fileName = $fileName;
		$this->namespaces = [];
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
		if (\str_starts_with($namespace, Symbol::NAMESPACE_SEPARATOR)) {
			$namespace = ltrim($namespace, Symbol::NAMESPACE_SEPARATOR);
		}

		if (\str_ends_with($namespace, Symbol::NAMESPACE_SEPARATOR)) {
			$namespace = rtrim($namespace, Symbol::NAMESPACE_SEPARATOR);
		}

		if (\str_contains($namespace, Symbol::NAMESPACE_SEPARATOR)) {
			$namespaces = \explode(Symbol::NAMESPACE_SEPARATOR, $namespace);
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
		return \implode(Symbol::NAMESPACE_SEPARATOR, $this->namespaces);
	}

	public function build(): string
	{
		return $this->content;
	}
}
