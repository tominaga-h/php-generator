<?php

namespace Hytmng\PhpGenerator\Builder\Enum;

/**
 * PHPのアクセス権
 */
enum PhpVisibilityType
{
	case PUBLIC;
	case PRIVATE;
	case PROTECTED;
	case FINAL;
}
