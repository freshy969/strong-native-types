<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Support;

// Using directives
use Exception;

// Integer utilities trait
trait IntegerUtilities
{

	/**
	 * Class traits.
	 *
	 **/
	use Utilities;



	/**
	 * Add the given object to the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function add($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Add the value
		$this -> container += $object;

		// Allow method chaining
		return $this;
	}



	/**
	 * Determine if the data container is greater than the given object.
	 *
	 * @param mixed $start.
	 * @param mixed $finish.
	 * @return bool.
	 *
	 **/
	public function between($start, $finish)
	{
		// Validate the data
		$start  = $this -> validate($start);
		$finish = $this -> validate($finish);

		// Check the user has not supplied invalid options
		if ($start >= $finish) {
			throw new Exception("The starting figure cannot be greater than the finishing figure.");
		}

		// Return the result
		return $this -> container >= $start && $this -> container <= $finish;
	}



	/**
	 * Divide the given object from the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function divideBy($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Prevent division by zero or null
		if (in_array($object, [0, null])) {
			throw new Exception("You cannot divide by zero or null");
		}

		// Prevent division that results in a float
		if (! is_int($this -> container / $object)) {
			throw new Exception("Unable to divide by '$object'. The result is not an integer");
		}

		// Divide the value
		$this -> container /= $object;

		// Allow method chaining
		return $this;
	}



	/**
	 * Determine if the data container is greater than the given object.
	 *
	 * @param mixed $object.
	 * @return bool.
	 *
	 **/
	public function greaterThan($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Return the result
		return $this -> container > $object;
	}



	/**
	 * Determine if the data container is greater than or equal to the given object.
	 *
	 * @param mixed $object.
	 * @return bool.
	 *
	 **/
	public function greaterThanOrEqualTo($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Return the result
		return $this -> container >= $object;
	}



	/**
	 * Determine if the data container is less than the given object.
	 *
	 * @param mixed $object.
	 * @return bool.
	 *
	 **/
	public function lessThan($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Return the result
		return $this -> container < $object;
	}



	/**
	 * Determine if the data container is less than or equal to the given object.
	 *
	 * @param mixed $object.
	 * @return bool.
	 *
	 **/
	public function lessThanOrEqualTo($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Return the result
		return $this -> container <= $object;
	}



	/**
	 * Alias of the remainder function.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function modulusFrom($object)
	{
		// Trigger the main method
		return $this -> remainderFrom($object);
	}



	/**
	 * Multiply the given object against the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function multiplyBy($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Prevent multiplication by null
		if (is_null($object)) {
			throw new Exception("You cannot multiply a value by null");
		}

		// Multiply the value
		$this -> container *= $object;

		// Allow method chaining
		return $this;
	}



	/**
	 * Set the data container to a cryptographically secure random integer
	 * between the given minimum and maximum values.
	 *
	 * @param int $minimum.
	 * @param int $maximum.
	 * @return $this.
	 *
	 **/
	public function random(int $minimum = 0, int $maximum = 10)
	{
		// Set the value
		$this -> container = random_int($minimum, $maximum);

		// Allow method chaining
		return $this;
	}



	/**
	 * Divide the given object from the data container and set the remainder.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function remainderFrom($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Set the value to the remainder
		$this -> container %= $object;

		// Allow method chaining
		return $this;
	}



	/**
	 * Subtract the given object from the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function subtract($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Subtract the value
		$this -> container -= $object;

		// Allow method chaining
		return $this;
	}

}