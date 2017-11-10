<?php

namespace Local\System;

class Log {

	var $file;

	public function __construct($filename)
	{
		$this->file = $_SERVER['DOCUMENT_ROOT'] . '/_log/' . $filename;
		CheckDirPath($this->file);
		$f = fopen($this->file, 'a');
		fwrite($f, "\n");
		fclose($f);
	}

	public function writeText($text)
	{
		$f = fopen($this->file, 'a');
		fwrite($f, date('H:i:s'));
		fwrite($f, "\t");
		fwrite($f, $text);
		fwrite($f, "\n");
		fclose($f);
	}

	public function writeArray($array, $text = '')
	{
		$f = fopen($this->file, 'a');
		fwrite($f, date('H:i:s'));
		if ($text)
		{
			fwrite($f, "\t");
			fwrite($f, $text);
		}
		fwrite($f, "\n");
		fwrite($f, print_r($array, true));
		fwrite($f, "\n");
		fclose($f);
	}

}