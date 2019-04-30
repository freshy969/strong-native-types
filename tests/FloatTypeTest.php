<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\FloatType;

// Float type test
class FloatTypeTest extends TestCase
{

	/** @test */
	public function a_float_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals(1.5, FloatType::from("1.5") -> value());

		// Execute the tests (integer)
		$this -> assertEquals(1.0, FloatType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals(1.5, FloatType::from(1.5) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals(1.0, FloatType::from(true) -> value());
		$this -> assertEquals(0.0, FloatType::from(false) -> value());
	}



	/** @test */
	public function a_float_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals(1.5, FloatType::from(FloatType::from(1.5)) -> value());
	}



	/** @test */
	public function a_float_type_cannot_be_assigned_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'FloatType'.");

		// Execute the tests
		FloatType::make(null);
	}



	/** @test */
	public function a_float_type_cannot_convert_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'FloatType'.");

		// Execute the tests
		FloatType::from(null);
	}



	/** @test */
	public function a_float_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'FloatType' as it does not possess the same parent type.");

		// Execute the tests
		FloatType::from(new stdClass());
	}



	/** @test */
	public function a_float_type_cannot_be_created_from_an_incompatible_string()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'String' cannot be converted to an object of type " .
										"'FloatType' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		FloatType::from("test");
	}



	/** @test */
	public function a_float_type_converts_to_a_boolean()
	{
		// Execute the tests
		$this -> assertTrue(FloatType::make(10.0) -> toBoolean());
		$this -> assertTrue(FloatType::make(1.0) -> toBoolean());
		$this -> assertFalse(FloatType::make(0.0) -> toBoolean());
		$this -> assertFalse(FloatType::make(-1.0) -> toBoolean());
		$this -> assertFalse(FloatType::make(-5.0) -> toBoolean());
	}



	/** @test */
	public function a_float_type_converts_to_a_integer()
	{
		// Execute the tests
		$this -> assertEquals(1, FloatType::make(1.2) -> toInteger());
		$this -> assertEquals(1, FloatType::make(1.49) -> toInteger());
		$this -> assertEquals(2, FloatType::make(1.5) -> toInteger());
		$this -> assertEquals(2, FloatType::make(1.75) -> toInteger());
	}

}