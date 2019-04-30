<?php

// Namespace
namespace Alphametric\Strong\Tests;

// Using directives
use Exception;
use PHPUnit\Framework\TestCase;
use Alphametric\Strong\Types\StringType;
use Alphametric\Strong\Types\NullableStringType;

// String utilities test
class StringUtilitiesTest extends TestCase
{

	/** @test */
	public function a_string_can_be_stripped_to_after()
	{
		// Execute the tests
		$this -> assertEquals("World", StringType::make("HelloWorld") -> after("Hello") -> value());
	}



	/** @test */
	public function a_string_can_be_appended()
	{
		// Execute the tests
		$this -> assertEquals("HelloWorld", StringType::make("Hello") -> append("World") -> value());
	}



	/** @test */
	public function a_string_can_be_stripped_to_before()
	{
		// Execute the tests
		$this -> assertEquals("Hello", StringType::make("HelloWorld") -> before("World") -> value());
	}



	/** @test */
	public function a_string_can_be_searched()
	{
		// Execute the tests
		$this -> assertTrue(StringType::make("HelloWorld") -> contains("World"));
		$this -> assertFalse(StringType::make("HelloWorld") -> contains("Universe"));
	}



	/** @test */
	public function a_string_can_be_set_to_camel_case()
	{
		// Execute the tests
		$this -> assertEquals("helloWorld", StringType::make("Hello World") -> camelCase() -> value());
	}



	/** @test */
	public function a_string_can_be_capitalized()
	{
		// Execute the tests
		$this -> assertEquals("Hello World", StringType::make("hello world") -> capitalize() -> value());
	}



	/** @test */
	public function a_string_can_be_capitalized_first_letter()
	{
		// Execute the tests
		$this -> assertEquals("Hello world", StringType::make("hello world") -> capitalizeFirstLetter() -> value());
	}



	/** @test */
	public function a_string_can_be_checked_to_see_if_it_ends_with_a_string()
	{
		// Execute the tests
		$this -> assertTrue(StringType::make("HelloWorld") -> endsWith("World"));
		$this -> assertFalse(StringType::make("HelloWorld") -> endsWith("Universe"));
	}



	/** @test */
	public function a_string_can_be_exploded()
	{
		// Execute the tests
		$this -> assertEquals(["A", "B", "C"], StringType::make("A|B|C") -> explode("|"));
	}



	/** @test */
	public function a_string_can_be_searched_with_find_index()
	{
		// Execute the tests
		$this -> assertEquals(0, StringType::make("Hello") -> findIndex("H"));
		$this -> assertEquals(5, StringType::make("HelloH") -> findIndex("H", 1));
	}



	/** @test */
	public function a_string_can_be_searched_with_find_last_index()
	{
		// Execute the tests
		$this -> assertEquals(5, StringType::make("HelloH") -> findLastIndex("H"));
	}



	/** @test */
	public function a_string_can_be_imploded()
	{
		// Execute the tests
		$this -> assertEquals("A|B|C", StringType::make("") -> implode("|", ["A", "B", "C"]) -> value());
	}



