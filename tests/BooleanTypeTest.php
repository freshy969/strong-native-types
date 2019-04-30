<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\BooleanType;

// Boolean type test
class BooleanTypeTest extends TestCase
{

	/** @test */
	public function a_boolean_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals(true, BooleanType::from("1") -> value());
		$this -> assertEquals(true, BooleanType::from("true") -> value());

		// Execute the tests (integer)
		$this -> assertEquals(true, BooleanType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals(true, BooleanType::from(1.5) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals(true, BooleanType::from(true) -> value());
		$this -> assertEquals(false, BooleanType::from(false) -> value());
	}



	/** @test */
	public function a_boolean_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals(true, BooleanType::from(BooleanType::from("1")) -> value());
	}



	/** @test */
	public function a_boolean_type_cannot_be_assigned_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'BooleanType'.");

		// Execute the tests
		BooleanType::make(null);
	}



	/** @test */
	public function a_boolean_type_cannot_convert_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'BooleanType'.");

		// Execute the tests
		BooleanType::from(null);
	}



	/** @test */
	public function a_boolean_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'BooleanType' as it does not possess the same parent type.");

		// Execute the tests
		BooleanType::from(new stdClass());
	}



	/** @test */
	public function a_boolean_type_cannot_be_created_from_an_incompatible_string()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'String' cannot be converted to an object of type " .
										"'BooleanType' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		BooleanType::from("test");
	}



	/** @test */
	public function a_boolean_type_converts_to_a_integer()
	{
		// Execute the tests
		$this -> assertEquals("true", BooleanType::make(true) -> toString());
		$this -> assertEquals("false", BooleanType::make(false) -> toString());
	}

}