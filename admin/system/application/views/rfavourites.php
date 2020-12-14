<? 
$attributes = array('name'=>'listform');
print form_open('radio/radiofavourites',$attributes)?>
<table width="99%" cellpadding="0" cellspacing="0" style="margin-bottom:8px;">
    <tr>
        <td align="left" valign="top"><h1 class="page_title"><?php echo $title; ?></h1><br></td>
    </tr>
    <tr>
        <td align="left" valign="">Select User : 
            <?php
            /**
              if(isset($fav_array) && count($fav_array)>0){
              $get_fav = str_replace(",","-",$fav_array['fav_channel_id']);
              }
             * */
            if (count($users) > 0) {
                $opt_users[] = "Select";
                foreach ($users as $row) {
                    $opt_users[$row->id] = $row->name;
                }
            } else {
                $opt_users[] = "Select";
            }

            print form_dropdown('users-changel', $opt_users, $this->input->post('users-changel'), 'onchange="doSubmit(this.value)"');
            ?>
        </td>
    </tr>
</table>
<?php
print form_close();
if ($this->session->flashdata('ae_fav')) {
    print "<div id='msg'>";
    echo "<p id='ms' align='justify'>" . $this->session->flashdata('ae_fav') . "</p>";
    print "</div>";
}
?>
<br>
<div class="table_glob">
    <table border='0' cellspacing='0' cellpadding='3' width='99%' class="table table-bordered table-hover">
        <thead>
            <tr class="success">
                <th width="60%">Channel Name</th>
                <th width="30%">Icon</th>
                <th width="10%">Action</th>
            </tr>  
        </thead>
        <tbody>
            <? if(isset($favourites) && count($favourites)>0){
            foreach($favourites as $row){
            ?>
            <tr class="active">
                <td valign="middle" align="center" width="60%">
                    <?= $row->name ?>
                </td>
                <td valign="middle" align="center" width="30%"><img width="50" src="<?= base_url() ?>icons/RADIO/<?= $row->logo ?>" /></td>
                <td width="10%" align="center"><a href="javascript:deleteconform('radio/deleteradiofavourites','<?= $_POST['users-changel'] ?>','<?= $row->id ?>')"><img src="<?= base_url() ?>images/cross.png" /></a></td>
            </tr>
            <?
            }
            ?>
            <? } ?>
        </tbody>
    </table>
</div>
<script language="javascript">
    function doSubmit(val) {
        document.listform.submit();
    }
</script>