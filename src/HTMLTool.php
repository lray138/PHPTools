<?php

namespace lray138\PHPTools;

class HTMLTool {
	
	static function a($href, $text, $attributes = null) {
		$anchor = "<a href='$href'";
		// process array of attributes, otherwise if string append
		if(!is_null($attributes)) {
			$anchor = $anchor . self::processAttributes($attributes);
		}
		$anchor = $anchor .">$text</a>";
		return $anchor;
	}

	static function img($src, $attributes = null) {
		$img = "<img src='$src'";
		if(!is_null($attributes)) {
			$img = $img . self::processAttributes($attributes);
		}
		$img .= "/>";
		return $img;
	}

	static function wrapUl($string, $options = []) {
		return self::wrapTag("ul", $string, $options);
	}

	static function wrapLi($string, $options = []) {
		return self::wrapTag("li", $string, $options);
	}

	static function wrapTr($string, $options = []) {
		return self::wrapTag("tr", $string, $options);
	}

	static function wrapTd($string, $options = []) {
		return self::wrapTag("td", $string, $options);
	}

	static function wrapTag($element, $string, $options = []) {
		return "<$element>$string</$element>";
	}

	static function processAttributes($attributes) {
		if(is_array($attributes)) {
			$attr = "";
			ArrayTool::forEach(function($value, $key) use (&$attr) {
				$attr = "$attr $key='$value'";
			}, $attributes);
		} else {
			$attr = " " . $attributes;
		}

		return $attr;
	}

	static function selfLink($string) {
		return self::a($string, $string);
	}

}