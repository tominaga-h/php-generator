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
		$this->builder = new PropertyPartsBuilder();
		$this->builder->setVariableName('test')
			->setVariableType(PhpVariableType::STRING)
			->setVisibility(PhpVisibilityType::PUBLIC);

		$actual = $this->builder->build();
		$expected = "public string \$test;\n";
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_protected_int()
	{
		$this->builder = new PropertyPartsBuilder();
		$this->builder->setVariableName('test')
			->setVariableType(PhpVariableType::INT)
			->setVisibility(PhpVisibilityType::PROTECTED);

		$actual = $this->builder->build();
		$expected = "protected int \$test;\n";
		$this->assertEquals($expected, $actual);
	}

	public function testBuild_withComment()
	{
		$this->builder = new PropertyPartsBuilder();
		$this->builder
			->setVariableName('test')
			->setVariableType(PhpVariableType::STRING)
			->setVisibility(PhpVisibilityType::PUBLIC)
			->setComment('comment')
			->setDescription('description');

		$actual = $this->builder->build();
		$expected = "/**\n"
			. " * comment\n"
			. " * \n"
			. " * description\n"
			. " */\n"
			. "public string \$test;\n";
		$this->assertEquals($expected, $actual);
	}
}
