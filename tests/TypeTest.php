<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use stdClass;
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\StringType;
use Alphametric\Strong\Types\NullableStringType;

// Type test
class TypeTest extends TestCase
{

	/** @test */
	public function a_type_can_be_created_from_a_native_type()
	{
		// Create the type
		$type = new StringType("test");

		// Execute the tests
		$this -> assertEquals("test", $type -> value());
	}



	/** @test */
	public function a_type_can_be_created_from_an_existing_type()
	{
		// Create the types
		$old = new StringType("test");
		$new = new StringType($old);

		// Execute the tests
		$this -> assertEquals("test", $new -> value());
	}



	/** @test */
	public function a_type_can_be_compared_to_another_object_to_see_if_it_is_the_same_type()
	{
		// Create the type
		$type = new StringType("test");

		// Execute the tests
		$this -> assertTrue($type -> isStrongTypeMatch(new StringType("hello")));
		$this -> assertFalse($type -> isStrongTypeMatch(new stdClass()));
	}



	/** @test */
	public function a_type_can_retrieve_its_value()
	{
		// Create the type
		$type = new StringType("test");

		// Execute the tests
		$this -> assertEquals("test", $type -> value());
	}



	/** @test */
	public function a_type_can_retrieve_its_type()
	{
		// Create the type
		$type = new StringType("test");

		// Execute the tests
		$this -> assertEquals("StringType", $type -> type());
	}



	/** @test */
	public function a_non_nullable_type_can_be_converted_to_a_nullable_type()
	{
		// Create the type
		$type = StringType::make("test");

		// Execute the tests
		$this -> assertEquals(NullableStringType::class, get_class($type -> toNullable()));
	}



	/** @test */
	public function a_nullable_type_can_be_converted_to_a_non_nullable_type()
	{
		// Create the type
		$type = NullableStringType::make("test");

		// Execute the tests
		$this -> assertEquals(StringType::class, get_class($type -> toNonNullable()));
	}



	/** @test */
	public function a_nullable_type_with_a_null_value_cannot_be_converted_to_a_non_nullable_type()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("A nullable object with a value of 'Null' cannot be cast to a non-nullable type");

		// Execute the tests
		NullableStringType::make(null) -> toNonNullable();
	}

}