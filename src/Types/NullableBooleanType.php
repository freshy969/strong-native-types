<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Types;

// Using directives
use Alphametric\Strong\Foundation\NullableType;
use Alphametric\Strong\Support\BooleanUtilities;

// Exceptions
use Alphametric\Strong\Exceptions\DataImportException;
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// Nullable boolean type
class NullableBooleanType extends NullableType
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
	 * Factory method to create a type instance from the given object.
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
			case "NULL"    : return static::make(null);
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
		return is_null($this -> container) ? $default : $this -> container ? "true" : "false";
	}

}