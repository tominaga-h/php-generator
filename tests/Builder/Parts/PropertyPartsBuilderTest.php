<?php

namespace Tests\Builder\Parts;

use PHPUnit\Framework\TestCase;
use Hytmng\PhpGenerator\Builder\Parts\PropertyPartsBuilder;
use Hytmng\PhpGenerator\Builder\Enum\PhpVisibilityType;
use Hytmng\PhpGenerator\Builder\Enum\PhpVariableType;

class PropertyPartsBuilderTest extends TestCase
{
	private PropertyPartsBuilder $builder;


	public function testBuild_public_string()
	{
		$this->builder = new PropertyPartsBuilder(
			'test',
			PhpVariableType::STRING,
			PhpVisibilityType::PUBLIC
		);

		$actual = $this->builder->build();
		$expected = 'public string $test;';
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_protected_int()
	{
		$this->builder = new PropertyPartsBuilder(
			'test',
			PhpVariableType::INT,
			PhpVisibilityType::PROTECTED
		);

		$actual = $this->builder->build();
		$expected = 'protected int $test;';
		$this->assertEquals($expected, $actual);
	}
}
