<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\IntegerType;

// Integer type test
class IntegerTypeTest extends TestCase
{

	/** @test */
	public function a_integer_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals(1, IntegerType::from("1") -> value());

		// Execute the tests (integer)
		$this -> assertEquals(1, IntegerType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals(2, IntegerType::from(1.5) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals(1, IntegerType::from(true) -> value());
		$this -> assertEquals(0, IntegerType::from(false) -> value());
	}



	/** @test */
	public function a_integer_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals(1, IntegerType::from(IntegerType::from(1)) -> value());
	}



	/** @test */
	public function a_integer_type_cannot_be_assigned_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'IntegerType'.");

		// Execute the tests
		IntegerType::make(null);
	}



	/** @test */
	public function a_integer_type_cannot_convert_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'IntegerType'.");

		// Execute the tests
		IntegerType::from(null);
	}



	/** @test */
	public function a_integer_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'IntegerType' as it does not possess the same parent type.");

		// Execute the tests
		IntegerType::from(new stdClass());
	}



	/** @test */
	public function a_integer_type_cannot_be_created_from_an_incompatible_string()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'String' cannot be converted to an object of type " .
										"'IntegerType' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		IntegerType::from("test");
	}



	/** @test */
	public function a_integer_type_converts_to_a_boolean()
	{
		// Execute the tests
		$this -> assertTrue(IntegerType::make(10) -> toBoolean());
		$this -> assertTrue(IntegerType::make(1) -> toBoolean());
		$this -> assertFalse(IntegerType::make(0) -> toBoolean());
		$this -> assertFalse(IntegerType::make(-1) -> toBoolean());
		$this -> assertFalse(IntegerType::make(-5) -> toBoolean());
	}

}