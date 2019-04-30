<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Exceptions;

// Using directives
use Exception;

// Null conversion exception
class NullConversionException
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
			"A nullable object with a value of 'Null' cannot be cast to a non-nullable type"
		);
	}

}