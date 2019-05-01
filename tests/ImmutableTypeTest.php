<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\BooleanType;

// Immutable type test
class ImmutableTypeTest extends TestCase
{

	/** @test */
	public function an_immutable_type_cannot_have_its_underlying_valur_changed()
	{
		// Set the expected exception
		$this -> expectException(Exception::class);
		$this -> expectExceptionMessage("An immutable object type cannot have its data changed. If necessary, " .
										"cast the type to its mutable variety first");

		// Execute the tests
		BooleanType::make(true) -> toImmutable() -> false();
	}

}