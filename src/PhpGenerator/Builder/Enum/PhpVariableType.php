<?php

namespace Hytmng\PhpGenerator\Builder\Enum;

/**
 * PHPの変数の型
 */
enum PhpVariableType:string
{
	case INT = 'int';
	case FLOAT = 'float';
	case STRING = 'string';
	case BOOL = 'bool';
	case ARRAY = 'array';
	case OBJECT = 'object';
	case NULL = 'null';
}
