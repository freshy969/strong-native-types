# Strong Native PHP Types

This package provides a set of objects that wrap the native PHP data types (`string`, `float`, `int` and `bool`) into strongly-typed implementations. A nullable set of object wrappers also exists for each of the four data types, so you can directly enforce whether an object permits `null` or not.

## Background

PHP has been moving toward a strongly-typed ethos for some time. As of PHP 7.4, we now have strongly-typed class properties, method parameters and return types. However, the main item that is missing, is types within methods. That may come in a future version, however the underlying issue of type coercion is not addressed. For example, while you can enforce an `int` parameter in a method signature, there is nothing to stop you from changing it to a `string` within the method itself.

By switching to objects, PHP will prevent you from engaging in this sort of behaviour unless you specifically call the provided conversion methods on the objects. In my opinion, this is a step in the right direction (assuming you are an advocate of strong types / disallowing type coercion).

## Caveats

The main "problem" with his approach is performance. Since you are now working with objects instead of simple data types, PHP has to do a bit more work. In this respect, tasks will take slightly longer to complete. For most applications, the impact is negligible (milliseconds). However, for applications where performance is extremely important / every millisecond counts, using this package may not be preferable.

## Installation

Pull in the package using composer:

```bash
composer require alphametric/strong-native-types
```

## Creation

Begin by importing the classes for the four data types:

```php
use Alphametric\Strong\Types\FloatType;
use Alphametric\Strong\Types\StringType;
use Alphametric\Strong\Types\BooleanType;
use Alphametric\Strong\Types\IntegerType;
```

If you wish to allow `null` values, you'll need to import the nullable variety:

```php
use Alphametric\Strong\Types\NullableFloatType;
use Alphametric\Strong\Types\NullableStringType;
use Alphametric\Strong\Types\NullableBooleanType;
use Alphametric\Strong\Types\NullableIntegerType;
```

At this point, you can use them as you would any other object e.g. as a method parameter, class property, variable etc.

> NOTE: In a perfect world, the classes would not include the 'Type' suffix, however in PHP 7, `String` and `Float` became reserved words. As a result, a suffix had to be added to enable compilation.

To create an instance, use the `new` keyword, or the included `make` factory method:

```php
$string = new StringType('hello');
$string = StringType::make('hello');
```

Both of the above approaches will throw an exception if the supplied parameter is not of the correct type e.g.

```php
$int = new IntegerType('hello'); // throws exception
```

You may also pass an instance of the same object type. This is useful when using utility methods (e.g. adding an `IntegerType` to another):

```php
$int = new IntegerType(IntegerType::make(3));
```

If you supply an incompatible type, PHP will throw an exception:

```php
$int = new IntegerType(StringType::make('hello')); // throws exception
```

## Conversion

If you wish to convert a different data type e.g. a native PHP `float` into a `StringType`, you should use the `from` factory method:

```php
$string = StringType::from(1.5); // '1.5'
```

In instances where a sensible data conversion is not possible, an exception will be thrown e.g.

```php
$bool = BooleanType::from('hello'); // throws exception
```

> NOTE: You cannot "convert" a nullable type to a non-nullable type. For that, you'll need to cast the object. See 'casting' below.

## Quirks

The underlying conversion logic of the package also attempts to address some of the unique quirks of PHP's type coercion. For example, consider that in PHP, converting zero to a boolean results in `false`, while converting a negative number results in `true`.

A summary of "fixes" that the package enforces is shown below:

| Input Type 									   | Target Type   | Notes
| ------------------------------------------------ | ------------- | -----
| `String` or `StringType` or `NullableStringType` | `BooleanType` | Throws an exception if the `string` is not in (`'true'`, `'false'`, `'0'` or `'1'`). Is `true` when `'true'` or `'1'`. Is `false` when `'false'` or `'0'` |
| `String` or `StringType` or `NullableStringType` | `FloatType`   | Throws an exception if the `string` does not satisfy `is_numeric` |
| `String` or `StringType` or `NullableStringType` | `IntegerType` | Throws an exception if the `string` does not satisfy `is_numeric`. Calls `round` on the value (results in `'2.7'` becoming `3` instead of `2`) |
| `Float` or `FloatType` or `NullableFloatType`    | `IntegerType` | Calls `round` on the value (results in `2.7` becoming `3` instead of `2`) |
| `Float` or `FloatType` or `NullableFloatType`    | `BooleanType` | Is `true` when input is `>= 1`, otherwise is `false` |
| `Int` or `IntegerType` or `NullableIntegerType`  | `BooleanType` | Is `true` when input is `>= 1`, otherwise is `false` |

## Casting

If you wish to convert a nullable type to a non-nullable type, or vice-versa, call the corresponding casting methods:

```php
StringType::from('hello')->toNullable();            // NullableStringType
NullableStringType::from('hello')->toNonNullable(); // StringType
NullableStringType::from(null)->toNonNullable();    // Throws exception
```

## Immutability

All created types are `immutable`, allowing you to easily create new instances while not modifying the originals e.g.

```php
$x = StringType::from('hello');
$y = $x->append('world');

// $x = 'hello'
// $y = 'helloworld'
```

