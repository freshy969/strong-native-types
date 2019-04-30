<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\IntegerType;
use Alphametric\Strong\Types\NullableIntegerType;

// Utilities test
class UtilitiesTest extends TestCase
{

	/** @test */
	public function a_type_can_set_its_value()
	{
		// Execute the tests
		$this -> assertEquals(3, IntegerType::make(5) -> set(3) -> value());
	}



	/** @test */
	public function a_type_can_set_its_value_to_null_when_it_is_nullable()
	{
		// Execute the tests
		$this -> assertEquals(null, NullableIntegerType::make(5) -> set(null) -> value());
	}



	/** @test */
	public function a_type_cannot_set_its_value_to_null_when_it_is_non_nullable()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An object of type 'Null' cannot be assigned to an object of type 'IntegerType'.");

		// Execute the tests
		IntegerType::make(5) -> set(null);
	}

}