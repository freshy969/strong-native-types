<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\NullableStringType;

// Nullable string type test
class NullableStringTypeTest extends TestCase
{

	/** @test */
	public function a_nullable_string_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals("test", NullableStringType::from("test") -> value());

		// Execute the tests (integer)
		$this -> assertEquals("1", NullableStringType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals("1.5", NullableStringType::from(1.5) -> value());

		// Execute the tests (null)
		$this -> assertEquals(null, NullableStringType::from(null) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals("true", NullableStringType::from(true) -> value());
		$this -> assertEquals("false", NullableStringType::from(false) -> value());
	}



	/** @test */
	public function a_nullable_string_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals("test", NullableStringType::from(NullableStringType::from("test")) -> value());
	}



	/** @test */
	public function a_nullable_string_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'NullableStringType' as it does not possess the same parent type.");

		// Execute the tests
		NullableStringType::from(new stdClass());
	}



	/** @test */
	public function a_nullable_string_type_converts_to_a_boolean()
	{
		// Execute the tests
		$this -> assertTrue(NullableStringType::make("true") -> toBoolean());
		$this -> assertTrue(NullableStringType::make("1") -> toBoolean());
		$this -> assertFalse(NullableStringType::make("0") -> toBoolean());
		$this -> assertFalse(NullableStringType::make("false") -> toBoolean());
	}



	/** @test */
	public function a_nullable_string_type_does_not_convert_to_a_boolean_when_invalid()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'NullableStringType' cannot be converted to an object of " .
										"type 'Boolean' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		NullableStringType::make("test") -> toBoolean();
	}



	/** @test */
	public function a_nullable_string_type_does_not_convert_to_a_float_when_invalid()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'NullableStringType' cannot be converted to an object of " .
										"type 'Float' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		NullableStringType::make("test") -> toFloat();
	}



	/** @test */
	public function a_nullable_string_type_does_not_convert_to_a_integer_when_invalid()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'NullableStringType' cannot be converted to an object of " .
										"type 'Integer' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		NullableStringType::make("test") -> toInteger();
	}

}