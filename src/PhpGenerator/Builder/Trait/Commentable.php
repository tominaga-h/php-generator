<?php

namespace Hytmng\PhpGenerator\Builder\Trait;

use Hytmng\PhpGenerator\Builder\CommentBuilder;

trait Commentable
{
	// コメントビルダー
	protected ?CommentBuilder $commentBuilder = null;

	/**
	 * コメントビルダーを設定する
	 *
	 * @param CommentBuilder $commentBuilder コメントビルダー
	 * @return self
	 */
	public function setCommentBuilder(CommentBuilder $commentBuilder): self
	{
		$this->commentBuilder = $commentBuilder;
		return $this;
	}

	/**
	 * コメントビルダーを取得する
	 *
	 * @return CommentBuilder
	 */
	public function getCommentBuilder(): CommentBuilder
	{
		return $this->commentBuilder ??= new CommentBuilder();
	}

	public function hasComment(): bool
	{
		$builder = $this->getCommentBuilder();
		return $builder->hasComment();
	}

	/**
	 * コメントを設定する
	 *
	 * @param string $comment コメントに指定する文字列
	 * @return self
	 */
	public function setComment(string $comment): self
	{
		$builder = $this->getCommentBuilder();
		$builder->setComment($comment);
		return $this;
	}

	/**
	 * 説明文を設定する
	 *
	 * @param string $description コメントの説明文に指定する文字列
	 * @return self
	 */
	public function setDescription(string $description): self
	{
		$builder = $this->getCommentBuilder();
		$builder->setDescription($description);
		return $this;
	}

	/**
	 * インラインコメントを設定する
	 *
	 * @return self
	 */
	public function setAsInlineCommentComment(): self
	{
		$builder = $this->getCommentBuilder();
		$builder->setAsInlineComment();
		return $this;
	}

	/**
	 * コメントをビルドする
	 */
	public function buildComment(): self
	{
		$builder = $this->getCommentBuilder();
		if ($builder->hasComment()) {
			$this->content .= $builder->build();
		}
		return $this;
	}
}
