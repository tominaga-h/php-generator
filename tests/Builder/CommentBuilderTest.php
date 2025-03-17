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

	public function testBuild_multiline()
	{
		$builder = new CommentBuilder('comment');

		$actual = $builder->build();
		$expected = "/**\n * comment\n */\n";
		$this->assertSame($expected, $actual);
	}
}