> **NOTE**: Prior to version 2 of the package, you could switch between mutability states, however after some further thinking, this feature has been removed in favor of only using `immutable` types.

## Extraction

At some point, you will likely want to retrieve the underlying value within the object. You can do this using the `value` method:

```php
StringType::from('hello')->value(); // 'hello'
```

Each of the types also implements PHP's magic `__toString` method, allowing you to skip using the `value` method in certain situations, or when using commands like `var_dump`. In these instances, `null` values will be returned as the string `'null'`, while other values will be passed through the `strval` method.

If you wish to retrieve the object's value as a different data type, you can use the `to` methods:

```php
StringType::from('1.5')->toString();  // '1.5'
StringType::from('1.5')->toInteger(); // 2
StringType::from('1.5')->toFloat();   // 1.5
StringType::from('1.5')->toBoolean(); // true
```

As with the conversion methods, the package attempts to address some of PHP's quirks when converting to native types:

| Type 									 | Method      | Notes
| -------------------------------------- | ----------- | -----
| `StringType` or `NullableStringType`   | `toBoolean` | Throws an exception if the `string` is not in (`'true'`, `'false'`, `'0'` or `'1'`). Is `true` when `'true'` or `'1'`. Is `false` when `'false'` or `'0'` |
| `StringType` or `NullableStringType`   | `toInteger` | Throws an exception if the `string` does not satisfy `is_numeric`. Calls `round` on the value (results in `'2.7'` becoming `3` instead of `2`) |
| `StringType` or `NullableStringType`   | `toFloat`   | Throws an exception if the `string` does not satisfy `is_numeric` |
| `FloatType` or `NullableFloatType`     | `toBoolean` | Is `true` when input is `>= 1`, otherwise is `false` |
| `FloatType` or `NullableFloatType`     | `toInteger` | Calls `round` on the value (results in `2.7` becoming `3` instead of `2`) |
| `IntegerType` or `NullableIntegerType` | `toBoolean` | Is `true` when input is `>= 1`, otherwise is `false` |
| `BooleanType` or `NullableBooleanType` | `toString`  | Returns `'true'` or `'false'` |

When working with nullable types, the object will automatically fall back to defaults when the value is `null`. These are pre-set to `''`, `0`, `0.0` or `false` for `string`, `int`, `float` and `bool` respectively, however you can change the default by supplying a value as a method parameter:

```php
NullableStringType::from(null)->toString();  	  // ''
NullableStringType::from(null)->toString('test'); // 'test'
NullableStringType::from(null)->toFloat(1.5);     // 1.5
NullableStringType::from(null)->toBoolean(true);  // true
NullableStringType::from(null)->toInteger(57);    // 57
```

> NOTE: If you override the default, the value must be of a matching type e.g. `1.5` for a `float`, otherwise an exception will be thrown.

## Helpers

The package includes some useful helper methods to create instances of the types. The helpers will attempt to create the types directly using the `make` factories. If that fails, they will attempt to perform a conversion using the `from` factories. If that also fails, an exception will be thrown.

```php
$object = string('test');                   // StringType
$object = string('test', $nullable = true); // NullableStringType
$object = float(1.4);                       // FloatType
$object = float(null, $nullable = true);    // NullableFloatType
$object = boolean(true);                    // BooleanType
$object = boolean(false, $nullable = true); // NullableBooleanType
$object = integer(5);                       // IntegerType
$object = integer(9, $nullable = true);     // NullableIntegerType
```

## Utility Methods

Since the data types are now objects, behaviour can be added to them. The package adds a wide selection of methods, many of which are chainable, allowing you to use a fluent API to modify the underlying data.

