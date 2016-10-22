<?php
/************************************************************************
 HopegiverPHP - Web Application Development Framework for PHP
 
 Copyright (C) 2007 MalgnSoft, Inc.

 This library is free software; you can redistribute it and/or
 modify it under the terms of the GNU Lesser General Public
 License as published by the Free Software Foundation; either
 version 2.1 of the License, or (at your option) any later version.
************************************************************************/

class BearTemplate {

	var $Var;
	var $Loop;
	var $File;
	var $Root;
	var $debug;

	function BearTemplate($root="") {
		$this->Var =& $_REQUEST;
		$this->Loop = array();
		$this->File = array();
		$this->Root = preg_replace("/[\/]+$/", "", $root);
		$this->debug = false;
	}

	function setDebug() {
		$this->debug = true;
	}

	# 파일을 정의하는 함수
	function define($name, $file="") {
		if(is_array($name) && $file == "") {
			foreach($name as $n => $v) $this->define($n, $v);
		} else {
			$this->File[$name] = $file;
		}
	}

	# 변수를 지정하는 함수
	function assign($name, $value="") {
		if(is_array($name) && $value == "") {
			foreach($name as $n => $v) $this->assign($n, $v);
		} else {
			switch(getType($value)) {
				case 'array':
					if(isset($value[0]) && is_array($value[0])) {
						$this->Loop[$name] = $value;
						$this->Var[$name] = true;
						break;
					}
				case 'object':
					foreach($value as $n => $v) {
						if(is_array($v)) $this->assign($n, $v);
						else $this->assign($name.".".$n, $v);
					}
					break;
				default:
					$this->Var[$name] = $value;
			}
		}
	}

	# 파싱함수
	function parse($name, $loop=false) {

	}

