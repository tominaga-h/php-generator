<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\Builder\StringBuilderInterface;

abstract class AbstractBuilder implements StringBuilderInterface
{
    /**
     * 構築した文字列を保持するプロパティ
     */
    protected string $content;

    /**
     * 文字列を構築する
     */
    abstract public function build(): string;

}
