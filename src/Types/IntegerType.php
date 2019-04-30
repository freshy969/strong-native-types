<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Types;

// Using directives
use Alphametric\Strong\Support\IntegerUtilities;
use Alphametric\Strong\Foundation\NonNullableType;

// Exceptions
use Alphametric\Strong\Exceptions\DataImportException;
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// Integer type
class IntegerType extends NonNullableType
{

	/**
	 * Class traits.
	 *
	 **/
	use IntegerUtilities;



	/**
	 * The native PHP data type the class maps to.
	 *
	 **/
	protected $type = "int";



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
			case "string"  : return is_numeric($object)
								  ? static::make(intval(round($object)))
								  : DataImportException::throw($object, static::getClassName());
			case "integer" : return static::make($object);
			case "double"  : return static::make(intval(round($object)));
			case "boolean" : return static::make(intval($object));
			case "object"  : return static::fromObject($object);
			default 	   : return InvalidAssignmentException::throw($object, static::getClassName());
		}
	}



	/**
	 * Convert the data container to a boolean.
	 *
	 * @param bool $default.
	 * @return bool.
	 *
	 **/
	public function toBoolean(bool $default = false)
	{
		// Execute the conversion and return the result
		return $this -> container >= 1;
	}

}