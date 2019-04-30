<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Types;

// Using directives
use Alphametric\Strong\Support\BooleanUtilities;
use Alphametric\Strong\Foundation\NonNullableType;

// Exceptions
use Alphametric\Strong\Exceptions\DataImportException;
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// Boolean type
class BooleanType extends NonNullableType
{

	/**
	 * Class traits.
	 *
	 **/
	use BooleanUtilities;



	/**
	 * The native PHP data type the class maps to.
	 *
	 **/
	protected $type = "bool";



	/**
	 * Factory method to convert the given object into a type instance.
	 *
	 * @param mixed $object.
	 * @return instance.
	 *
	 **/
	public static function from($object)
	{
		// Convert the object
		switch (gettype($object)) {
			case "string"  : return in_array($object, ["true", "false", "1", "0"])
							 	  ? static::make(in_array($object, ["true", "1"]))
								  : DataImportException::throw($object, static::getClassName());
			case "integer" : return static::make($object >= 1);
			case "double"  : return static::make($object >= 1);
			case "boolean" : return static::make($object);
			case "object"  : return static::fromObject($object);
			default 	   : return InvalidAssignmentException::throw($object, static::getClassName());
		}
	}



	/**
	 * Convert the data container to a string.
	 *
	 * @param string $default.
	 * @return string.
	 *
	 **/
	public function toString(string $default = "")
	{
		// Execute the conversion and return the result
		return $this -> container ? "true" : "false";
	}

}