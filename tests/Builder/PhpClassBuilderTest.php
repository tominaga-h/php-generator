<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\PhpClassBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpClassType;

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
}
