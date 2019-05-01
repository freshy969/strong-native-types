<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Exceptions;

// Using directives
use Exception;

// Immutable type exception
class ImmutableTypeException
{

	/**
	 * Halt the execution due to an application error.
	 *
	 * @param none.
	 * @return void.
	 *
	 **/
	public static function throw()
	{
		// Throw the exception
		throw new Exception(
			"An immutable object type cannot have its data changed. If necessary, " .
			"cast the type to its mutable variety first"
		);
	}

}