<h1><?php echo $title;?></h1>
<?
echo form_open(uri_string());

$data_name		= array('name'=>'name','id'=>'name','size'=> 25);
$data_level		= array('name'=>'level','id'=>'level','size'=> 25);
$data_language	= $this->config->item('languages');

$table="<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='20%'><label for='name'>Name</label><span class='star'>*</span></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>".form_input($data_name,$category['name'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('name')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='20%'><label for='level'>Level</label><span class='star'>*</span></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>".form_input($data_level,$category['level'])."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('level')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='20%'><label for='LangID'>Language</label></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>".form_dropdown('LangID',$data_language,$category['language'])."</td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";

$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="'.base_url().'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="'.base_url().'images/apply2.png" alt=""/>Update Parental Rating</button></div></td>';
$table.="</tr>";

$table.="</table>";
echo form_hidden('id',$category['id']);
print $table;
echo form_close();
?>