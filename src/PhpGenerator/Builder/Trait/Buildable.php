<?php

namespace Hytmng\PhpGenerator\Builder\Trait;

use Hytmng\PhpGenerator\Symbol;

/**
 * Builderに必要なユーティリティメソッドを提供するトレイト
 */
trait Buildable
{

    /**
     * ビルドを開始する（文字列を初期化する）
     */
    protected function buildStart(): static
    {
        $this->content = '';
        return $this;
    }

    /**
     * ビルドを終える
     */
    protected function buildEnd(): self
    {
		// NOTE: 将来的にセミコロンを追加する処理はPropertyPartsBuilderに移植するかも
        $this->content .= $this->withNewLine(Symbol::SEMICOLON);
        return $this;
    }

    /**
     * 半角スペースをビルドする
     */
    protected function buildSpace(): static
    {
        $this->content .= Symbol::SPACE;
        return $this;
    }


    /**
     * 指定された変数名に$を付与する
     *
     * @param string $varName 変数名
     */
    protected function beVariable(string $varName): string
    {
        return Symbol::VAR . $varName;
    }

}
