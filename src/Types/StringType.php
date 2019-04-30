<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Types;

// Using directives
use Alphametric\Strong\Support\StringUtilities;
use Alphametric\Strong\Foundation\NonNullableType;

// Exceptions
use Alphametric\Strong\Exceptions\DataExportException;
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// String type
class StringType extends NonNullableType
{

	/**
	 * Class traits.
	 *
	 **/
	use StringUtilities;



	/**
	 * The native PHP data type the class maps to.
	 *
	 **/
	protected $type = "string";



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
			case "string"  : return static::make($object);
			case "integer" : return static::make(strval($object));
			case "double"  : return static::make(strval($object));
			case "boolean" : return static::make($object ? "true" : "false");
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
		// Check if the value can be converted
		if (! in_array($this -> container, ["true", "false", "1", "0"])) {
			DataExportException::throw($this, "Boolean");
		}

		// Execute the conversion and return the result
		return in_array($this -> container, ["true", "1"]);
	}



	/**
	 * Convert the data container to an float.
	 *
	 * @param float $default.
	 * @return float.
	 *
	 **/
	public function toFloat(float $default = 0.0)
	{
		// Check if the value can be converted
		if (! is_numeric($this -> container)) {
			DataExportException::throw($this, "Float");
		}

		// Execute the conversion and return the result
		return floatval($this -> container);
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
		// Check if the value can be converted
		if (! is_numeric($this -> container)) {
			DataExportException::throw($this, "Integer");
		}

		// Execute the conversion and return the result
		return intval(round($this -> container));
	}

}