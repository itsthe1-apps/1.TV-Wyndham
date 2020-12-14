<?php

require_once("controls.php");
require_once("listbox.php");

class listpicker extends controls
{
	var $lstFrom;
	var $lstTo;
	var $deserializable;
	
	function listpicker($id)
	{
		$this->attributes['id'] = $id;
		$this->lstFrom = new listbox($id.'_lstFrom');
		$this->lstFrom->attributes['style'] = 'width:200px';
		$this->lstFrom->attributes['onclick'] = "unselect('".$id."_lstTo')";	
		$this->lstTo = new listbox($id.'_lstTo');
		$this->lstTo->attributes['style'] = 'width:200px';
		$this->lstTo->attributes['onclick'] = "unselect('".$id."_lstFrom')";
		if (isset($_REQUEST[$id.'$hdnDropdowns']))
		{
			if ($_REQUEST[$id.'$hdnDropdowns'])
			{
				$this->deserializable = true;
				$this->xml(urldecode($_REQUEST[$id.'$hdnDropdowns']));			
			}
		}
	}
	
	function render()
	{	
		$id = $this->attributes['id'];
		$html='<table>
					<tr>
						<td>'
							.$this->lstFrom->render().
					   '</td>
						<td>
							<input id="btnTo" type="button" value=">>" onclick="move(\''.$id.'_lstFrom\',\''.$id.'_lstTo\',\''.$id.'_hdnDropdowns\')" />
								<br />
							<input id="btnFrom" type="button" value="<<" onclick="move(\''.$id.'_lstTo\',\''.$id.'_lstFrom\',\''.$id.'_hdnDropdowns\')" />
						</td>
						<td>'		
							.$this->lstTo->render().
					   '</td>
					</tr>
				</table>
				<input type="hidden" ID="'.$id.'_hdnDropdowns" name="'.$id.'$hdnDropdowns" />';		
		return $html;
	}
	
	function xml($text) 
    {		
		$id = $this->attributes['id'];
		$parser = xml_parser_create();
		xml_parse_into_struct($parser, $text, $vals);
		xml_parser_free($parser);
		$tag = "";

		for($i = 0; $i < count($vals); $i++)
		{	
			switch($vals[$i]['tag'])
			{
				case strtoupper($id.'_lstFrom') : $tag = "lstFrom";	break;
				case strtoupper($id.'_lstTo') : $tag = "lstTo";	break;
			}

			if (($tag) && ($vals[$i]['tag'] == "KEY"))
			{
				$this->{$tag}->addItem($vals[$i]['value'], $vals[$i+1]['value']);					
			}
		}
    }
}

?>