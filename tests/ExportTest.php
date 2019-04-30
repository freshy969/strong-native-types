<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\StringType;
use Alphametric\Strong\Types\NullableStringType;

// Export test
class ExportTest extends TestCase
{

	/** @test */
	public function a_string_type_can_be_converted_to_a_native_boolean()
	{
		// Create the type
		$type = new StringType("true");

		// Execute the tests
		$this -> assertTrue($type -> toBoolean());
	}



	/** @test */
	public function a_string_type_can_be_converted_to_a_native_integer()
	{
		// Create the type
		$type = new StringType("0");

		// Execute the tests
		$this -> assertEquals(0, $type -> toInteger());
	}



	/** @test */
	public function a_string_type_can_be_converted_to_a_native_float()
	{
		// Create the type
		$type = new StringType("0.0");

		// Execute the tests
		$this -> assertEquals(0.0, $type -> toFloat());
	}



	/** @test */
	public function a_string_type_can_be_converted_to_a_native_string()
	{
		// Create the type
		$type = new StringType("test");

		// Execute the tests
		$this -> assertEquals("test", $type -> toString());
	}



	/** @test */
	public function a_string_type_can_be_converted_to_a_native_string_using_the_magic_method()
	{
		// Create the type
		$type = new StringType("test");

		// Execute the tests
		$this -> assertEquals("test", $type -> __toString());
	}



	/** @test */
	public function a_nullable_string_type_can_be_converted_to_a_native_boolean()
	{
		// Create the type
		$type = new NullableStringType(null);

		// Execute the tests
		$this -> assertTrue($type -> toBoolean(true));
	}



	/** @test */
	public function a_nullable_string_type_can_be_converted_to_a_native_integer()
	{
		// Create the type
		$type = new NullableStringType(null);

		// Execute the tests
		$this -> assertEquals(5, $type -> toInteger(5));
	}



	/** @test */
	public function a_nullable_string_type_can_be_converted_to_a_native_float()
	{
		// Create the type
		$type = new NullableStringType(null);

		// Execute the tests
		$this -> assertEquals(5.0, $type -> toFloat(5.0));
	}



	/** @test */
	public function a_nullable_string_type_can_be_converted_to_a_native_string()
	{
		// Create the type
		$type = new NullableStringType(null);

		// Execute the tests
		$this -> assertEquals("test", $type -> toString("test"));
	}

}