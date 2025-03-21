<?php

namespace Hytmng\PhpGenerator\Builder\Trait;

/**
 * Builderに必要なユーティリティメソッドを提供するトレイト
 */
trait Buildable
{
	private const SYMBOL_VAR = '$';
    private const SYMBOL_SEMICOLON = ';';
    private const SYMBOL_SPACE = ' ';

    /**
     * ビルドを開始する（文字列を初期化する）
     */
    protected function buildStart(): static
    {
        $this->content = '';
        return $this;
    }

    /**
     * ビルドを終え、ビルド結果の文字列を返す
	 *
	 * @return string ビルド結果の文字列
     */
    protected function buildEnd(): string
    {
		// NOTE: 将来的にセミコロンを追加する処理はPropertyPartsBuilderに移植するかも
        $this->content .= self::SYMBOL_SEMICOLON;
        return $this->content;
    }

    /**
     * 半角スペースをビルドする
     */
    protected function buildSpace(): static
    {
        $this->content .= self::SYMBOL_SPACE;
        return $this;
    }

    /**
     * 指定した文字列の右側に半角スペースを追加する
     *
     * @param string $str
     */
    protected function withSpaceRight(string $str): string
    {
        return $str . self::SYMBOL_SPACE;
    }

    /**
     * 指定した文字列の左側に半角スペースを追加する
     *
     * @param string $str
     */
    protected function withSpaceLeft(string $str): string
    {
        return self::SYMBOL_SPACE . $str;
    }

    /**
     * 指定された変数名に$を付与する
     *
     * @param string $varName 変数名
     */
    protected function beVariable(string $varName): string
    {
        return self::SYMBOL_VAR . $varName;
    }

	/**
	 * 指定された文字列の右側に改行を追加する
	 */
	protected function withNewLine(string $str): string
	{
		return $str . PHP_EOL;
	}
}
