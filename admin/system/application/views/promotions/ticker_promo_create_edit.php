<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<br/><br/>
<?php
$attributes = array('name' => 'myform', 'autocomplete' => 'off');
echo form_open($this->uri->uri_string(), $attributes);
//echo "<pre>";
//print_r($edit_data);
//echo "</pre>";
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table">
    <tr>
        <td width="280" valign="top"><label for="restaurant_id">Restaurant</label><span class="star"> * </span></td>
        <td width="30" valign="top">:</td>
        <td width="400" valign="top">
            <?php
            $options = $this->config->item('ticker_promo_menu');
            print form_dropdown('restaurant_id', $options, isset($edit_data['restaurant_id']) ? $edit_data['restaurant_id'] : $this->input->post('restaurant_id'),'class="form-control"');
            ?>
        </td>
        <td valign="top"><span id="error"><?= isset($image_error) ? $image_error : '' ?></span></td>
    </tr>
    <tr>
        <td width="280" valign="top"><label for="se_current_theme">Location</label><span class="star"> * </span></td>
        <td width="30" valign="top">:</td>
        <td width="400" valign="top">
            <?php
            $data = array(
                'name' => 'ticker_promo_txt',
                'id' => 'ticker_promo_txt',
                'class' => 'form-control',
                'value' => isset($edit_data['ticker_promo_txt']) ? $edit_data['ticker_promo_txt'] : $this->input->post('ticker_promo_txt'),
                'rows' => '5',
                'cols' => '10'
            );
            print form_textarea($data);
            ?>
        </td>
        <td valign="top"><span id="error"><?= form_error('') ?></span></td>
    </tr>
    <tr>
        <td colspan="4" align="left"><br/>
            <div class="buttons">
                <button onclick="history.back();return false;" class="btn btn-danger">Back</button>
                <?php if (isset($edit_data['ticker_promo_id'])) { ?>
                    <button type="submit" class="btn btn-primart" name="update">Update</button>
                <?php } else { ?>
                    <button type="submit" class="btn btn-success" name="submit">Create</button>
                    <?php } ?>
            </div>
        </td>
    </tr>
</table>
<?php print form_close(); ?>