<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\PhpClassBuilder;
use Hytmng\PhpGenerator\Builder\AbstractBuilder;
use Hytmng\PhpGenerator\Builder\StringBuilderInterface;

/**
 * PhpClassBuilderのテスト
 *
 * コーディング規約:
 * - アサーションメソッド:
 *   - 期待値を`$expected`という変数に定義
 *   - 実際の値を`$actual`という変数に定義
 *   - アサーションで比較する際は`assertEquals($expected, $actual)`とする
 * - `$actual`を取得するための処理を実行するコードと、`$actual`の定義は1行空ける
 */
class PhpClassBuilderTest extends TestCase
{
	private PhpClassBuilder $builder;

	protected function setUp(): void
	{
		$this->builder = new PhpClassBuilder('TestClass');
	}

	public function testClassName()
	{
		$actual = $this->builder->getClassName();
		$expected = 'TestClass';
		$this->assertEquals($expected, $actual);
	}

	public function testExtends_withNamespace()
	{
		$this->builder->extends(AbstractBuilder::class);

		$actual = $this->builder->buildExtends();
		$expected = 'extends AbstractBuilder';
		$this->assertEquals($expected, $actual);
	}

	public function testExtends_withoutNamespace()
	{
		$this->builder->extends('AbstractBuilder');

		$actual = $this->builder->buildExtends();
		$expected = 'extends AbstractBuilder';
		$this->assertEquals($expected, $actual);
	}

	public function testExtends_null()
	{
		$actual = $this->builder->buildExtends();
		$expected = null;
		$this->assertEquals($expected, $actual);
	}

	public function testImplements_withNamespace()
	{
		$this->builder->implements(StringBuilderInterface::class);

		$actual = $this->builder->buildImplements();
		$expected = 'implements StringBuilderInterface';
		$this->assertEquals($expected, $actual);
	}

	public function testImplements_withoutNamespace()
	{
		$this->builder->implements('StringBuilderInterface');

		$actual = $this->builder->buildImplements();
		$expected = 'implements StringBuilderInterface';
		$this->assertEquals($expected, $actual);

	}

	public function testImplements_multiple()
	{
		$this->builder->implements('StringBuilderInterface')->implements('Interface');

		$actual = $this->builder->buildImplements();
		$expected = 'implements StringBuilderInterface, Interface';
		$this->assertEquals($expected, $actual);
	}

	public function testImplements_null()
	{
		$actual = $this->builder->buildImplements();
		$expected = null;
		$this->assertEquals($expected, $actual);
	}
}
