<?php declare(strict_types = 1);

// Using directives
use Alphametric\Strong\Types\FloatType;
use Alphametric\Strong\Types\StringType;
use Alphametric\Strong\Types\BooleanType;
use Alphametric\Strong\Types\IntegerType;
use Alphametric\Strong\Types\NullableFloatType;
use Alphametric\Strong\Types\NullableStringType;
use Alphametric\Strong\Types\NullableBooleanType;
use Alphametric\Strong\Types\NullableIntegerType;



/**
 * Create a new Boolean type.
 *
 * @param mixed $object.
 * @param bool $nullable.
 * @return Boolean.
 *
 **/
function boolean($object, bool $nullable = false)
{
	// Attempt to construct the type directly, then fall back to conversion
	try {
		return $nullable ? NullableBooleanType::make($object) : BooleanType::make($object);
	} catch (Exception $ex) {
		return $nullable ? NullableBooleanType::from($object) : BooleanType::from($object);
	}
}



/**
 * Create a new Float type.
 *
 * @param mixed $object.
 * @param bool $nullable.
 * @return Float.
 *
 **/
function float($object, bool $nullable = false)
{
	// Attempt to construct the type directly, then fall back to conversion
	try {
		return $nullable ? NullableFloatType::make($object) : FloatType::make($object);
	} catch (Exception $ex) {
		return $nullable ? NullableFloatType::from($object) : FloatType::from($object);
	}
}



/**
 * Create a new Integer type.
 *
 * @param mixed $object.
 * @param bool $nullable.
 * @return Integer.
 *
 **/
function integer($object, bool $nullable = false)
{
	// Attempt to construct the type directly, then fall back to conversion
	try {
		return $nullable ? NullableIntegerType::make($object) : IntegerType::make($object);
	} catch (Exception $ex) {
		return $nullable ? NullableIntegerType::from($object) : IntegerType::from($object);
	}
}



/**
 * Create a new String type.
 *
 * @param mixed $object.
 * @param bool $nullable.
 * @return Text.
 *
 **/
function string($object, bool $nullable = false)
{
	// Attempt to construct the type directly, then fall back to conversion
	try {
		return $nullable ? NullableStringType::make($object) : StringType::make($object);
	} catch (Exception $ex) {
		return $nullable ? NullableStringType::from($object) : StringType::from($object);
	}
}