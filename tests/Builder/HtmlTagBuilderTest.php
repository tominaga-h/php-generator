<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\HtmlTagBuilder;

/**
 * HtmlTagBuilderのテスト
 */
class HtmlTagBuilderTest extends TestCase
{
	private HtmlTagBuilder $builder;

	protected function setUp(): void
	{
		$this->builder = new HtmlTagBuilder('div');
	}

	public function testBuild_MostSimple()
	{
		$this->builder
			->addTagAttribute('id', 'id')
			->setTagContent('content');

		$actual = $this->builder->build();
		$expected = "<div id=\"id\">\n    content\n</div>";
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_selfClosingTag()
	{
		$this->builder
			->setAsSelfClosingTag()
			->addTagAttribute('id', 'id');

		$actual = $this->builder->build();
		$expected = "<div id=\"id\" />";
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_styleAttribute()
	{
		$this->builder
			->addTagAttribute('style', ['color' => 'red', 'font-size' => '12px'])
			->setTagContent('content');

		$actual = $this->builder->build();
		$expected = "<div style=\"color: red; font-size: 12px;\">\n    content\n</div>";
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_multipileAttributes()
	{
		$this->builder
			->addTagAttribute('id', 'button')
			->addTagAttribute('class', ['btn', 'btn-primary'])
			->setTagContent('content');

		$actual = $this->builder->build();
		$expected = "<div id=\"button\" class=\"btn btn-primary\">\n    content\n</div>";
		$this->assertEquals($expected, $actual);
	}

	public function testTagContent_throw()
	{
		$this->expectException(\RuntimeException::class);
		$this->builder->setAsSelfClosingTag()->setTagContent('content');
	}

	public function testBuild_voidTag()
	{
		$this->builder = new HtmlTagBuilder('br');

		$actual = $this->builder->isVoidTag();
		$this->assertTrue($actual);

		$this->builder = new HtmlTagBuilder('img');

		$actual = $this->builder->build();
		$expected = "<img />";
		$this->assertEquals($expected, $actual);
	}

	public function testAddTagAttribute_throw()
	{
		$this->expectException(\Exception::class);
		$this->builder->addTagAttribute('id', 'id')->addTagAttribute('id', 'id');
	}

	public function testSetIndentSpaceLength()
	{
		$this->builder
			->setIndentSpaceLength(2)
			->setTagContent('content');

		$actual = $this->builder->build();
		$expected = "<div>\n  content\n</div>";
		$this->assertEquals($expected, $actual);
	}

	public function testTagContent_multipleLines()
	{
		$this->builder
			->setIndentSpaceLength(2)
			->setTagContent("line1\nline2");

		$actual = $this->builder->build();
		$expected = "<div>\n  line1\n  line2\n</div>";
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_nest()
	{
		$childBuilder = new HtmlTagBuilder('p');
		$childBuilder ->setTagContent('child');

		$this->builder->setTagContent($childBuilder->build());

		$actual = $this->builder->build();
		$expected = "<div>\n    <p>\n        child\n    </p>\n</div>";
		$this->assertEquals($expected, $actual);
	}
}
