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
	 * @return mixed.
	 *
	 **/
	public function after($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		if ($object !== "") {
			return new static(array_reverse(explode($object, $this -> container, 2))[0]);
		}

		// Create a new instance and set its value
		return new static($this -> container);
	}



	/**
	 * Insert the given string at the end of the data container.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	public function append($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static($this -> container . $object);
	}



	/**
	 * Strip characters after the given search string.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	public function before($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		if ($object !== "") {
			return new static(explode($object, $this -> container)[0]);
		}

		// Create a new instance and set its value
		return new static($this -> container);
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
	 * @return mixed.
	 *
	 **/
	public function camelCase()
	{
		// Create a new instance and set its value
		return new static(lcfirst($this -> studCase() -> value()));
	}



	/**
	 * Capitalize each word in the data container.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function capitalize()
	{
		// Create a new instance and set its value
		return new static(ucwords($this -> container));
	}



	/**
	 * Capitalize the first letter in the data container.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function capitalizeFirstLetter()
	{
		// Create a new instance and set its value
		return new static(ucfirst($this -> container));
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
	 * @return mixed.
	 *
	 **/
	public function implode($delimiter, array $object)
	{
		// Validate the data
		$delimiter = $this -> validate($delimiter);

		// Create a new instance and set its value
		return new static(implode($delimiter, $object));
	}



	/**
	 * Insert the given string at the given index within the data container.
	 *
	 * @param mixed $object.
	 * @param int $index.
	 * @return mixed.
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

		// Create a new instance and set its value
		return new static(substr_replace($this -> container, $object, $index, 0));
	}



	/**
	 * Convert the data container to kebab case format.
	 *
	 * @param none.
	 * @return mixed.
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
	 * @return mixed.
	 *
	 **/
	public function limit(int $count, $ellipsis = "...")
	{
		// Validate the data
		$ellipsis = $this -> validate($ellipsis);

		// Create a new instance and set its value
        if (mb_strwidth($this -> container, "UTF-8") > $count) {
			return new static(rtrim(mb_strimwidth($this -> container, 0, $count, "", "UTF-8")) . $ellipsis);
        }

		// Create a new instance and set its value
		return new static($this -> container);
	}



	/**
	 * Convert the data container to lower case format.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function lowerCase()
	{
		// Create a new instance and set its value
		return new static(mb_strtolower($this -> container, "UTF-8"));
	}



	/**
	 * Convert the first letter in the data container to lower case.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function lowerCaseFirstLetter()
	{
		// Create a new instance and set its value
		return new static(lcfirst($this -> container));
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
	 * @return mixed.
	 *
	 **/
	public function prepend($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static($object . $this -> container);
	}



	/**
	 * Set the data container to a cryptographically secure
	 * random string of the given length.
	 *
	 * @param int $length.
	 * @return mixed.
	 *
	 **/
	public function random(int $length)
	{
		// Create a temporary variable
        $container = "";

		// Update the value
        while (($len = mb_strlen($container, "UTF-8")) < $length) {
            $container .= substr(str_replace(
				["/", "+", "="], "", base64_encode(random_bytes($length - $len))
			), 0, $length - $len);
        }

		// Create a new instance and set its value
		return new static($container);
	}



	/**
	 * Replace all instances of a given string / array with another.
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @return mixed.
	 *
	 **/
	public function replace($find, $replace)
	{
		// Create a new instance and set its value
		return new static(str_replace($find, $replace, $this -> container));
	}



	/**
	 * Replace the first instance of a given string with another.
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @return mixed.
	 *
	 **/
	public function replaceFirst($find, $replace)
	{
		// Validate the data
		$find    = $this -> validate($find);
		$replace = $this -> validate($replace);

		// Create a new instance and set its value
        if (strpos($this -> container, $find) !== false) {
			return new static(substr_replace(
				$this -> container, $replace, strpos($this -> container, $find), mb_strlen($find, "UTF-8")
			));
        }

		// Create a new instance and set its value
		return new static($this -> container);
	}



	/**
	 * Replace the last instance of a given string with another.
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @return mixed.
	 *
	 **/
	public function replaceLast($find, $replace)
	{
		// Validate the data
		$find    = $this -> validate($find);
		$replace = $this -> validate($replace);

		// Create a new instance and set its value
        if (strrpos($this -> container, $find) !== false) {
			return new static(substr_replace(
				$this -> container, $replace, strrpos($this -> container, $find), mb_strlen($find, "UTF-8")
			));
        }

		// Create a new instance and set its value
		return new static($this -> container);
	}



	/**
	 * Replace all instances of a given string / array pattern(s).
	 *
	 * @param mixed $find.
	 * @param mixed $replace.
	 * @param int $limit.
	 * @param int $count.
	 * @return mixed.
	 *
	 **/
	public function replaceUsingExpression($find, $replace, int $limit = -1, int &$count = null)
	{
		// Create a new instance and set its value
		return new static(preg_replace($find, $replace, $this -> container, $limit, $count));
	}



	/**
	 * Convert any special characters in the data container to
	 * HTML entities, optionally double encoded.
	 *
	 * @param bool $double_encode.
	 * @return mixed.
	 *
	 **/
	public function safeHtml(bool $double_encode = true)
	{
		// Create a new instance and set its value
		return new static(htmlspecialchars($this -> container, ENT_QUOTES, "UTF-8", $double_encode));
	}



	/**
	 * Convert the data container to snake case format.
	 *
	 * @param mixed $delimiter.
	 * @return mixed.
	 *
	 **/
	public function snakeCase($delimiter = "_")
	{
		// Validate the data
		$delimiter = $this -> validate($delimiter);

		// Remove any extraneous whitespace
		$container = preg_replace("/\s+/u", "", ucwords($this -> container));

		// Replace any remaining whitespace with the delimiter
		$container = preg_replace("/(.)(?=[A-Z])/u", "$1$delimiter", $container);

		// Create a new instance and set its value
		return new static(mb_strtolower($container, "UTF-8"));
	}



	/**
	 * Convert the data container to stud case format.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function studCase()
	{
		// Create a new instance and set its value
		return new static(str_replace(" ", "", ucwords(str_replace(["-", "_"], " ", $this -> container))));
	}



	/**
	 * Set the data container to a portion of its current content.
	 *
	 * @param int $start.
	 * @param int $length.
	 * @return mixed.
	 *
	 **/
	public function substring(int $start, int $length = null)
	{
		// Create a new instance and set its value
		return new static(mb_substr($this -> container, $start, $length, "UTF-8"));
	}



	/**
	 * Convert the data container to camel case format.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function titleCase()
	{
		// Create a new instance and set its value
		return new static(mb_convert_case($this -> container, MB_CASE_TITLE, "UTF-8"));
	}



	/**
	 * Remove the given content from the beginning and end of the data container.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	public function trim($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static(trim($this -> container, $object));
	}



	/**
	 * Remove the given object from the beginning of the data container.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	public function trimLeft($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static(ltrim($this -> container, $object));
	}



	/**
	 * Remove the given object from the end of the data container.
	 *
	 * @param mixed $object.
	 * @return mixed.
	 *
	 **/
	public function trimRight($object)
	{
		// Validate the data
		$object = $this -> validate($object);

		// Create a new instance and set its value
		return new static(rtrim($this -> container, $object));
	}



	/**
	 * Convert the data container to upper case format.
	 *
	 * @param none.
	 * @return mixed.
	 *
	 **/
	public function upperCase()
	{
		// Create a new instance and set its value
		return new static(mb_strtoupper($this -> container, "UTF-8"));
	}

}