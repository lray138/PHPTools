<?php

namespace lray138\PHPTools;

class FuncTool {
	
	public static function pipe(...$functions) {
		return array_reduce(
        $functions,
        function ($chain, $function) {
            return function ($input) use ($chain, $function) {
                return $function( $chain($input) );
            };
        },
        'FuncTool::identity'
    	);
	}


	public static function compose(...$functions) {
		return array_reduce(
        	array_reverse($functions),
        	function ($carry, $item) {
            return function ($x) use ($carry, $item) {
                return $item($carry($x));
            	};
        	},
        	'lray138\PHPTools\FuncTool::identity'
    	);

	}

	public static function identity($value) {
		return $value;
	}
}
