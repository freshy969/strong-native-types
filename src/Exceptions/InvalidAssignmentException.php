<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Exceptions;

// Using directives
use Exception;

// Invalid assignment exception
class InvalidAssignmentException
{

	/**
	 * Halt the execution due to an application error.
	 *
	 * @param mixed $source.
	 * @param string $target.
	 * @return void.
	 *
	 **/
	public static function throw($source, $target)
	{
		// Throw the exception
		throw new Exception(
			"An object of type '" . ucwords(mb_strtolower(gettype($source))) . "' " .
			"cannot be assigned to an object of type '$target'."
		);
	}

}