| Type                                                                         | Method                   | Notes |
| ---------------------------------------------------------------------------- | ------------------------ | ----- |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `add`                    | Add a value |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `subtract`               | Subtract a value |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `divideBy`               | Divide by a value |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `multiplyBy`             | Multiply by a value |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `remainderFrom`          | Divide by a value and get the remainder |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `modulusFrom`            | Alias of remainder |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `between`                | Check if number is between two others |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `greaterThan`            | Check if number is greater than another |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `greaterThenOrEqualTo`   | Check if number is greater than or equal to another |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `lessThan`               | Check if number is less than another |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `lessThanOrEqualTo`      | Check if number is less than or equal to another |
| `IntegerType` or `NullableIntegerType` or `FloatType` or `NullableFloatType` | `random`                 | Create a random number between a minimum and a maximum |
| `FloatType` or `NullableFloatType`                                           | `ceiling`                | Wrapper of `ceil` method |
| `FloatType` or `NullableFloatType`                                           | `floor`                  | Wrapper of `floor` method |
| `FloatType` or `NullableFloatType`                                           | `round`                  | Wrapper of `round` method |
| `FloatType` or `NullableFloatType`                                           | `roundUp`                | Wrapper of `round` method using `PHP_ROUND_HALF_UP` |
| `FloatType` or `NullableFloatType`                                           | `roundDown`              | Wrapper of `round` method using `PHP_ROUND_HALF_DOWN` |
| `FloatType` or `NullableFloatType`                                           | `roundEven`              | Wrapper of `round` method using `PHP_ROUND_HALF_EVEN` |
| `FloatType` or `NullableFloatType`                                           | `roundOdd`               | Wrapper of `round` method using `PHP_ROUND_HALF_ODD` |
| `BooleanType` or `NullableBooleanType`                                       | `isTrue`                 | Check if the boolean is true |
| `BooleanType` or `NullableBooleanType`                                       | `isFalse`                | Check if the boolean is false |
| `BooleanType` or `NullableBooleanType`                                       | `true`                   | Set the boolean to be true |
| `BooleanType` or `NullableBooleanType`                                       | `false`                  | Set the boolean to be false |
| `StringType` or `NullableStringType`                                         | `after`                  | Strip characters before the given value |
| `StringType` or `NullableStringType`                                         | `append`                 | Add characters to the string |
| `StringType` or `NullableStringType`                                         | `before`                 | Strip characters after the given value |
| `StringType` or `NullableStringType`                                         | `contains`               | Check if value exists in the string |
| `StringType` or `NullableStringType`                                         | `camelCase`              | Convert string to camel case |
| `StringType` or `NullableStringType`                                         | `capitalize`             | Wrapper of `ucwords` method |
| `StringType` or `NullableStringType`                                         | `capitalizeFirstLetter`  | Wrapper of `ucfirst` method |
| `StringType` or `NullableStringType`                                         | `endsWith`               | Check if string ends with a given value |
| `StringType` or `NullableStringType`                                         | `explode`                | Wrapper of `explode` method |
| `StringType` or `NullableStringType`                                         | `findIndex`              | Wrapper of `strpos` method |
| `StringType` or `NullableStringType`                                         | `findLastIndex`          | Wrapper of `strrpos` method |
| `StringType` or `NullableStringType`                                         | `implode`                | Wrapper of `implode` method |
| `StringType` or `NullableStringType`                                         | `insert`                 | Insert the value into the string at an index |
| `StringType` or `NullableStringType`                                         | `kebabCase`              | Convert string to kebab case |
| `StringType` or `NullableStringType`                                         | `length`                 | Wrapper of `strlen` method |
| `StringType` or `NullableStringType`                                         | `limit`                  | Limit the string to a given number of characters |
| `StringType` or `NullableStringType`                                         | `lowerCase`              | Convert string to lower case |
| `StringType` or `NullableStringType`                                         | `lowerCaseFirstLetter`   | Wrapper of `lcfirst` method |
| `StringType` or `NullableStringType`                                         | `matches`                | Check if the string matches a given regular expression |
| `StringType` or `NullableStringType`                                         | `prepend`                | Prefix characters to the string |
| `StringType` or `NullableStringType`                                         | `random`                 | Generate randoms string of given length |
| `StringType` or `NullableStringType`                                         | `replace`                | Wrapper of `str_replace` method |
| `StringType` or `NullableStringType`                                         | `replaceFirst`           | Wrapper of `substr_replace` method |
| `StringType` or `NullableStringType`                                         | `replaceLast`            | Wrapper of `substr_replace` method |
| `StringType` or `NullableStringType`                                         | `replaceUsingExpression` | Wrapper of `preg_replace` method |
| `StringType` or `NullableStringType`                                         | `safeHtml`               | Wrapper of `htmlspecialchars` method |
| `StringType` or `NullableStringType`                                         | `snakeCase`              | Convert string to snake case |
| `StringType` or `NullableStringType`                                         | `studCase`               | Convert string to studly case |
| `StringType` or `NullableStringType`                                         | `substring`              | Wrapper of `mb_substr` method |
| `StringType` or `NullableStringType`                                         | `titleCase`              | Convert string to title case |
| `StringType` or `NullableStringType`                                         | `trim`                   | Wrapper of `trim` method |
| `StringType` or `NullableStringType`                                         | `trimLeft`               | Wrapper of `ltrim` method |
| `StringType` or `NullableStringType`                                         | `trimRight`              | Wrapper of `rtrim` method |
| `StringType` or `NullableStringType`                                         | `upperCase`              | Convert string to upper case |

These utility methods will enforce the original data type / throw exceptions when the result would alter the type e.g. dividing an `int` by `2.3`.

## Custom Methods (Macros)

Each of the types also includes a trait that allows you to add your own custom utility methods without having to create a subclass. You can define these methods using a closure like so:

```php
// Register the macro
StringType::macro('suffix', function($suffix) {
    return $this->value().' '.$suffix;
});

// Call the method as normal
StringType::make('Hello')->suffix('World') // Hello World
```

## Avoiding Overkill

Common sense would dictate that if you do not intend to do any form of processing / data manipulation, then there is little point in converting a simple native type into an object purely to enforce type safety. For example, consider the `string` supplied to the constructor of the following exception:

```php
throw new Exception('Something went wrong');
```

Since it isn't going to be manipulated, and since no processing is going to be performed upon it, there is no benefit to doing the following:

```php
throw new Exception(StringType::make('Something went wrong') -> value());
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.