<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\StringType;

// Macro test
class MacroTest extends TestCase
{

	/** @test */
	public function a_string_type_can_be_augmented_with_a_macro()
	{
		// Add the macro
		StringType::macro("example", function($suffix) {
			return $this -> value() . " " . $suffix;
		});

		// Create the type
		$type = new StringType("Hello");

		// Execute the tests
		$this -> assertEquals("Hello World", $type -> example("World"));
	}

}