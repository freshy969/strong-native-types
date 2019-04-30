<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\FloatType;
use Alphametric\Strong\Types\NullableFloatType;

// Float utilities test
class FloatUtilitiesTest extends TestCase
{

	/** @test */
	public function an_float_can_add_a_value()
	{
		// Execute the tests
		$this -> assertEquals(3.0, FloatType::make(1.0) -> add(2.0) -> value());
		$this -> assertEquals(3.0, FloatType::make(1.0) -> add(FloatType::make(2.0)) -> value());
	}



	/** @test */
	public function an_float_can_subtract_a_value()
	{
		// Execute the tests
		$this -> assertEquals(1.0, FloatType::make(2.0) -> subtract(1.0) -> value());
		$this -> assertEquals(1.0, FloatType::make(2.0) -> subtract(FloatType::make(1.0)) -> value());
	}



	/** @test */
	public function an_float_can_multiply_a_value()
	{
		// Execute the tests
		$this -> assertEquals(4.0, FloatType::make(2.0) -> multiplyBy(2.0) -> value());
		$this -> assertEquals(4.0, FloatType::make(2.0) -> multiplyBy(FloatType::make(2.0)) -> value());
	}



	/** @test */
	public function an_float_cannot_multiply_by_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("You cannot multiply a value by null");

		// Execute the tests
		NullableFloatType::make(null) -> multiplyBy(NullableFloatType::make(null)) -> value();
	}



	/** @test */
	public function an_float_can_divide_a_value()
	{
		// Execute the tests
		$this -> assertEquals(2.0, FloatType::make(4.0) -> divideBy(2.0) -> value());
		$this -> assertEquals(2.0, FloatType::make(4.0) -> divideBy(FloatType::make(2.0)) -> value());
	}



	/** @test */
	public function an_float_cannot_divide_a_value_if_it_is_zero()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("You cannot divide by zero or null");

		// Execute the tests
		FloatType::make(3.0) -> divideBy(FloatType::make(0.0)) -> value();
	}



	/** @test */
	public function an_float_cannot_divide_a_value_if_it_is_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("You cannot divide by zero or null");

		// Execute the tests
		NullableFloatType::make(3.0) -> divideBy(NullableFloatType::make(null)) -> value();
	}



	/** @test */
	public function an_float_can_get_the_remainder()
	{
		// Execute the tests
		$this -> assertEquals(0.0, FloatType::make(4.0) -> remainderFrom(2.0) -> value());
		$this -> assertEquals(2.0, FloatType::make(2.0) -> remainderFrom(FloatType::make(3.0)) -> value());
	}


	/** @test */
	public function an_float_can_get_the_modulus()
	{
		// Execute the tests
		$this -> assertEquals(0.0, FloatType::make(4.0) -> modulusFrom(2.0) -> value());
		$this -> assertEquals(2.0, FloatType::make(2.0) -> modulusFrom(FloatType::make(3.0)) -> value());
	}



	/** @test */
	public function an_float_can_get_a_random_number()
	{
		// Store the result
		$result = FloatType::make(4.0) -> random(1, 2) -> value();

		// Execute the tests
		$this -> assertTrue($result > 1.0);
		$this -> assertTrue($result < 2.0);
	}



	/** @test */
	public function an_float_can_get_the_ceiling()
	{
		// Execute the tests
		$this -> assertEquals(5.0, FloatType::make(4.3) -> ceiling() -> value());
	}



	/** @test */
	public function an_float_can_get_the_floor()
	{
		// Execute the tests
		$this -> assertEquals(4.0, FloatType::make(4.3) -> floor() -> value());
	}



	/** @test */
	public function an_float_can_get_the_rounded_value()
	{
		// Execute the tests
		$this -> assertEquals(4.0, FloatType::make(4.3) -> round() -> value());
		$this -> assertEquals(5.0, FloatType::make(4.5) -> roundUp() -> value());
		$this -> assertEquals(4.0, FloatType::make(4.5) -> roundDown() -> value());
		$this -> assertEquals(4.0, FloatType::make(4.5) -> roundEven() -> value());
		$this -> assertEquals(4.0, FloatType::make(4.3) -> roundOdd() -> value());
	}



	/** @test */
	public function an_float_can_be_checked_if_greater_than_a_value()
	{
		// Execute the tests
		$this -> assertTrue(FloatType::make(2.0) -> greaterThan(1.0));
		$this -> assertFalse(FloatType::make(2.0) -> greaterThan(3.0));
	}



	/** @test */
	public function an_float_can_be_checked_if_greater_than_or_equal_to_a_value()
	{
		// Execute the tests
		$this -> assertFalse(FloatType::make(2.0) -> greaterThanOrEqualTo(3.0));
		$this -> assertTrue(FloatType::make(2.0) -> greaterThanOrEqualTo(2.0));
	}



	/** @test */
	public function an_float_can_be_checked_if_less_than_a_value()
	{
		// Execute the tests
		$this -> assertTrue(FloatType::make(1.0) -> lessThan(2.0));
		$this -> assertFalse(FloatType::make(3.0) -> lessThan(2.0));
	}



	/** @test */
	public function an_float_can_be_checked_if_less_than_or_equal_to_a_value()
	{
		// Execute the tests
		$this -> assertFalse(FloatType::make(2.0) -> lessThanOrEqualTo(1.0));
		$this -> assertTrue(FloatType::make(2.0) -> lessThanOrEqualTo(2.0));
	}



	/** @test */
	public function an_float_can_be_checked_if_between_two_values()
	{
		// Execute the tests
		$this -> assertTrue(FloatType::make(1.0) -> between(0.0, 2.0));
		$this -> assertFalse(FloatType::make(3.0) -> between(1.0, 2.0));
	}



	/** @test */
	public function an_float_cannot_be_checked_if_between_two_values_when_supplying_invalid_range()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("The starting figure cannot be greater than the finishing figure.");

		// Execute the tests
		FloatType::make(3.0) -> between(10.0, 9.0);
	}



	/** @test */
	public function an_float_can_chain_utilities_to_get_a_result()
	{
		// Execute the tests
		$this -> assertEquals(2.0, FloatType::make(4.0) -> add(2.0) -> subtract(2.0) -> multiplyBy(2.0) -> divideBy(4.0) -> value());
	}

}