<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\CommentBuilder;

class CommentBuilderTest extends TestCase
{
	public function testBuild_inline()
	{
		$builder = new CommentBuilder('comment');
		$builder->setInline();

		$actual = $builder->build();
		$expected = "// comment\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_inline_withoutDescription()
	{
		$builder = new CommentBuilder('comment');
		$builder->setInline();
		$builder->setDescription('description');

		$actual = $builder->build();
		$expected = "// comment\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_multiline()
	{
		$builder = new CommentBuilder('comment');

		$actual = $builder->build();
		$expected = "/**\n * comment\n */\n";
		$this->assertSame($expected, $actual);
	}

	public function testBuild_multiline_description()
	{
		$builder = new CommentBuilder('comment');
		$builder->setDescription('description');

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
		$builder = new CommentBuilder('comment');
		$builder->setDescription("description\ndescription\ndescription");

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
