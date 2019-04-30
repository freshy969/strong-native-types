<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\BooleanType;
use Alphametric\Strong\Types\NullableBooleanType;

// Boolean utilities test
class BooleanUtilitiesTest extends TestCase
{

	/** @test */
	public function an_boolean_can_be_set_to_false()
	{
		// Execute the tests
		$this -> assertFalse(BooleanType::make(true) -> false() -> value());
		$this -> assertFalse(BooleanType::make(false) -> false() -> value());
	}



	/** @test */
	public function an_boolean_can_be_set_to_true()
	{
		// Execute the tests
		$this -> assertTrue(BooleanType::make(true) -> true() -> value());
		$this -> assertTrue(BooleanType::make(false) -> true() -> value());
	}



	/** @test */
	public function an_boolean_can_reveal_if_it_is_false()
	{
		// Execute the tests
		$this -> assertTrue(BooleanType::make(false) -> isFalse());
		$this -> assertFalse(BooleanType::make(true) -> isFalse());
	}



	/** @test */
	public function an_boolean_can_reveal_if_it_is_true()
	{
		// Execute the tests
		$this -> assertTrue(BooleanType::make(true) -> isTrue());
		$this -> assertFalse(BooleanType::make(false) -> isTrue());
	}

}