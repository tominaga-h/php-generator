<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\Builder\AbstractBuilder;

class PhpFileBuilder extends AbstractBuilder
{
	// ファイルの名前
	protected string $fileName;
	// ファイルの名前空間
	protected array $namespaces;

	// 名前空間の区切り文字
	private const NAMESPACE_SEPARATOR = '\\';

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

	public function build(): string
	{
		return $this->content;
	}
}
