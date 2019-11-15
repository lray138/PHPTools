<?php

namespace lray138\PHPTools;

class ArrayTool {

	// concat the contents of an array
	// this looks like it came from the Packt functional PHP video
	// or I used something I learned from it.
	function concat(array $array, string $carry = "") : string
	{
		return array_reduce($array, function($carry, $item) {
			return $carry . $item;
		}, $carry);
	}

	// this was perhaps academic in that I was appying 
	// some functional programming lessons
	static function forEach($fn, $array) {
		foreach($array as $key => $a) {
			gettype($fn) === "object" ? $fn($array[$key], $key) : call_user_func($fn, $array[$key], $key);
		}
	}

	// return a function that takes an array and maps the 
	// previously provided function
	static function mapFn($fn) {
		return function($array) use ($fn) {
			return array_map($fn, $array);
		};
	}

}