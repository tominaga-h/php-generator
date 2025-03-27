<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\CommentBuilder;

class CommentBuilderTest extends TestCase
{
	public function testBuild_inline()
	{
		$builder = new CommentBuilder();
		$builder->setComment('comment')->setAsInlineComment();

		$actual = $builder->build();
		$expected = "// comment\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_inline_withoutDescription()
	{
		$builder = new CommentBuilder();
		$builder->setComment('comment')
			->setDescription('description')
			->setAsInlineComment();

		$actual = $builder->build();
		$expected = "// comment\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_multiline()
	{
		$builder = new CommentBuilder();
		$builder->setComment('comment');

		$actual = $builder->build();
		$expected = "/**\n * comment\n */\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_multiline_description()
	{
		$builder = new CommentBuilder();
		$builder->setComment('comment')->setDescription('description');

		$actual = $builder->build();
		$expected = "/**\n"
			. " * comment\n"
			. " * \n"
			. " * description\n"
			. " */\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_multiline_multilineDescription()
	{
		$builder = new CommentBuilder();
		$builder->setComment('comment')
			->setDescription("description\ndescription\ndescription");

		$actual = $builder->build();
		$expected = "/**\n"
			. " * comment\n"
			. " * \n"
			. " * description\n"
			. " * description\n"
			. " * description\n"
			. " */\n";
		$this->assertSame($expected, $actual);
	}
}
