<?php

require_once("controls.php");

class listbox extends controls
{	
	var $items = array();
	
	function listbox($id)
	{
		$this->attributes["id"] = $id;
		$this->attributes["multiple"] = "multiple";		
	}
	
	function clear()
	{
		$this->items = array();
	}
	
	function addItem($text, $value)
	{
		$this->items[$text] = $value;
	}

	function render()
	{		
		$html = '<select'.$this->setAttributes().">\n";		
		foreach($this->items as $text => $value)
		{
			$html.='<option value="'.$value.'">'.$text.'</option>'."\n";
		}		
		return $html.'</select>';
	}
}

?>