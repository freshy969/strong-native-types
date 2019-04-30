<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\NullableIntegerType;

// Nullable integer type test
class NullableIntegerTypeTest extends TestCase
{

	/** @test */
	public function a_nullable_integer_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals(1, NullableIntegerType::from("1") -> value());

		// Execute the tests (integer)
		$this -> assertEquals(1, NullableIntegerType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals(2, NullableIntegerType::from(1.5) -> value());

		// Execute the tests (null)
		$this -> assertEquals(null, NullableIntegerType::from(null) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals(1, NullableIntegerType::from(true) -> value());
		$this -> assertEquals(0, NullableIntegerType::from(false) -> value());
	}



	/** @test */
	public function a_nullable_integer_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals(1, NullableIntegerType::from(NullableIntegerType::from(1)) -> value());
	}



	/** @test */
	public function a_nullable_integer_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'NullableIntegerType' as it does not possess the same parent type.");

		// Execute the tests
		NullableIntegerType::from(new stdClass());
	}



	/** @test */
	public function a_nullable_integer_type_cannot_be_created_from_an_incompatible_string()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'String' cannot be converted to an object of type " .
										"'NullableIntegerType' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		NullableIntegerType::from("test");
	}



	/** @test */
	public function a_nullable_integer_type_converts_to_a_boolean()
	{
		// Execute the tests
		$this -> assertTrue(NullableIntegerType::make(10) -> toBoolean());
		$this -> assertTrue(NullableIntegerType::make(1) -> toBoolean());
		$this -> assertFalse(NullableIntegerType::make(0) -> toBoolean());
		$this -> assertFalse(NullableIntegerType::make(-1) -> toBoolean());
		$this -> assertFalse(NullableIntegerType::make(-5) -> toBoolean());
	}

}