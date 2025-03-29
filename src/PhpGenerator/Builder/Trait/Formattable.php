<?php

namespace Hytmng\PhpGenerator\Builder\Trait;

use Hytmng\PhpGenerator\Symbol;

trait Formattable
{
	/**
	 * インデントの幅(初期値:4)
	 */
	protected int $indentSpaceLength = 4;

	/**
	 * インデントの幅を設定する
	 */
	public function setIndentSpaceLength(int $indentSpaceLength): self
	{
		$this->indentSpaceLength = $indentSpaceLength;
		return $this;
	}

	/**
	 * インデントの半角スペースを返す
	 *
	 * @param int $level インデントのレベル
	 * @return string
	 */
	protected function getIndentSpace(int $level = 1): string
	{
		return \str_repeat(Symbol::SPACE, $this->indentSpaceLength * $level);
	}

	/**
	 * インデントを付与した文字列を返す
	 */
	protected function withIndent(string $content, int $level = 1): string
	{
		return $this->getIndentSpace($level) . $content;
	}

	/**
     * 指定した文字列の右側に半角スペースを追加する
     *
     * @param string $str
     */
    protected function withSpaceRight(string $str): string
    {
        return $str . Symbol::SPACE;
    }

    /**
     * 指定した文字列の左側に半角スペースを追加する
     *
     * @param string $str
     */
    protected function withSpaceLeft(string $str): string
    {
        return Symbol::SPACE . $str;
    }

	/**
	 * 指定された文字列の右側に改行を追加する
	 */
	protected function withNewLine(string $str): string
	{
		return $str . PHP_EOL;
	}

}
