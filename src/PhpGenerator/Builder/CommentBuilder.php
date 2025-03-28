<?php

namespace Hytmng\PhpGenerator\Builder;

use Hytmng\PhpGenerator\Builder\AbstractBuilder;
use Hytmng\PhpGenerator\Builder\Trait\Buildable;
use Hytmng\PhpGenerator\Symbol;

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
    protected bool $isInlineComment = false;
    // コメントが設定されているか
    protected bool $hasComment = false;

    public function __construct()
    {
        $this->comment = '';
        $this->description = '';
    }

    /**
     * コメントを設定する
     *
     * @param string $comment コメントに指定する文字列
     * @return self
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        $this->hasComment = true;
        return $this;
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
    public function setAsInlineComment(): self
    {
        $this->isInlineComment = true;
        return $this;
    }

    /**
     * 既にcommentが設定されていればtrue、未設定であればfalseを返す
     * descriptionの設定は関わらない
     *
     * @return bool
     */
    public function hasComment(): bool
    {
        return $this->hasComment;
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
        // TODO: PHPDocのビルド
        return $this->buildStart()
            ->buildComment()
            ->buildDescription()
            ->buildEnd()
            ->getCode();
    }

    /**
     * コメントのビルドを開始する（初期化）
     */
    protected function buildStart(): self
    {
        if ($this->isInlineComment) {
            $this->content = Symbol::COMMENT_INLINE;
            return $this;
        }

        // /**\n
        $this->content = $this->withNewLine(Symbol::COMMENT_MULTILINE_START);
        return $this;
    }

    /**
     * ビルドを終える
     */
    protected function buildEnd(): self
    {
        if (!$this->isInlineComment) {
            //  */\n
            $this->content .= $this->withNewLine(Symbol::COMMENT_MULTILINE_END);
        }

        return $this;
    }

    /**
     * 文字列を複数行コメントの本文に変換する
     */
    protected function asMultilineContent(string $str): string
    {
        return $this->withNewLine(Symbol::COMMENT_MULTILINE_CONTENT . $str);
    }

    /**
     * 複数行コメントの空行を追加する
     */
    protected function buildEmptyLine(): self
    {
        $this->content .= $this->withNewLine(Symbol::COMMENT_MULTILINE_CONTENT);
        return $this;
    }

    protected function buildComment(): self
    {
        if (!$this->isInlineComment) {
            $this->content .= Symbol::COMMENT_MULTILINE_CONTENT;
        }

        $this->content .= $this->withNewLine($this->comment);
        return $this;
    }

    protected function buildDescription(): self
    {
        if ($this->isInlineComment || empty($this->description)) {
            return $this;
        }

        //  * （空行追加）
        $this->buildEmptyLine();

        // 複数行のdescriptionに対応
        // 例: setDescription('description\ndescription\ndescription')
        if (\str_contains($this->description, PHP_EOL)) {
            // ['description', 'description', 'description']
            $descriptions = \explode(PHP_EOL, $this->description);
            $this->content .= Symbol::COMMENT_MULTILINE_CONTENT;
            // description\n * description\n * description
            $this->content .= \implode(PHP_EOL . Symbol::COMMENT_MULTILINE_CONTENT, $descriptions);
            $this->content .= PHP_EOL;
        } else {
            $this->content .= $this->asMultilineContent($this->description);
        }
        return $this;
    }
}
