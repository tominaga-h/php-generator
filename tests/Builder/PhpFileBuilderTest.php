<?php

namespace Tests\Builder;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\PhpFileBuilder;

/**
 * PhpFileBuilderのテスト
 */
class PhpFileBuilderTest extends TestCase
{
	private PhpFileBuilder $builder;

	protected function setUp(): void
	{
		$this->builder = new PhpFileBuilder('TestClass');
	}

	public function testNamespace_withSeparator()
	{
		$namespace = 'Root\\Package\\SubPackage';
		$this->builder->setNamespace($namespace);

		$actual = $this->builder->getNamespace();
		$this->assertEquals($namespace, $actual);
	}

	public function testNamespace_withoutSeparator()
	{
		$this->builder
			->setNamespace('Root')
			->setNamespace('Package')
			->setNamespace('SubPackage');

		$actual = 'Root\\Package\\SubPackage';
		$expected = $this->builder->getNamespace();
		$this->assertEquals($expected, $actual);
	}

	public function testNamespace_withSeparator_atStart()
	{
		$this->builder->setNamespace('\\Root');

		$actual = $this->builder->getNamespace();
		$expected = 'Root';
		$this->assertEquals($expected, $actual);
	}

	public function testNamespace_withSeparator_atEnd()
	{
		$this->builder->setNamespace('Root\\');

		$actual = $this->builder->getNamespace();
		$expected = 'Root';
		$this->assertEquals($expected, $actual);
	}

	public function testNamespace_withSeparator_atStartAndEnd()
	{
		$this->builder->setNamespace('\\Root\\');

		$actual = $this->builder->getNamespace();
		$expected = 'Root';
		$this->assertEquals($expected, $actual);
	}
}
