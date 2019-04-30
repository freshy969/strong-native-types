<?php declare(strict_types = 1);

// Namespace
namespace Alphametric\Strong\Foundation;

// Using directives
use Closure;
use ReflectionClass;
use ReflectionMethod;
use BadMethodCallException;

// Macro trait
trait Macro
{

	/**
	 * Array of macro methods.
	 *
	 **/
    protected static $macros = [];



    /**
     * Register a custom macro.
     *
     * @param string $name.
     * @param mixed $macro.
	 * @return void.
	 *
     **/
    public static function macro(string $name, $macro)
    {
		// Add the macro the array
        static::$macros[$name] = $macro;
    }



    /**
     * Mix another object into the class.
     *
     * @param object $mixin.
	 * @return void.
	 *
     **/
    public static function mixin($mixin)
    {
		// Retrieve the class methods
        $methods = (new ReflectionClass($mixin)) -> getMethods(
            ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED
        );

		// Attach them to the macro array
        foreach ($methods as $method) {
            $method -> setAccessible(true);
            static::macro($method -> name, $method -> invoke($mixin));
        }
    }



	/**
	 * Execute a macro with the given parameters.
	 *
	 * @param string $method.
	 * @param array $parameters.
	 * @return mixed.
	 *
	 **/
    public function __call($method, $parameters)
    {
		// Ensure the macro exists
        if (! isset(static::$macros[$method])) {
            throw new BadMethodCallException("Method $method does not exist.");
        }

		// Retrieve a local copy of the macro
        $macro = static::$macros[$method];

		// Check if the macro is a closure
		if ($macro instanceof Closure) {
            return call_user_func_array($macro->bindTo($this, static::class), $parameters);
        }

		// Otherwise, run the macro
        return call_user_func_array($macro, $parameters);
    }



	/**
	 * Execute a static macro with the given parameters.
	 *
	 * @param string $method.
	 * @param array $parameters.
	 * @return mixed.
	 *
	 **/
    public static function __callStatic($method, $parameters)
    {
		// Ensure the macro exists
        if (! isset(static::$macros[$method])) {
            throw new BadMethodCallException("Method $method does not exist.");
        }

		// Retrieve a local copy of the macro
        $macro = static::$macros[$method];

		// Check if the macro is a closure
        if ($macro instanceof Closure) {
            return call_user_func_array(Closure::bind($macro, null, static::class), $parameters);
        }

		// Otherwise, run the macro
        return call_user_func_array($macro, $parameters);
    }

}