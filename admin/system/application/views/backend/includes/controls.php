<?php

class controls
{
	var $attributes = array();
	
	function setAttributes()
	{
		$html = "";
		foreach($this->attributes as $attribute => $value)
		{
			$html.= ' '.$attribute.'="'.$value.'"';
		}
		return $html;
	}
}

?>