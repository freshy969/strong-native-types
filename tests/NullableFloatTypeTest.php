<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\NullableFloatType;

// Nullable float type test
class NullableFloatTypeTest extends TestCase
{

	/** @test */
	public function a_nullable_float_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals(1.5, NullableFloatType::from("1.5") -> value());

		// Execute the tests (integer)
		$this -> assertEquals(1.0, NullableFloatType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals(1.5, NullableFloatType::from(1.5) -> value());

		// Execute the tests (null)
		$this -> assertEquals(null, NullableFloatType::from(null) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals(1.0, NullableFloatType::from(true) -> value());
		$this -> assertEquals(0.0, NullableFloatType::from(false) -> value());
	}



	/** @test */
	public function a_nullable_float_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals(1.5, NullableFloatType::from(NullableFloatType::from(1.5)) -> value());
	}



	/** @test */
	public function a_nullable_float_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'NullableFloatType' as it does not possess the same parent type.");

		// Execute the tests
		NullableFloatType::from(new stdClass());
	}



	/** @test */
	public function a_nullable_float_type_cannot_be_created_from_an_incompatible_string()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'String' cannot be converted to an object of type " .
										"'NullableFloatType' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		NullableFloatType::from("test");
	}



	/** @test */
	public function a_nullable_float_type_converts_to_a_boolean()
	{
		// Execute the tests
		$this -> assertTrue(NullableFloatType::make(10.0) -> toBoolean());
		$this -> assertTrue(NullableFloatType::make(1.0) -> toBoolean());
		$this -> assertFalse(NullableFloatType::make(0.0) -> toBoolean());
		$this -> assertFalse(NullableFloatType::make(-1.0) -> toBoolean());
		$this -> assertFalse(NullableFloatType::make(-5.0) -> toBoolean());
	}



	/** @test */
	public function a_nullable_float_type_converts_to_a_integer()
	{
		// Execute the tests
		$this -> assertEquals(1, NullableFloatType::make(1.2) -> toInteger());
		$this -> assertEquals(1, NullableFloatType::make(1.49) -> toInteger());
		$this -> assertEquals(2, NullableFloatType::make(1.5) -> toInteger());
		$this -> assertEquals(2, NullableFloatType::make(1.75) -> toInteger());
	}

}