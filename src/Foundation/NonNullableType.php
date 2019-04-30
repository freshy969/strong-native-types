<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Foundation;

// Traits
use Alphametric\Strong\Foundation\Type as BaseType;

// Non nullable type
abstract class NonNullableType extends BaseType
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
		// Parse the supplied object
		$this -> parse($object);
	}



	/**
	 * Convert the object into its nullable implementation.
	 *
	 * @param none.
	 * @return NullableType.
	 *
	 **/
	public function toNullable()
	{
		// Construct a path to the desired class
		$class = str_replace("Types\\", "Types\\Nullable", get_class($this));

		// Create the new type and return it
		return new $class($this -> value());
	}

}