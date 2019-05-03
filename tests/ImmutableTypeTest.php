<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\StringType;

// Immutable type test
class ImmutableTypeTest extends TestCase
{

	/** @test */
	public function an_immutable_type_creates_a_clone_when_modifying_its_value()
	{
		// Prepare the variables
		$x = StringType::from("hello");
		$y = $x -> append("world");

		// Execute the tests
		$this -> assertEquals("hello", $x -> value());
		$this -> assertEquals("helloworld", $y -> value());
	}

}