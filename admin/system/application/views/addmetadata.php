<h1><?php echo $title;?></h1>
<?
echo form_open('welcome/addMetada');

$data_dirname	= array('name'=>'dirname','id'=>'dirname','size'=> 25);
$data_cast		= array('name'=>'cast','id'=>'cast','size'=> 25);
$data_language	= $this->config->item('languages');

$table="<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$table.="<tr>";
$table.="<td width='130'><label for='dirname'>Director Name</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($data_dirname,$dirname)."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('dirname')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='cast'>Cast</label><span class='star'>*</span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($data_cast,$cast)."</td>";
$table.="<td><span style='color:#FF0000; font-size:16px;'>".form_error('cast')."</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='LangID'>Language</label></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_dropdown('LangID',$data_language,$LangID)."</td>";
$table.="<td>&nbsp;</td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td colspan='3'>".form_submit('submit','Create Metadata')."</td>";
$table.="</tr>";

$table.="</table>";

print $table;
echo form_close();

?>