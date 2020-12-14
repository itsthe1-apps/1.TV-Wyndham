<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1><?php echo $title; ?></h1></td>
        <td align="right" valign="middle"><?=$this->TVclass->language_dp('language',$this->session->userdata($session_keyword),"onChange='language_change(this.value,\"$session_keyword\")'")?><div class="buttons" style="float:right; margin-top:0px;"><a href="<?= base_url() ?>index.php/restaurants/addrestaurant" class="btn btn-success">
             <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>ADD RESTAURANT</a>
        </div>
    </td>
    </tr>
</table>
<?
if ($this->session->flashdata('movie_u')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_u') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('movie_c')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_c') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('movie_d')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_d') . "</p>";
    print "</div>";
}
if ($this->session->flashdata('movie_img')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('movie_img') . "</p>";
    print "</div>";
}
?>
 <table border='0' cellspacing='0' cellpadding='0' width='99%' class="table table-bordered table-hover">
    <thead>
        <tr class="success">
            <th width="35%" style="border-right:1px #FFF solid;">Restaurant Name</th>
            <th width="16%" style="border-right:1px #FFF solid;">Icon</th>
            <th width="14%">Actions</th>
        </tr>
    </thead>

<tbody>
       <?
    if (count($restaurant) > 0) {
        foreach ($restaurant as $key => $value) {
            ?>
            <tr>
                <td valign="middle" align="center" width="35%"><strong><?=$value->name ?></strong></td>
                <td valign="middle" align="center" width="16%">
                    <?
                    $image_names = explode("|",$value->image);
                    foreach ($image_names as $img_value) {
                        $img_url = $this->config->item('rest_icon_url').$img_value;
                        echo '<img width="120" style="padding:10px;" src="'.$img_url.'"/>';
                    }   
                    ?>
                </td>
                <td valign="middle" align="center" width="14%">
                	<a href="<?= base_url() ?>index.php/restaurants/editrestaurant/<?=$value->id ?>"><img src="<?=base_url() ?>images/edit.png" width="16" height="16" border="0" title="Edit"/></a>&nbsp;<a href="javascript:deleteconform('restaurants/deletrestaurant','<?=$value->id ?>','')"><img src="<?=base_url() ?>images/cross.png" width="16" height="16" border="0" title="Delete"/></a>
                </td>
            </tr>
       <?
		}
	}else{
	   ?>
        <tr>
                <td valign="middle" align="center" colspan="3">No Data Found</td>
        </tr>
       <?
		}
	   ?>
       </tbody>
</table>
<!--<div id="page" align="center"><? //$pagination; ?></div>-->