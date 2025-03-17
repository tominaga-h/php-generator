<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\Builder\AbstractBuilder;
use Hytmng\PhpGenerator\Builder\Trait\Buildable;

/**
 * コメントを構築するビルダー
 */
class CommentBuilder extends AbstractBuilder
{
    use Buildable;

    // コメント
    protected string $comment;
    // 説明文
    protected string $description;
    // インラインコメントかどうか
    protected bool $isInline = false;

    private const SYMBOL_INLINE = '// ';
    private const SYMBOL_MULTILINE_START = '/**';
    private const SYMBOL_MULTILINE_CONTENT = ' * ';
    private const SYMBOL_MULTILINE_END = ' */';

    /**
     * コンストラクタ
     *
     * @param string $comment コメントに指定する文字列
     */
    public function __construct(string $comment)
    {
        $this->comment = $comment;
        $this->description = '';
    }

    /**
     * 説明文を設定する
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * インラインコメントに設定する
     */
    public function setInline(): self
    {
        $this->isInline = true;
        return $this;
    }

    /**
     * ==================================================
     * コメントの種類
     */

    // inline comment

    /**
     * comment
     */

    /**
     * comment
     *
     * description
     */

    /**
     * comment
     *
     * description
     *
     * @param string $param
     * @return string
     */

    /**
     * ==================================================
     */

    /**
     * コメントをビルドする
     */
    public function build(): string
    {
        $this->buildStart()
            ->buildComment()
            ->buildDescription()
            ->buildEnd();
        return $this->content;
    }

    /**
     * コメントのビルドを開始する（初期化）
     */
    protected function buildStart(): self
    {
        if ($this->isInline) {
            $this->content = self::SYMBOL_INLINE;
            return $this;
        }

        // /**\n
        $this->content = $this->withNewLine(self::SYMBOL_MULTILINE_START);
        return $this;
    }

    /**
     * ビルドを終える
     */
    protected function buildEnd(): self
    {
        if (!$this->isInline) {
            //  */\n
            $this->content .= $this->withNewLine(self::SYMBOL_MULTILINE_END);
        }

        return $this;
    }

    /**
     * 文字列を複数行コメントの本文に変換する
     */
    protected function beMultilineContent(string $str): string
    {
        return $this->withNewLine(self::SYMBOL_MULTILINE_CONTENT . $str);
    }

    /**
     * 複数行コメントの空行を追加する
     */
    protected function buildEmptyLine(): self
    {
        $this->content .= $this->withNewLine(self::SYMBOL_MULTILINE_CONTENT);
        return $this;
    }

    protected function buildComment(): self
    {
        if (!$this->isInline) {
            $this->content .= self::SYMBOL_MULTILINE_CONTENT;
        }

        $this->content .= $this->withNewLine($this->comment);
        return $this;
    }

    protected function buildDescription(): self
    {
        if ($this->isInline || empty($this->description)) {
            return $this;
        }

        //  * （空行追加）
        $this->buildEmptyLine();

        // 複数行のdescriptionに対応
        if (\str_contains($this->description, PHP_EOL)) {
            $descriptions = \explode(PHP_EOL, $this->description);
            $this->content .= self::SYMBOL_MULTILINE_CONTENT;
            $this->content .= \implode(PHP_EOL . self::SYMBOL_MULTILINE_CONTENT, $descriptions);
            $this->content .= PHP_EOL;
        } else {
            $this->content .= $this->beMultilineContent($this->description);
        }
        return $this;
    }
}
