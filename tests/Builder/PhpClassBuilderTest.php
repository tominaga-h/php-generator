<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\PhpClassBuilder;
use Hytmng\PhpGenerator\Builder\PhpClassType;

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

	public function testNamespace_withSeparator()
	{
		$namespace = 'Root\\Package\\SubPackage';
		$this->builder->setNamespace($namespace);

		$actual = $this->builder->getNamespaces();
		$expected = ['Root', 'Package', 'SubPackage'];
		$this->assertEquals($expected, $actual);
		$this->assertEquals($namespace, $this->builder->getNamespace());
	}

	public function testNamespace_withoutSeparator()
	{
		$this->builder
			->setNamespace('Root')
			->setNamespace('Package')
			->setNamespace('SubPackage');

		$actual = $this->builder->getNamespaces();
		$expected = ['Root', 'Package', 'SubPackage'];
		$this->assertEquals($expected, $actual);

		$actual = 'Root\\Package\\SubPackage';
		$expected = $this->builder->getNamespace();
		$this->assertEquals($expected, $actual);
	}

	public function testNamespace_withSeparator_atStart()
	{
		$this->builder->setNamespace('\\Root');

		$actual = $this->builder->getNamespaces();
		$expected = ['Root'];
		$this->assertEquals($expected, $actual);
	}

	public function testNamespace_withSeparator_atEnd()
	{
		$this->builder->setNamespace('Root\\');

		$actual = $this->builder->getNamespaces();
		$expected = ['Root'];
		$this->assertEquals($expected, $actual);
	}

}
