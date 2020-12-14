<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="middle">
            <?=$this->TVclass->language_dp('language',$this->session->userdata($session_keyword),"onChange='language_change(this.value,\"$session_keyword\")'")?>
            <div class="buttons" style="float:right; margin-top:0px;">
                <a href="<?= base_url() ?>index.php/promotions/add" class="btn btn-success">
                     <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD PROMOTIONS
                </a>
            </div>
        </td>
    </tr>
</table>
<?
if ($this->session->flashdata('promotion_message')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('promotion_message') . "</p>";
    print "</div>";
}
?>
<table border='0' cellspacing='0' cellpadding='0' width='99%' class="table table-bordered table-hover">
<thead>
    <tr class="success">
        <th width="25%" style="border-right:1px #FFF solid;">Type</th>
        <th width="25%" style="border-right:1px #FFF solid;">Icon</th>
        <th width="20%" style="border-right:1px #FFF solid;">URL</th>
        <th width="20%" style="border-right:1px #FFF solid;">Duration</th>
        <th width="10%">Actions</th>
    </tr>
</thead>            
<tbody>
 <?
    if (count($promotions) > 0) {
        foreach ($promotions as $key => $value) {?>
            <tr>
                <td valign="middle" align="center" width="25%"><?=$value->pr_type ?></td>
                <td valign="middle" align="center" width="25%"><?=$value->pr_type=="image" ? '<img width="80" src="'.$this->config->item('promotion_icon_url').$value->pr_url.'"/>' : '-'?></td>
                <td valign="middle" align="center" width="20%"><?=$value->pr_type=="video" ? $value->pr_url : '-'?></td>
                <td valign="middle" align="center" width="20%"><?=$value->pr_duration.' Milliseconds'?></td>
                <td width="10%" valign="middle" align="center">
                	<a href="<?= base_url() ?>index.php/promotions/edit/<?=$value->pr_id ?>">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                    </a>&nbsp;|&nbsp;
                    <a href="javascript:deleteconform('promotions/delete','<?=$value->pr_id ?>','')">
                        <span class="glyphicon glyphicon-remove-sign"></span> Delete
                    </a>
                </td>
            </tr>
       <?
		}
	}else{
	   ?>
        <tr>
                <td valign="middle" align="center" colspan="4">No Data Found</td>
        </tr>
       <?
		}
	   ?>
</tbody>
</table>
<div id="page" align="center"><?=$pagination; ?></div>