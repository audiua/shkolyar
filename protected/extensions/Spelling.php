<?php

class Spelling{
	static public function correct($text){

		str_replace(',', ', ', $text);
		str_replace('.', '. ', $text);
		str_replace('-', ' - ', $text);


		return $text;
	}
}