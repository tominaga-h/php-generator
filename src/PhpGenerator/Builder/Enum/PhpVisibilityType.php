<?php

namespace Hytmng\PhpGenerator\Builder\Enum;

/**
 * PHPのアクセス権
 */
enum PhpVisibilityType:string
{
	case PUBLIC = 'public';
	case PRIVATE = 'private';
	case PROTECTED = 'protected';
	case FINAL = 'final';
}
