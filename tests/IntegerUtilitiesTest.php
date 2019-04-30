<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\IntegerType;
use Alphametric\Strong\Types\NullableIntegerType;

// Integer utilities test
class IntegerUtilitiesTest extends TestCase
{

	/** @test */
	public function an_integer_can_add_a_value()
	{
		// Execute the tests
		$this -> assertEquals(3, IntegerType::make(1) -> add(2) -> value());
		$this -> assertEquals(3, IntegerType::make(1) -> add(IntegerType::make(2)) -> value());
	}



	/** @test */
	public function an_integer_can_subtract_a_value()
	{
		// Execute the tests
		$this -> assertEquals(1, IntegerType::make(2) -> subtract(1) -> value());
		$this -> assertEquals(1, IntegerType::make(2) -> subtract(IntegerType::make(1)) -> value());
	}



	/** @test */
	public function an_integer_can_multiply_a_value()
	{
		// Execute the tests
		$this -> assertEquals(4, IntegerType::make(2) -> multiplyBy(2) -> value());
		$this -> assertEquals(4, IntegerType::make(2) -> multiplyBy(IntegerType::make(2)) -> value());
	}



	/** @test */
	public function an_integer_cannot_multiply_by_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("You cannot multiply a value by null");

		// Execute the tests
		NullableIntegerType::make(null) -> multiplyBy(NullableIntegerType::make(null)) -> value();
	}



	/** @test */
	public function an_integer_can_divide_a_value()
	{
		// Execute the tests
		$this -> assertEquals(2, IntegerType::make(4) -> divideBy(2) -> value());
		$this -> assertEquals(2, IntegerType::make(4) -> divideBy(IntegerType::make(2)) -> value());
	}



	/** @test */
	public function an_integer_cannot_divide_a_value_if_the_result_is_a_float()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("Unable to divide by '4'. The result is not an integer");

		// Execute the tests
		IntegerType::make(3) -> divideBy(IntegerType::make(4)) -> value();
	}



	/** @test */
	public function an_integer_cannot_divide_a_value_if_it_is_zero()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("You cannot divide by zero or null");

		// Execute the tests
		IntegerType::make(3) -> divideBy(IntegerType::make(0)) -> value();
	}



	/** @test */
	public function an_integer_cannot_divide_a_value_if_it_is_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("You cannot divide by zero or null");

		// Execute the tests
		NullableIntegerType::make(3) -> divideBy(NullableIntegerType::make(null)) -> value();
	}



	/** @test */
	public function an_integer_can_get_the_remainder()
	{
		// Execute the tests
		$this -> assertEquals(0, IntegerType::make(4) -> remainderFrom(2) -> value());
		$this -> assertEquals(2, IntegerType::make(2) -> remainderFrom(IntegerType::make(3)) -> value());
	}


	/** @test */
	public function an_integer_can_get_the_modulus()
	{
		// Execute the tests
		$this -> assertEquals(0, IntegerType::make(4) -> modulusFrom(2) -> value());
		$this -> assertEquals(2, IntegerType::make(2) -> modulusFrom(IntegerType::make(3)) -> value());
	}



	/** @test */
	public function an_integer_can_get_a_random_number()
	{
		// Execute the tests
		$this -> assertTrue(in_array(IntegerType::make(4) -> random(1, 2) -> value(), [1, 2]));
		$this -> assertFalse(in_array(IntegerType::make(4) -> random(1, 2) -> value(), [0, 3]));
	}



	/** @test */
	public function an_integer_can_be_checked_if_greater_than_a_value()
	{
		// Execute the tests
		$this -> assertTrue(IntegerType::make(2) -> greaterThan(1));
		$this -> assertFalse(IntegerType::make(2) -> greaterThan(3));
	}



	/** @test */
	public function an_integer_can_be_checked_if_greater_than_or_equal_to_a_value()
	{
		// Execute the tests
		$this -> assertFalse(IntegerType::make(2) -> greaterThanOrEqualTo(3));
		$this -> assertTrue(IntegerType::make(2) -> greaterThanOrEqualTo(2));
	}



	/** @test */
	public function an_integer_can_be_checked_if_less_than_a_value()
	{
		// Execute the tests
		$this -> assertTrue(IntegerType::make(1) -> lessThan(2));
		$this -> assertFalse(IntegerType::make(3) -> lessThan(2));
	}



	/** @test */
	public function an_integer_can_be_checked_if_less_than_or_equal_to_a_value()
	{
		// Execute the tests
		$this -> assertFalse(IntegerType::make(2) -> lessThanOrEqualTo(1));
		$this -> assertTrue(IntegerType::make(2) -> lessThanOrEqualTo(2));
	}



	/** @test */
	public function an_integer_can_be_checked_if_between_two_values()
	{
		// Execute the tests
		$this -> assertTrue(IntegerType::make(1) -> between(0, 2));
		$this -> assertFalse(IntegerType::make(3) -> between(1, 2));
	}



	/** @test */
	public function an_integer_cannot_be_checked_if_between_two_values_when_supplying_invalid_range()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("The starting figure cannot be greater than the finishing figure.");

		// Execute the tests
		IntegerType::make(3) -> between(10, 9);
	}



	/** @test */
	public function an_integer_can_chain_utilities_to_get_a_result()
	{
		// Execute the tests
		$this -> assertEquals(2, IntegerType::make(4) -> add(2) -> subtract(2) -> multiplyBy(2) -> divideBy(4) -> value());
	}

}