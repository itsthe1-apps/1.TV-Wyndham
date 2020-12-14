<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//Ckeditor's configuration
$ckeditor = array(
    //ID of the textarea that will be replaced
    'id' => 'description',
    'path' => 'js/ckeditor',
    //Optionnal values
    'config' => array(
        'toolbar' => "Full", //Using the Full toolbar
        'width' => "450px", //Setting a custom width
        'height' => '100px', //Setting a custom height
    ),
    //Replacing styles from the "Styles tool"
    'styles' => array(
        //Creating a new style named "style 1"
        'style 1' => array(
            'name' => 'Blue Title',
            'element' => 'h2',
            'styles' => array(
                'color' => 'Blue',
                'font-weight' => 'bold'
            )
        ),
        //Creating a new style named "style 2"
        'style 2' => array(
            'name' => 'Red Title',
            'element' => 'h2',
            'styles' => array(
                'color' => 'Red',
                'font-weight' => 'bold',
                'text-decoration' => 'underline'
            )
        )
    )
);
?>
<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<br /><br />
<?php
$data_language = $this->config->item('languages');
$attributes = array('name' => 'myform', 'autocomplete' => 'off');
echo form_open_multipart($this->uri->uri_string(), $attributes);

if (isset($edit_data['image'])) {
    $file = $edit_data['image'];
    print form_input(array('name' => 'edit_image', 'type' => 'hidden', 'value' => $file));
}
?>


<table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
        <td width="30%" valign="top"><label for="name">Language</label><span class="star"> * </span></td>
        <td width="10%" valign="top">:</td>
        <td width="30%" valign="top"><?= $this->TVclass->language_dp('language', isset($edit_data['language']) ? $edit_data['language'] : $this->session->userdata($session_keyword), 'id="language"') ?></td>
        <td width="30%" align="left" valign="top"><span id="error"><?= form_error('language') ?></span></td>
    </tr>
    <tr>
        <td valign="top"><label for="name">Name</label><span class="star"> * </span></td>
        <td valign="top">:</td>
        <td valign="top"><?= form_input('name', isset($edit_data['name']) ? $edit_data['name'] : $this->input->post('name'), 'maxlength=100') ?></td>
        <td align="left" valign="top"><span id="error"><?= form_error('name') ?></span></td>
    </tr>
    <tr>
        <td valign="top"><label for="image">Image <font class="image_size">(Width=<?= $image_width ?>, Height=<?= $image_height ?>)</font></label><span class="star"> * </span></td>
        <td valign="top">:</td>
        <td valign="top">
            <?php
            $st_img = isset($edit_data['image']) ? "<img src='" . $this->config->item('localinfo_icon_url') . $edit_data['image'] . "' align='right' width='100' height='80' style='float: right;margin-top: -25px;'>" : "";
            print form_upload('image') . '&nbsp;&nbsp;' . $st_img;
            ?>
        </td>
        <td valign="top"><span id="error"><?= isset($image_error) ? $image_error : '' ?></span></td>
    </tr>
    <tr>
        <td valign="top"><label for="description">Description</label><span class="star"> * </span></td>
        <td valign="top">:</td>
        <td valign="top">
            <?php
            $description = array('name' => 'description', 'cols' => 40, 'rows' => 5, 'value' => isset($edit_data['description']) ? html_entity_decode($edit_data['description']) : html_entity_decode($this->input->post('description')), 'id' => 'description');
            print form_textarea($description);
            print display_ckeditor($ckeditor);
            ?>
        </td>
        <td valign="top"><span id="error"><?= form_error('description') ?></span></td>
    </tr>
    <tr>
        <td colspan="4" align="left"><br/>
            <div class="buttons">
                <button onclick="history.back();return false;" class="positive"><img src="<?= base_url() ?>images/cross.png" alt=""/>Back</button>
                <?php if (isset($edit_data['id'])) { ?>
                    <button type="submit" class="positive" name="update"><img src="<?= base_url() ?>images/apply2.png" alt=""/>Update</button>
                <?php } else { ?>
                    <button type="submit" class="positive" name="submit"><img src="<?= base_url() ?>images/apply2.png" alt=""/>Create</button>
                    <?php } ?>
            </div>
        </td>
    </tr>
</table>
<?php print form_close(); ?>