	/** @test */
	public function a_string_can_have_another_string_inserted_into_it()
	{
		// Execute the tests
		$this -> assertEquals("ABCDEF", StringType::make("ABC") -> insert("DEF", 3) -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_kebab_case()
	{
		// Execute the tests
		$this -> assertEquals("hello-world", StringType::make("Hello World") -> kebabCase() -> value());
	}



	/** @test */
	public function a_string_can_get_its_length()
	{
		// Execute the tests
		$this -> assertEquals(5, StringType::make("Hello") -> length());
	}



	/** @test */
	public function a_string_can_be_limited_to_a_given_length()
	{
		// Execute the tests
		$this -> assertEquals("Hel...", StringType::make("HelloWorld") -> limit(3) -> value());
		$this -> assertEquals("Hel|", StringType::make("HelloWorld") -> limit(3, "|") -> value());
		$this -> assertEquals("HelloWorld", StringType::make("HelloWorld") -> limit(20) -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_lower_case()
	{
		// Execute the tests
		$this -> assertEquals("hello world", StringType::make("Hello World") -> lowerCase());
	}



	/** @test */
	public function a_string_can_be_set_to_lower_case_first_letter()
	{
		// Execute the tests
		$this -> assertEquals("hello World", StringType::make("Hello World") -> lowerCaseFirstLetter());
	}



	/** @test */
	public function a_string_can_be_checked_if_it_matches_a_given_pattern()
	{
		// Execute the tests
		$this -> assertTrue(StringType::make("Hello World") -> matches("/Hello\sWorld/"));
	}



	/** @test */
	public function a_string_can_be_prepended()
	{
		// Execute the tests
		$this -> assertEquals("HelloWorld", StringType::make("World") -> prepend("Hello") -> value());
	}



	/** @test */
	public function a_string_can_be_generated_using_random()
	{
		// Execute the tests
		$this -> assertEquals(5, StringType::make("") -> random(5) -> length());
	}



	/** @test */
	public function a_string_can_be_replaced()
	{
		// Execute the tests
		$this -> assertEquals(
			"Hello Universe, This Is My Universe",
			StringType::make("Hello World, This Is My World") -> replace("World", "Universe") -> value()
		);
	}



	/** @test */
	public function a_string_can_have_its_first_instance_replaced()
	{
		// Execute the tests
		$this -> assertEquals(
			"Hello Universe, This Is My World",
			StringType::make("Hello World, This Is My World") -> replaceFirst("World", "Universe") -> value()
		);
	}



	/** @test */
	public function a_string_can_have_its_last_instance_replaced()
	{
		// Execute the tests
		$this -> assertEquals(
			"Hello World, This Is My Universe",
			StringType::make("Hello World, This Is My World") -> replaceLast("World", "Universe") -> value()
		);
	}




	/** @test */
	public function a_string_can_be_replaced_using_regex()
	{
		// Execute the tests
		$this -> assertEquals(
			"Hello Universe, This Is My Universe",
			StringType::make("Hello World, This Is My World") -> replaceUsingExpression("/World/", "Universe") -> value()
		);
	}



	/** @test */
	public function a_string_can_be_set_to_safe_html()
	{
		// Execute the tests
		$this -> assertEquals("Hello&lt;br /&gt;World", StringType::make("Hello<br />World") -> safeHtml() -> value());
		$this -> assertEquals("Hello&lt;br /&gt;World", StringType::make("Hello<br />World") -> safeHtml(true) -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_snake_case()
	{
		// Execute the tests
		$this -> assertEquals("hello_world", StringType::make("Hello World") -> snakeCase() -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_stud_case()
	{
		// Execute the tests
		$this -> assertEquals("HelloWorld", StringType::make("hello_world") -> studCase() -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_a_substring()
	{
		// Execute the tests
		$this -> assertEquals("hello", StringType::make("hello_world") -> substring(0, 5) -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_title_case()
	{
		// Execute the tests
		$this -> assertEquals("Hello_World", StringType::make("hello_world") -> titleCase() -> value());
	}



	/** @test */
	public function a_string_can_be_trimmed()
	{
		// Execute the tests
		$this -> assertEquals("hello_world", StringType::make("...hello_world...") -> trim(".") -> value());
	}



	/** @test */
	public function a_string_can_be_trimmed_left()
	{
		// Execute the tests
		$this -> assertEquals("hello_world...", StringType::make("...hello_world...") -> trimLeft(".") -> value());
	}



	/** @test */
	public function a_string_can_be_trimmed_right()
	{
		// Execute the tests
		$this -> assertEquals("...hello_world", StringType::make("...hello_world...") -> trimRight(".") -> value());
	}



	/** @test */
	public function a_string_can_be_set_to_upper_case()
	{
		// Execute the tests
		$this -> assertEquals("HELLO WORLD", StringType::make("hello world") -> upperCase() -> value());
	}

}