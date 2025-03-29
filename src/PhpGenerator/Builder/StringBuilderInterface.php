<?php

namespace Hytmng\PhpGenerator\Builder;

/**
 * 文字列を構築するビルダー
 */
interface StringBuilderInterface
{
    /**
     * 文字列を構築する
     */
    public function build(): string;

    /**
     * 構築した文字列を返す
     */
    public function getCode(): string;
}
