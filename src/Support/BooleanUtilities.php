<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Support;

// Using directives
use Exception;

// Boolean utilities trait
trait BooleanUtilities
{

	/**
	 * Class traits.
	 *
	 **/
	use Utilities;



	/**
	 * Set the data container to a negative value.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function false()
	{
		// Ensure the type is not immutable
		$this -> bailWhenImmutable();

		// Defer to the main method
		return $this -> set(false);
	}



	/**
	 * Determine if the data container is negative.
	 *
	 * @param none.
	 * @return bool.
	 *
	 **/
	public function isFalse()
	{
		// Return the result
		return $this -> container === false;
	}



	/**
	 * Determine if the data container is positive.
	 *
	 * @param none.
	 * @return bool.
	 *
	 **/
	public function isTrue()
	{
		// Return the result
		return $this -> container === true;
	}



	/**
	 * Set the data container to a positive value.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function true()
	{
		// Ensure the type is not immutable
		$this -> bailWhenImmutable();

		// Defer to the main method
		return $this -> set(true);
	}

}