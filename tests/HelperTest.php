<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\FloatType;
use Alphametric\Strong\Types\StringType;
use Alphametric\Strong\Types\BooleanType;
use Alphametric\Strong\Types\IntegerType;
use Alphametric\Strong\Types\NullableFloatType;
use Alphametric\Strong\Types\NullableStringType;
use Alphametric\Strong\Types\NullableBooleanType;
use Alphametric\Strong\Types\NullableIntegerType;

// Helper test
class HelperTest extends TestCase
{

	/** @test */
	public function a_type_can_be_made_via_a_helper()
	{
		// Execute the tests (string)
		$this -> assertEquals("test", string("test", $null = true) -> value());
		$this -> assertEquals(get_class(string("test", $null = false)), StringType::class);
		$this -> assertEquals(get_class(string("test", $null = true)), NullableStringType::class);

		// Execute the tests (boolean)
		$this -> assertEquals(true, boolean(true, $null = true) -> value());
		$this -> assertEquals(get_class(boolean(true, $null = false)), BooleanType::class);
		$this -> assertEquals(get_class(boolean(true, $null = true)), NullableBooleanType::class);

		// Execute the tests (integer)
		$this -> assertEquals(1, integer(1, $null = true) -> value());
		$this -> assertEquals(get_class(integer(1, $null = false)), IntegerType::class);
		$this -> assertEquals(get_class(integer(1, $null = true)), NullableIntegerType::class);

		// Execute the tests (decimal)
		$this -> assertEquals(1.3, float(1.3, $null = true) -> value());
		$this -> assertEquals(get_class(float(1.3, $null = false)), FloatType::class);
		$this -> assertEquals(get_class(float(1.3, $null = true)), NullableFloatType::class);
	}



	/** @test */
	public function a_type_can_be_converted_from_another_type_via_a_helper()
	{
		// Execute the tests (string)
		$this -> assertEquals("test", string("test", $null = true) -> value());
		$this -> assertEquals(get_class(string("test", $null = false)), StringType::class);
		$this -> assertEquals(get_class(string("test", $null = true)), NullableStringType::class);

		// Execute the tests (boolean)
		$this -> assertEquals(true, boolean(1, $null = true) -> value());
		$this -> assertEquals(get_class(boolean(true, $null = false)), BooleanType::class);
		$this -> assertEquals(get_class(boolean(true, $null = true)), NullableBooleanType::class);

		// Execute the tests (integer)
		$this -> assertEquals(2, integer(1.5, $null = true) -> value());
		$this -> assertEquals(get_class(integer(1, $null = false)), IntegerType::class);
		$this -> assertEquals(get_class(integer(1, $null = true)), NullableIntegerType::class);

		// Execute the tests (decimal)
		$this -> assertEquals(1.3, float(1.3, $null = true) -> value());
		$this -> assertEquals(get_class(float(1.3, $null = false)), FloatType::class);
		$this -> assertEquals(get_class(float(1.3, $null = true)), NullableFloatType::class);
	}

}