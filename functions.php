<?php

	function mysql_date_format($date,$separator="/")

	{

		if (empty($date))

			return "";

		else

		{

			$d = explode($separator,$date);

			return $d[2]."-".$d[1]."-".$d[0];

		}

	}



	function to_prety_url($str) 

	{

		if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )

			$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));

		$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');

		$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\1', $str);

		$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');

		$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);

		$str = strtolower( trim($str, '-') );

		return $str;

	}

	function mysqli_datetime_format($datetime)
  {
    $result = substr($datetime, 0, 10);
    $datetime = substr($datetime, 10);
    $result = explode('-', $result);
    $result = $result[2] . '/' . $result[1] . '/' . $result[0] . $datetime;
    return $result;
  }

	function date_to_str($date)
	{
		if (($date == '') || (strlen($date) <> 10))
			return false;
		$reform = substr($date,6,4) . '-' . substr($date,3,2) . '-' .substr($date,0,2);
		return $reform;
	}

	function encode_text($text)
	{
		$text = trim(rtrim(ltrim($text)));
		$text = strip_tags($text);
		$text = stripslashes($text);
		$text = htmlspecialchars($text, ENT_QUOTES);
		return $text;
	}

	function sqlserver_datetime_format($datetime, $divider='-', $separator='-')
  {
    if (empty($datetime)) return '';
    else
    {
      $result = substr($datetime, 0, 10);
      $datetime = substr($datetime, 10);
      $result = explode($separator, $result);
      $result = $result[2] . $divider . $result[1] . $divider . $result[0] . $datetime;
      return $result;
    }
  }	

?>