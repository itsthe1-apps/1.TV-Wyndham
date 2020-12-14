<?
$id = $_REQUEST['id'];
$hostname=$_REQUEST['host'];
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$database=$_REQUEST['database'];

mysql_connect($hostname,$username, $password) or die ("<html><script language='JavaScript'>alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
mysql_select_db($database);
$sql = "select * from users where id=".$id." and username=0";
$rsl = mysql_query($sql);
$num_rows = mysql_num_rows($rsl);
if($num_rows>0){
?>
<select name="list2[]" id="list2" multiple size="12" class="dropdown" style="width:98%">
<? while($row=mysql_fetch_assoc($rsl)){?>
	<option value="<?=$row['id']?>"><?=$row['id']?>&nbsp;&nbsp;(<?=$row['id']?>)</option>
<? } ?>
</select>
<?
}else{
?>
<select name="list2" id="list2" multiple size="12" class="dropdown" style="width:98%"></select>
<?
}
?>