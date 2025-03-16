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
     * ビルドを終える（セミコロンを追加する）
     */
    protected function buildEnd(): static
    {
        $this->content .= self::SYMBOL_SEMICOLON;
        return $this;
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
}
