<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Support;

// Using directives
use Exception;

// Float utilities trait
trait FloatUtilities
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
	 * @return mixed.
	 *
	 **/
	public function add($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static($this -> container + $object);
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
	 * Set the data container to the next highest float value,
	 * rounding up the value if necessary.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function ceiling()
	{
		// Create a new instance and set its value
		return new static(ceil($this -> container));
	}



	/**
	 * Divide the given object from the data container.
	 *
	 * @param mixed $object.
	 * @return mixed.
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

		// Create a new instance and set its value
		return new static($this -> container / $object);
	}



	/**
	 * Set the data container to the next lowest float value,
	 * rounding down the value if necessary.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function floor()
	{
		// Create a new instance and set its value
		return new static(floor($this -> container));
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
	 * @return mixed.
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
	 * @return mixed.
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

		// Create a new instance and set its value
		return new static($this -> container * $object);
	}



	/**
	 * Set the data container to a cryptographically secure random float
	 * between the given minimum and maximum values.
	 *
	 * @param int $minimum.
	 * @param int $maximum.
	 * @return mixed.
	 *
	 **/
	public function random(int $minimum = 0, int $maximum = 10)
	{
		// Create a new instance and set its value
		return new static(random_int($minimum, $maximum - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX));
	}



	/**
	 * Divide the given object from the data container and set the remainder.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	public function remainderFrom($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static(floatval($this -> container % $object));
	}



	/**
	 * Round the value of the data container.
	 *
	 * @param int $precision.
	 * @param int $mode.
	 * @return mixed.
	 *
	 **/
	public function round(int $precision = 0, int $mode = PHP_ROUND_HALF_UP)
	{
		// Create a new instance and set its value
		return new static(round($this -> container, $precision, $mode));
	}



	/**
	 * Round down the value of the data container.
	 *
	 * @param int $precision.
	 * @param int $mode.
	 * @return mixed.
	 *
	 **/
	public function roundDown(int $precision = 0)
	{
		// Defer to the main method
		return $this -> round($precision, PHP_ROUND_HALF_DOWN);
	}



	/**
	 * Round the value of the data container to the nearest even precision.
	 *
	 * @param int $precision.
	 * @param int $mode.
	 * @return mixed.
	 *
	 **/
	public function roundEven(int $precision = 0)
	{
		// Defer to the main method
		return $this -> round($precision, PHP_ROUND_HALF_EVEN);
	}



	/**
	 * Round the value of the data container to the nearest odd precision.
	 *
	 * @param int $precision.
	 * @param int $mode.
	 * @return mixed.
	 *
	 **/
	public function roundOdd(int $precision = 0)
	{
		// Defer to the main method
		return $this -> round($precision, PHP_ROUND_HALF_ODD);
	}



	/**
	 * Round up the value of the data container.
	 *
	 * @param int $precision.
	 * @param int $mode.
	 * @return mixed.
	 *
	 **/
	public function roundUp(int $precision = 0)
	{
		// Defer to the main method
		return $this -> round($precision, PHP_ROUND_HALF_UP);
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

		// Create a new instance and set its value
		return new static($this -> container - $object);
	}

}