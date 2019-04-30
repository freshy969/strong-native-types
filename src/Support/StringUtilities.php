<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Support;

// Using directives
use Exception;

// String utilities trait
trait StringUtilities
{

	/**
	 * Class traits.
	 *
	 **/
	use Utilities;



	/**
	 * Strip characters before the given search string.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function after($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		if ($object !== "") {
			$this -> container = array_reverse(explode($object, $this -> container, 2))[0];
		}

		// Allow method chaining
		return $this;
	}



	/**
	 * Insert the given string at the end of the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function append($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		$this -> container .= $object;

		// Allow method chaining
		return $this;
	}



	/**
	 * Strip characters after the given search string.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function before($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		if ($object !== "") {
			$this -> container = explode($object, $this -> container)[0];
		}

		// Allow method chaining
		return $this;
	}



	/**
	 * Determine if the data container consists of one or more needles.
	 *
	 * @param mixed $needles.
	 * @return bool.
	 *
	 **/
	public function contains($needles)
	{
		// Iterate through the needles
        foreach ((array) $needles as $needle) {

			// Validate the data
			$needle = $this -> validate($needle);

			// Search the container
            if ($needle !== "" && mb_strpos($this -> container, $needle) !== false) {
                return true;
            }

        }

		// The needle(s) do not exist
        return false;
	}



	/**
	 * Convert the data container to camel case format.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function camelCase()
	{
		// Update the value
		$this -> container = lcfirst($this -> studCase() -> value());

		// Allow method chaining
		return $this;
	}



	/**
	 * Capitalize each word in the data container.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function capitalize()
	{
		// Update the value
		$this -> container = ucwords($this -> container);

		// Allow method chaining
		return $this;
	}



	/**
	 * Capitalize the first letter in the data container.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function capitalizeFirstLetter()
	{
		// Update the value
		$this -> container = ucfirst($this -> container);

		// Allow method chaining
		return $this;
	}



	/**
	 * Determine if the data container ends with one or more needles.
	 *
	 * @param mixed $needles.
	 * @return bool.
	 *
	 **/
	public function endsWith($needles)
	{
		// Iterate through the needles
        foreach ((array) $needles as $needle) {

			// Validate the data
			$needle = $this -> validate($needle);

			// Search the container
            if (substr($this -> container, -mb_strlen($needle, "UTF-8")) === (string) $needle) {
                return true;
            }

        }

		// The needle(s) do not exist
        return false;
	}



	/**
	 * Split the string into an array using the given delimiter.
	 *
	 * @param mixed $delimiter.
	 * @return array.
	 *
	 **/
	public function explode($delimiter)
	{
		// Validate the data
		$delimiter = $this -> validate($delimiter);

		// Return the converted array
        return explode($delimiter, $this -> container);
	}