	# 불러오기
	function fetch($name) {
		ob_start();
		$this->tprint($name);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	# 출력하기
	function tprint($name="") {
		if($name == "") $name = $this->_top;
		$file = isset($this->File[$name]) ? $this->File[$name] : $name;
		$this->_parseTag($this->_readFile($file));
	}

	# 파일 지정 함수 (define의 다른이름)
	function setFile($name, $file) {
		$this->define($name, $file);
	}

	# 변수 지정 함수 (assign의 다른이름)
	function setVar($name, $value="") {
		$this->assign($name, $value);
	}

	# 루프 변수 지정 함수
	function setLoop($name, $value) {
		if(!empty($value) && is_array($value)) {
			$this->Loop[$name] = $value;
			$this->Var[$name] = true;
		}
	}

	# 파일읽기(내부함수)
	function _readFile($path) {
		if($this->Root != "" && is_file($this->Root . "/" . $path)) $path = $this->Root . "/" . $path;
		if(!@is_readable($path)) return $this->setError("$path is not readable");
		if(!$fp = @fopen($path, "r")) return $this->setError("$path is not opened");
		$buffer = @fread($fp, filesize($path));
		fclose($fp);
		return $buffer;
	}

	# URL읽기(내부함수)
	function _readURL($url) {
		$r = parse_url($url);
		if(!isset($r['host'])) $r['host'] = $_SERVER['HTTP_HOST'];
		if(!isset($r['port'])) $r['port'] = 80;
		$path = isset($r['query']) ? $r['path'] . "?" . $r['query'] : $r['path'];
		if(!$fp = @fsockopen($r['host'], $r['port'], $errno, $errstr, 30)) {
			return $this->setError("$url is not connected");
		}
		fwrite($fp, "GET $path HTTP/1.0\r\nHost: $r[host]\r\n\r\n");
		$body = false; $buffer = "";
		while(!feof($fp)) {
			$s = fgets($fp, 1024);
			if($body == true) $buffer .= $s;
			else if($s == "\r\n") $body = true;
		}
		fclose($fp);
		return $buffer;
	}

	# PHP실행 (내부함수)
	function _exePHP($path) {
		
		GLOBAL $SS_LEVEL;
        $var_arr = explode("?", $path);     // 변수를 지정했을 경우
        if(isset($var_arr[1])) parse_str($var_arr[1]);							// 변수를 파싱해서 넘겨줌.
        $filename = $var_arr[0];
		if(!is_readable($filename)) return $this->setError("$filename is not readable");	
		include_once($filename);	// 에러발생시 출력
	}

	# 소스코드실행 (내부함수)
	function _exeCode($code) {
		if(substr($code, -1) != ";") $code .= ";";
		eval(str_replace(">>", "echo ", $code)); // 에러발생시 출력
	}


	function _parseCmd($str) {
		$arr = explode(" ", $str);
		if(in_array($arr[0], array("INCLUDE", "EXECUTE", "LOOP", "IF", "IFNOT"))) {
			$arr[2] = $this->_parseVar(substr($arr[2], 1, -1), 0);
		} else {
			echo("<!-- $str -->");
		}
		return $arr;
	}

	# 문자를 파싱 (내부함수)
	function _parseVar($buffer, $print=1) {
		$arr1 = explode("{{", $buffer);
		$str = $arr1[0];
		for($i=1, $max = count($arr1); $i<$max; $i++) {
			$arr2 = explode("}}", $arr1[$i]);
			if(preg_match("/^[^ ]+$/i", $arr2[0])) {
				if(isset($this->Var[$arr2[0]])) {
					$str .= $this->Var[$arr2[0]] . substr($arr1[$i], strlen($arr2[0]) + 2);
				} else {
					$str .= substr($arr1[$i], strlen($arr2[0]) + 2);
				}
			} else {
				$str .= "{{" . $arr1[$i];
			}
		}
		if($print) echo($str);
		else return $str;
	}

	# 문자를 파싱 (내부함수)
	function _parseLoop($name, &$buffer) {
		if(is_array($this->Loop[$name])) {
			foreach ($this->Loop[$name] as $row) {
				$this->assign($name, $row);
				$this->_parseTag($buffer);
			}
		} else if(is_object($this->Loop[$name])) {
			while(!$this->Loop[$name]->EOF) {
				$this->assign($name, $this->Loop[$name]->fields);
				$this->_parseTag($buffer);
				$this->Loop[$name]->MoveNext();
			}
		}
	}

	# 템플릿 태그들을 스캐닝 (내부함수)
	function _parseTag($buffer) {
		$offset = 0;
		while(is_int($pos = strpos($buffer, "<!-- ", $offset))) {
			$this->_parseVar(substr($buffer, $offset, $pos - $offset));
			$offset = $pos + 5;
			$char = $buffer{$pos + 5} . $buffer{$pos + 6};
			if(($char == "IN" || $char == "IF" || $char == "LO" || $char == "EX") && 
				is_int($endpos = strpos($buffer, " -->", $offset))) {

				$offset = $endpos + 4;
				if($endpos - $pos > 100) {
					echo(substr($buffer, $pos, $endpos - $pos + 4));
					continue;
				}
				$arr = $this->_parseCmd(substr($buffer, $pos + 5, $endpos - $pos - 5));
				switch($arr[0]) {
					case 'INCLUDE':
						if($arr[1] == "FILE") $this->_parseTag($this->_readFile($arr[2]));
						else if($arr[1] == "URL") $this->_parseTag($this->_readURL($arr[2]));
						else if($arr[1] == "NAME") {
							if(isset($this->File[$arr[2]])) {
								$this->_parseTag($this->_readFile($this->File[$arr[2]]));
							} else {
								$this->setError("INCLUDE NAME '$arr[2]' is not defined");
							}
						}
						break;
					case 'EXECUTE':
						if($arr[1] == "FILE") $this->_exePHP($arr[2]);
						else if($arr[1] == "CODE") $this->_exeCode($arr[2]);
						break;
					case 'LOOP':
						if($arr[1] == "START") {
							$next = "<!-- LOOP END '" . $arr[2] . "' -->";
							if(is_int($endpos = strpos($buffer, $next, $offset))) {
								if(isset($this->Loop[$arr[2]]) && !empty($this->Loop[$arr[2]])) {
									$this->_parseLoop($arr[2], substr($buffer, $offset, $endpos - $offset));
								}
								$offset = $endpos + strlen($next);
							} else {
								$this->setError("LOOP END '$arr[2]' not exists");
							}
						}
						break;
					case 'IF':
						if($arr[1] == "START" && (!isset($this->Var[$arr[2]]) || empty($this->Var[$arr[2]]))) {
							$next = "<!-- IF END '" . $arr[2] . "' -->";
							if(is_int($endpos = strpos($buffer, $next, $offset))) {
								$offset = $endpos + strlen($next);
							} else {
								$this->setError("IF END '$arr[2]' not exists");
							}
						}
						break;
					case 'IFNOT':
						if($arr[1] == "START" && (isset($this->Var[$arr[2]]) && !empty($this->Var[$arr[2]]))) {
							$next = "<!-- IFNOT END '" . $arr[2] . "' -->";
							if(is_int($endpos = strpos($buffer, $next, $offset))) {
								$offset = $endpos + strlen($next);
							} else {
								$this->setError("IFNOT END '$arr[2]' not exists");	
							}
						}
						break;
					default:
						break;
				}
			} else {
				echo("<!-- ");
			}
		}
		$this->_parseVar(substr($buffer, $offset));
	}

	function clear() {
		$this->Var = array();
		$this->Loop = array();
		$this->File = array();
	}

	function setError($msg) {
		if($this->debug == true) echo("<b>Template Error:</b> $msg <br>\r\n");
		return false;
	}

}

?>