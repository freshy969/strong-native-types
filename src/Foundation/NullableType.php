<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Foundation;

// Traits
use Alphametric\Strong\Foundation\Type as BaseType;

// Exceptions
use Alphametric\Strong\Exceptions\NullConversionException;

// Nullable type
abstract class NullableType extends BaseType
{

	/**
	 * Constructor.
	 *
	 * @param mixed $object.
	 * @return instance.
	 *
	 **/
	public function __construct($object)
	{
		// Check if the object is null
		if (is_null($object)) {
			return $this -> container = null;
		}

		// Parse the supplied object
		$this -> parse($object);
	}



	/**
	 * Convert the object into its non-nullable implementation.
	 *
	 * @param none.
	 * @return NonNullableType.
	 *
	 **/
	public function toNonNullable()
	{
		// Check if the object cannot be cast
		if (is_null($this -> value())) {
			NullConversionException::throw();
		}

		// Construct a path to the desired class
		$class = str_replace("Nullable", "", get_class($this));

		// Create the new type and return it
		return new $class($this -> value());
	}

}