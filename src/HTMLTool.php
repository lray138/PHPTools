<?php

namespace lray138\PHPTools;

class HtmlTool {
	
	static function a($href, $text, $attributes = null) {
		$anchor = "<a href='$href'";
		// process array of attributes, otherwise if string append
		if(!is_null($attributes)) {
			$anchor = $anchor . $this->processAttributes($attribute);
		}
		$anchor = $anchor .">$text</a>";
		return $anchor;
	}

	static function wrapUl($string) {
		return "<ul>" . $string . "</ul>";
	}

	static function wrapLi($string) {
		return "<li>" . $string . "</li>";
	}

	function processAttributes($attributes) {
		if(is_array($attributes)) {
			$attr = "";
			ArrayTool::forEach(function($value, $key) use (&$attr) {
				$attr = "$attr $key='$value'";
			}, $attributes);
		} else {
			$attr = " " . $attributes;
		}

		return $attributes;

	}

}