<html>
<body>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
	<tr>
    	<td align="left" valign="middle"><h1><?php echo $title;?></h1></td>
        <td align="right" valign="middle">
            <div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?=base_url()?>index.php/messages/addmessage" class="btn btn-success" role="button">
                    <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>SEND MESSAGE
                </a>
            </div>
        </td>
    </tr>
</table>


<table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
<thead>
    <tr class="success">
        <th width="9%" style="border-right:1px #FFF solid;">Message</th>
        <th width="9%" style="border-right:1px #FFF solid;">Users</th>
        <th width="9%">Action</th>
    </tr>
</thead>                  
<tbody>
<?
if(count($message)>0){
	foreach($message as $row){
?>
<tr>
	<td class="message_text" align="center" width="10%"><?
	
	print $this->message->word_limiter($row->message,10,'...');
	
	?>&nbsp;</td>
   <td align="center" width="10%">
   	<?
   		$this->message->get_message_users($row->id);
	?></td>
    <td align="center" valign="middle" width="10%" >
    	<a href="<?=base_url()?>index.php/messages/editmessage/<?=$row->id?>">
         <span class="glyphicon glyphicon-edit"></span> Edit   
        </a>
        &nbsp;|&nbsp;
        <a href="javascript:deleteconform('messages/deletemessage','<?=$row->id?>','')">
         <span class="glyphicon glyphicon-remove-sign"></span> Delete
        </a>&nbsp;
    </td>
</tr>
<? }}else{?>
<tr>
	<td align="center" colspan="11">No Data Found</td>
</tr>
<? }?>
</tbody>
</table>
<p align="center"><?=$pagination?></p>
</body>
</html>