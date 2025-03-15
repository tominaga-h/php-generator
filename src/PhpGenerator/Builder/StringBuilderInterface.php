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
}
