<h1 class="page_title"><?php echo $title; ?></h1>
<?php
$attributes = array('autocomplete' => 'off', 'class' => 'form-inline form_elements_list');
print form_open($this->uri->uri_string(), $attributes);
?>
<hr/>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="vod_genre">VOD Genre Name<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'vod_genre', 'id' => 'vod_genre', 'class' => 'form-control', 'placeholder' => 'VOD Genre Name', 'value' => $vodgenre_info['name'] ? $vodgenre_info['name'] : $this->input->post('vod_genre'), 'onKeyup' => 'GenerateURL(this.value);']); ?>
        <span id='error'><?= form_error('vod_genre') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button">
        <span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back
    </button>
    <? if(isset($vodgenre_info['id'])){?>
    <button type="submit" class="btn btn-success" name="update">
        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update
    </button>
    <? }else{ ?>
    <button type="submit" class="btn btn-success" name="submit">
        <span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Creat
    </button>
    <? } ?>
</div>


<?php
print form_input(array('name'=>'url','id'=>'url','size'=> 25,'type'=>'hidden','value'=>isset($vodgenre_info['url']) ? $vodgenre_info['url'] : $this->input->post('url')));
print form_close();
?>
<script type="text/javascript">
    function GenerateURL(x) {
        var url = 'welcome/product/' + x.replace(" ", "");
        document.getElementById('url').value = url + "/";
    }
</script>