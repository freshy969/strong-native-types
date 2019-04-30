<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Exceptions;

// Using directives
use Exception;

// Data import exception
class DataImportException
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
			"cannot be converted to an object of type '$target' when its data " .
			"is not compatible e.g. converting the string 'email' to an integer."
		);
	}

}