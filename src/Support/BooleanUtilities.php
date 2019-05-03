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
	 * @return mixed.
	 *
	 **/
	public function false()
	{
		// Create a new instance and set its value
		return new static(false);
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
	 * @return mixed.
	 *
	 **/
	public function true()
	{
		// Create a new instance and set its value
		return new static(true);
	}

}