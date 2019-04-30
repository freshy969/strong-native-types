<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\StringType;

// String type test
class StringTypeTest extends TestCase
{

	/** @test */
	public function a_string_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals("test", StringType::from("test") -> value());

		// Execute the tests (integer)
		$this -> assertEquals("1", StringType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals("1.5", StringType::from(1.5) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals("true", StringType::from(true) -> value());
		$this -> assertEquals("false", StringType::from(false) -> value());
	}



	/** @test */
	public function a_string_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals("test", StringType::from(StringType::from("test")) -> value());
	}



	/** @test */
	public function a_string_type_cannot_be_assigned_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'StringType'.");

		// Execute the tests
		StringType::make(null);
	}



	/** @test */
	public function a_string_type_cannot_convert_null()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'StringType'.");

		// Execute the tests
		StringType::from(null);
	}



	/** @test */
	public function a_string_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'StringType' as it does not possess the same parent type.");

		// Execute the tests
		StringType::from(new stdClass());
	}



	/** @test */
	public function a_string_type_converts_to_a_boolean()
	{
		// Execute the tests
		$this -> assertTrue(StringType::make("true") -> toBoolean());
		$this -> assertTrue(StringType::make("1") -> toBoolean());
		$this -> assertFalse(StringType::make("0") -> toBoolean());
		$this -> assertFalse(StringType::make("false") -> toBoolean());
	}



	/** @test */
	public function a_string_type_does_not_convert_to_a_boolean_when_invalid()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'StringType' cannot be converted to an object of " .
										"type 'Boolean' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		StringType::make("test") -> toBoolean();
	}



	/** @test */
	public function a_string_type_does_not_convert_to_a_float_when_invalid()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'StringType' cannot be converted to an object of " .
										"type 'Float' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		StringType::make("test") -> toFloat();
	}



	/** @test */
	public function a_string_type_does_not_convert_to_a_integer_when_invalid()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'StringType' cannot be converted to an object of " .
										"type 'Integer' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		StringType::make("test") -> toInteger();
	}

}