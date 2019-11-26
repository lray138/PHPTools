<?php

namespace lray138\PHPTools;

//use lray138\PHPTools\FuncTool;

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


	// below is from Pro PHP MVC
	private function __construct()
        {
            // do nothing
        }
        
        private function __clone()
        {
            // do nothing
        }
        
        public static function clean($array)
        {
            return array_filter($array, function($item) {
                return !empty($item);
            });
        }
        
        public static function trim($array)
        {
            return array_map(function($item) {
                return trim($item);
            }, $array);
        }
        
        public static function first($array)
        {
            if (sizeof($array) == 0)
            {
                return null;
            }
            
            $keys = array_keys($array);
            return $array[$keys[0]];
        }
        
        public static function last($array)
        {
            if (sizeof($array) == 0)
            {
                return null;
            }
            
            $keys = array_keys($array);
            return $array[$keys[sizeof($keys) - 1]];
        }
        
        public static function toObject($array)
        {
            $result = new \stdClass();
            
            foreach ($array as $key => $value)
            {
                if (is_array($value))
                {
                    $result->{$key} = self::toObject($value);
                }
                else
                {
                    $result->{$key} = $value;
                }
            }
            
            return $result;
        }
        
        public function flatten($array, $return = array())
        {
            foreach ($array as $key => $value)
            {
                if (is_array($value) || is_object($value))
                {
                    $return = self::flatten($value, $return);
                }
                else
                {
                    $return[] = $value;
                }
            }
            
            return $return;
        }
        
        public function toQueryString($array)
        {
            return http_build_query(
                self::clean(
                    $array
                )
            );
        }

        public static function toUl($array) {
            $fn = FuncTool::compose(
                'lray138\PHPTools\HTMLTool::wrapUl',
                'implode',
                ArrayTool::mapFn('lray138\PHPTools\HTMLTool::wrapLi'));
            return $fn($array);
        }

}