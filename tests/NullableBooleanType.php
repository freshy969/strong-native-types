<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\NullableBooleanType;

// Nullable boolean type test
class NullableBooleanTypeTest extends TestCase
{

	/** @test */
	public function a_nullable_boolean_type_can_be_created_from_a_native_type()
	{
		// Execute the tests (string)
		$this -> assertEquals(true, NullableBooleanType::from("1") -> value());
		$this -> assertEquals(true, NullableBooleanType::from("true") -> value());

		// Execute the tests (integer)
		$this -> assertEquals(true, NullableBooleanType::from(1) -> value());

		// Execute the tests (float)
		$this -> assertEquals(true, NullableBooleanType::from(1.5) -> value());

		// Execute the tests (null)
		$this -> assertEquals(null, NullableBooleanType::from(null) -> value());

		// Execute the tests (boolean)
		$this -> assertEquals(true, NullableBooleanType::from(true) -> value());
		$this -> assertEquals(false, NullableBooleanType::from(false) -> value());
	}



	/** @test */
	public function a_nullable_boolean_type_can_be_created_from_a_strong_type()
	{
		// Execute the tests
		$this -> assertEquals(true, NullableBooleanType::from(NullableBooleanType::from("1")) -> value());
	}



	/** @test */
	public function a_nullable_boolean_type_cannot_be_created_from_an_unknown_object()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Object' cannot be converted to an object of type " .
										"'NullableBooleanType' as it does not possess the same parent type.");

		// Execute the tests
		NullableBooleanType::from(new stdClass());
	}



	/** @test */
	public function a_nullable_boolean_type_cannot_be_created_from_an_incompatible_string()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'String' cannot be converted to an object of type " .
										"'NullableBooleanType' when its data is not compatible e.g. converting the " .
										"string 'email' to an integer.");

		// Execute the tests
		NullableBooleanType::from("test");
	}



	/** @test */
	public function a_nullable_boolean_type_converts_to_a_integer()
	{
		// Execute the tests
		$this -> assertEquals("true", NullableBooleanType::make(true) -> toString());
		$this -> assertEquals("false", NullableBooleanType::make(false) -> toString());
	}

}