	/**
	 * Retrieve the first index of a given string in the data container,
	 * starting from a given offset.
	 *
	 * @param mixed $object.
	 * @param int $offset.
	 * @return int.
	 *
	 **/
	public function findIndex($object, int $offset = 0)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Return the position
		return mb_strpos($this -> container, $object, $offset, "UTF-8");
	}



	/**
	 * Retrieve the first index of a given string in the data container,
	 * starting from a given offset.
	 *
	 * @param mixed $object.
	 * @param int $offset.
	 * @return int.
	 *
	 **/
	public function findLastIndex($object, int $offset = 0)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Return the position
		return mb_strrpos($this -> container, $object, $offset, "UTF-8");
	}



	/**
	 * Join the elements of the given array using the given delimiter.
	 *
	 * @param mixed $delimiter.
	 * @param array $object.
	 * @return $this.
	 *
	 **/
	public function implode($delimiter, array $object)
	{
		// Validate the data
		$delimiter = $this -> validate($delimiter);

		// Update the data container
        $this -> container = implode($delimiter, $object);

		// Allow method chaining
		return $this;
	}



	/**
	 * Insert the given string at the given index within the data container.
	 *
	 * @param mixed $object.
	 * @param int $index.
	 * @return $this.
	 *
	 **/
	public function insert($object, int $index)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Check if the index exceeds the maximum
		if ($index > mb_strlen($this -> container, "UTF-8")) {
			return $this -> append($object);
		}

		// Update the value
		$this -> container = substr_replace($this -> container, $object, $index, 0);

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert the data container to kebab case format.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function kebabCase()
	{
		// Defer to the main method
		return $this -> snakeCase("-");
	}



	/**
	 * Retrieve the number of characters in the data container.
	 *
	 * @param none.
	 * @return int.
	 *
	 **/
	public function length()
	{
		// Return the value
		return mb_strlen($this -> container, "UTF-8");
	}



	/**
	 * Restrict the number of characters in the data container.
	 *
	 * @param int $count.
	 * @param mixed $ellipsis.
	 * @return int.
	 *
	 **/
	public function limit(int $count, $ellipsis = "...")
	{
		// Validate the data
		$ellipsis = $this -> validate($ellipsis);

		// Update the value
        if (mb_strwidth($this -> container, "UTF-8") > $count) {
            $this -> container = rtrim(mb_strimwidth($this -> container, 0, $count, "", "UTF-8")) . $ellipsis;
        }

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert the data container to lower case format.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function lowerCase()
	{
		// Update the value
		$this -> container = mb_strtolower($this -> container, "UTF-8");

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert the first letter in the data container to lower case.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function lowerCaseFirstLetter()
	{
		// Update the value
		$this -> container = lcfirst($this -> container);

		// Allow method chaining
		return $this;
	}



	/**
	 * Determine if the data container matches a given regular expression(s).
	 *
	 * @param mixed $pattern.
	 * @return bool.
	 *
	 **/
	public function matches($pattern)
	{
		// Validate the data
		$pattern = $this -> validate($pattern);

		// Convert pattern(s) to an array
        $patterns = ! is_array($pattern) ? [$pattern] : $pattern;

		// Iterate through the patterns
        foreach ($patterns as $pattern) {
            if ($pattern == $this -> container || preg_match($pattern, $this -> container) === 1) {
                return true;
            }
        }

		// The patterns do not match
        return false;
	}



	/**
	 * Insert the given string at the beginning of the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function prepend($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		$this -> container = $object . $this -> container;

		// Allow method chaining
		return $this;
	}



	/**
	 * Set the data container to a cryptographically secure
	 * random string of the given length.
	 *
	 * @param int $length.
	 * @return $this.
	 *
	 **/
	public function random(int $length)
	{
		// Clear the data container
        $this -> container = "";

		// Update the value
        while (($len = mb_strlen($this -> container, "UTF-8")) < $length) {
            $this -> container .= substr(str_replace(
				["/", "+", "="], "", base64_encode(random_bytes($length - $len))
			), 0, $length - $len);
        }

		// Allow method chaining
		return $this;
	}



	/**
	 * Replace all instances of a given string / array with another.
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @return $this.
	 *
	 **/
	public function replace($find, $replace)
	{
		// Update the value
        $this -> container = str_replace($find, $replace, $this -> container);

		// Allow method chaining
		return $this;
	}



	/**
	 * Replace the first instance of a given string with another.
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @return $this.
	 *
	 **/
	public function replaceFirst($find, $replace)
	{
		// Validate the data
		$find    = $this -> validate($find);
		$replace = $this -> validate($replace);

		// Update the value
        if (strpos($this -> container, $find) !== false) {
            $this -> container = substr_replace(
				$this -> container, $replace, strpos($this -> container, $find), mb_strlen($find, "UTF-8")
			);
        }

		// Allow method chaining
		return $this;
	}



	/**
	 * Replace the last instance of a given string with another.
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @return $this.
	 *
	 **/
	public function replaceLast($find, $replace)
	{
		// Validate the data
		$find    = $this -> validate($find);
		$replace = $this -> validate($replace);

		// Update the value
        if (strrpos($this -> container, $find) !== false) {
            $this -> container = substr_replace(
				$this -> container, $replace, strrpos($this -> container, $find), mb_strlen($find, "UTF-8")
			);
        }

		// Allow method chaining
		return $this;
	}



	/**
	 * Replace all instances of a given string / array pattern(s).
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @param int $limit.
	 * @param int $count.
	 * @return $this.
	 *
	 **/
	public function replaceUsingExpression($find, $replace, int $limit = -1, int &$count = null)
	{
		// Update the value
        $this -> container = preg_replace($find, $replace, $this -> container, $limit, $count);

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert any special characters in the data container to
	 * HTML entities, optionally double encoded.
	 *
	 * @param bool $double_encode.
	 * @return $this.
	 *
	 **/
	public function safeHtml(bool $double_encode = true)
	{
		// Update the value
		$this -> container = htmlspecialchars($this -> container, ENT_QUOTES, "UTF-8", $double_encode);

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert the data container to snake case format.
	 *
	 * @param mixed $delimiter.
	 * @return $this.
	 *
	 **/
	public function snakeCase($delimiter = "_")
	{
		// Validate the data
		$delimiter = $this -> validate($delimiter);

		// Remove any extraneous whitespace
		$this -> container = preg_replace("/\s+/u", "", ucwords($this -> container));

		// Replace any remaining whitespace with the delimiter
		$this -> container = preg_replace("/(.)(?=[A-Z])/u", "$1$delimiter", $this -> container);

		// Convert the data container to lower case
		return $this -> lowerCase();
	}



	/**
	 * Convert the data container to stud case format.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function studCase()
	{
		// Update the value
        $this -> container = str_replace(
			" ", "", ucwords(str_replace(["-", "_"], " ", $this -> container))
		);

		// Allow method chaining
		return $this;
	}



	/**
	 * Set the data container to a portion of its current content.
	 *
	 * @param int $start.
	 * @param int $length.
	 * @return $this.
	 *
	 **/
	public function substring(int $start, int $length = null)
	{
		// Update the value
		$this -> container = mb_substr($this -> container, $start, $length, "UTF-8");

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert the data container to camel case format.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function titleCase()
	{
		// Update the value
		$this -> container = mb_convert_case($this -> container, MB_CASE_TITLE, "UTF-8");

		// Allow method chaining
		return $this;
	}



	/**
	 * Remove the given content from the beginning and end of the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function trim($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		$this -> container = trim($this -> container, $object);

		// Allow method chaining
		return $this;
	}



	/**
	 * Remove the given object from the beginning of the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function trimLeft($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		$this -> container = ltrim($this -> container, $object);

		// Allow method chaining
		return $this;
	}



	/**
	 * Remove the given object from the end of the data container.
	 *
	 * @param mixed $object.
	 * @return $this.
	 *
	 **/
	public function trimRight($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Update the value
		$this -> container = rtrim($this -> container, $object);

		// Allow method chaining
		return $this;
	}



	/**
	 * Convert the data container to upper case format.
	 *
	 * @param none.
	 * @return $this.
	 *
	 **/
	public function upperCase()
	{
		// Update the value
		$this -> container = mb_strtoupper($this -> container, "UTF-8");

		// Allow method chaining
		return $this;
	}

}