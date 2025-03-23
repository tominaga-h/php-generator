<?php

namespace Hytmng\PhpGenerator\Builder\Trait;

use Hytmng\PhpGenerator\Builder\CommentBuilder;

trait Commentable
{
	// コメントビルダー
	protected CommentBuilder $commentBuilder;

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
		return $this->commentBuilder;
	}

	public function commentSettingExists(): bool
	{
		$builder = $this->getCommentBuilder();
		return $builder->commentSettingExists();
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
	public function setInlineComment(): self
	{
		$builder = $this->getCommentBuilder();
		$builder->setInline();
		return $this;
	}

	/**
	 * コメントをビルドする
	 */
	public function buildComment(): self
	{
		$builder = $this->getCommentBuilder();
		if ($builder->commentSettingExists()) {
			$this->content .= $builder->build();
		}
		return $this;
	}
}
