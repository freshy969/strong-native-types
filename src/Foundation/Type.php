<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Foundation;

// Using directives
use ReflectionClass;
use Alphametric\Strong\Foundation\Macro;

// Exceptions
use Alphametric\Strong\Exceptions\ObjectConversionException;
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// Type
abstract class Type
{

	/**
	 * Class traits.
	 *
	 **/
	use Macro;



	/**
	 * The data container for the type.
	 *
	 **/
	protected $container;



	/**
	 * Flag for whether the type can be changed.
	 *
	 **/
	protected $mutable = true;



	/**
	 * The native PHP data type the class maps to.
	 *
	 **/
	protected $type;



	/**
	 * Attempt to create a type instance from given object.
	 *
	 * @param mixed $object.
	 * @return instance.
	 *
	 **/
	protected static function fromObject($object)
	{
		// Check if the object is an acceptable sub type
		if (get_parent_class($object) === get_parent_class(static::class)) {
			return static::from($object -> value());
		}

		// Throw an exception
		ObjectConversionException::throw($object, static::getClassName());
	}



	/**
	 * Retrieve the name of the class.
	 *
	 * @param none.
	 * @return string.
	 *
	 **/
	protected static function getClassName()
	{
		// Retrieve the name of the class and return it
		return (new ReflectionClass(static::class)) -> getShortName();
	}



	/**
	 * Determine if the given object is a native type
	 * that maps to the strong type.
	 *
	 * @param mixed $object.
	 * @return bool.
	 *
	 **/
	public function isNativeTypeMatch($object)
	{
		// Define the PHP method for type comparison
		$method = "is_{$this -> type}";

		// Check if the object is a native type match
		return $method($object);
	}



	/**
	 * Determine if the given object maps to the strong type.
	 *
	 * @param mixed $object.
	 * @return bool.
	 *
	 **/
	public function isStrongTypeMatch($object)
	{
		// Execute the check and return the result
		return is_object($object) && get_class($object) === static::class;
	}



	/**
	 * Factory method to create a type instance.
	 *
	 * @param mixed $object.
	 * @return instance.
	 *
	 **/
	public static function make($object)
	{
		// Create the type instance and return it
		return new static($object);
	}



	/**
	 * Set the data container for the type.
	 *
	 * @param mixed $object.
	 * @return instance.
	 *
	 **/
	public function parse($object)
	{
		// Check if the object is a strong type match
		if ($this -> isStrongTypeMatch($object)) {
			return $this -> container = $object -> value();
		}

		// Check if the object is a native type match
		if ($this -> isNativeTypeMatch($object)) {
			return $this -> container = $object;
		}

		// Otherwise, throw an exception
		InvalidAssignmentException::throw($object, $this -> type());
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
		return is_null($this -> container) ? $default : boolval($this -> container);
	}



	/**
	 * Convert the data container to a float.
	 *
	 * @param float $default.
	 * @return float.
	 *
	 **/
	public function toFloat(float $default = 0.0)
	{
		// Execute the conversion and return the result
		return is_null($this -> container) ? $default : floatval($this -> container);
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
		return is_null($this -> container) ? $default : intval($this -> container);
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
		return is_null($this -> container) ? $default : strval($this -> container);
	}



	/**
	 * Magic method to enable rendering the object as a string e.g. for echo.
	 *
	 * @param none.
	 * @return string.
	 *
	 **/
	public function __toString()
	{
		// Execute the conversion and return the result
		return is_null($this -> container) ? "null" : strval($this -> container);
	}



	/**
	 * Retrieve the name of the class type.
	 *
	 * @param none.
	 * @return string.
	 *
	 **/
	public function type()
	{
		// Retrieve the name of the class and return it
		return static::getClassName();
	}



	/**
	 * Retrieve the underlying data container for the type.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function value()
	{
		// Retrieve the container and return it
		return $this -> container;
	}

}