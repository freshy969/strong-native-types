<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Types;

// Using directives
use Alphametric\Strong\Support\FloatUtilities;
use Alphametric\Strong\Foundation\NullableType;

// Exceptions
use Alphametric\Strong\Exceptions\DataImportException;
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// Nullable float type
class NullableFloatType extends NullableType
{

	/**
	 * Class traits.
	 *
	 **/
	use FloatUtilities;



	/**
	 * The native PHP data type the class maps to.
	 *
	 **/
	protected $type = "float";



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
								  ? static::make(floatval($object))
								  : DataImportException::throw($object, static::getClassName());
			case "integer" : return static::make(floatval($object));
			case "double"  : return static::make($object);
			case "boolean" : return static::make(floatval($object));
			case "object"  : return static::fromObject($object);
			case "NULL"    : return static::make(null);
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
		return is_null($this -> container) ? $default : $this -> container >= 1;
	}



	/**
	 * Convert the data container to an integer.
	 *
	 * @param int $default.
	 * @return int.
	 *
	 **/
	public function toInteger(int $default = 0)
	{
		// Execute the conversion and return the result
		return is_null($this -> container) ? $default : intval(round($this -> container));
	}

}