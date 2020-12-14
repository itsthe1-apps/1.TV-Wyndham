<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
$attributes = array('name' => 'myform','autocomplete'=>'off');

echo form_open($this->uri->uri_string(), $attributes);

/**
  echo $this->validation->error_string;
 * */
$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='130'><label for='name'>Menu Name</label><span class='star'> * </span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>" . form_input('name',isset($rest_menutype['name']) ? $rest_menutype['name'] : $this->input->post('name'),'id="name" maxlength=100 size=25') . "</td>";
$table.="<td><span id='error'>" . form_error('name') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='name'>Menu Code</label><span class='star'> * </span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>" . form_input('code',isset($rest_menutype['code']) ? $rest_menutype['code'] : $this->input->post('code'),'maxlength=20 size=20') . "</td>";
$table.="<td><span id='error'>" . form_error('code') . "</span></td>";
$table.="</tr>";

if($task == "update"){
	$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="update"><img src="' . base_url() . 'images/apply2.png" alt=""/>Update</button></div></td>';
$table.="</tr>";
}else{
	$table.="<tr>";
	$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="' . base_url() . 'images/apply2.png" alt=""/>Create</button></div></td>';
	$table.="</tr>";
}
$table.="</table>";

print $table;

echo form_close();
?>