<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Support;

// Using directives
use Alphametric\Strong\Exceptions\InvalidAssignmentException;

// Utilities trait
trait Utilities
{

	/**
	 * Verify that the given object contains appropriate data.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	protected function validate($object)
	{
		// Prevent null assignment for non-nullable types
		if (is_null($object) && strpos(get_parent_class($this), "\\NullableType") !== false) {
			return $object;
		}

		// Check whether the object is a strong type
		if ($this -> isStrongTypeMatch($object)) {
			return $object -> value();
		}

		// Check whether the object is a native type match
		if ($this -> isNativeTypeMatch($object)) {
			return $object;
		}

		// Otherwise, throw an exception
		InvalidAssignmentException::throw($object, $this -> type());
	}

}