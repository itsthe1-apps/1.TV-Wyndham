<? $attributes = array('autocomplete'=>'off','class'=>'form-inline form_elements_list')?>
<? print form_open($this->uri->uri_string(),$attributes); ?>
<h1 class="page_title"><? print $title;?></h1>
<hr>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="UID">Device ID (UID)<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'UID', 'id' => 'UID', 'class' => 'form-control', 'placeholder' => 'Device ID (UID)', 'value' => !empty($devices['UID']) ? $devices['UID'] : $this->input->post('UID')]); ?>
        <span id='error'><?= form_error('UID') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="mac_address">Mac Address<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'mac_address', 'id' => 'mac_address', 'class' => 'form-control', 'placeholder' => 'Mac Address', 'value' => !empty($devices['mac_address']) ? $devices['mac_address'] : $this->input->post('mac_address')]); ?>
        <span id='error'><?= form_error('mac_address') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_type">Device Type<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="device_types" class="form-control select_form_option"';
        $selected_device = !empty($devices['device_type']) ? $devices['device_type'] : $this->input->post('device_type');
        foreach ($devicetype as $row) {
            $opt_devicetypes[$row->id] = $row->device_type;
        }
        print form_dropdown('device_type', $opt_devicetypes, $selected_device, $html_attrs);
        ?>
        <span id='error'><?= form_error('device_type') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_type">Display Type<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="display_types" class="form-control select_form_option"';
        $selected_display = !empty($devices['display_type']) ? $devices['display_type'] : $this->input->post('display_type');
        foreach ($this->config->item('display_types') as $key => $values) {
            $opt_displaytype[$key] = $values;
        }
        print form_dropdown('display_type', $opt_displaytype, $selected_display, $html_attrs);
        ?>
        <span id='error'><?= form_error('display_type') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_type">Video Type<span class='star'> * </span></label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="video_type" class="form-control select_form_option"';
        $selected_video_type = !empty($devices['video_type']) ? $devices['video_type'] : $this->input->post('video_type');
        foreach ($this->config->item('video_types') as $key => $values) {
            $opt_videotype[$key] = $values;
        }
        print form_dropdown('video_type', $opt_videotype, $selected_video_type, $html_attrs);
        ?>
        <span id='error'><?= form_error('video_type') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="purchase_order">Purchase Order</label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'purchase_order', 'id' => 'purchase_order', 'class' => 'form-control', 'placeholder' => 'Purchase Order', 'value' => !empty($devices['purchase_order']) ? $devices['purchase_order'] : $this->input->post('purchase_order')]); ?>
        <span id='error'><?= form_error('purchase_order') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="serial_number">Serial number</label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'serial_number', 'id' => 'serial_number', 'class' => 'form-control', 'placeholder' => 'Serial number', 'value' => !empty($devices['serial_number']) ? $devices['serial_number'] : $this->input->post('serial_number')]); ?>
        <span id='error'><?= form_error('serial_number') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="IAD">IAD</label>
        <label class="seperator_char">:</label>
        <?php echo form_input(['name' => 'IAD', 'id' => 'IAD', 'class' => 'form-control', 'placeholder' => 'IAD', 'value' => !empty($devices['IAD']) ? $devices['IAD'] : $this->input->post('IAD')]); ?>
        <span id='error'><?= form_error('IAD') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_mcast">DEVICE_MCAST</label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="device_mcast" class="checkbox"';
        $is_selected = !empty($devices['device_mcast']) && $devices['device_mcast'] == 1 ? TRUE : FALSE;
        echo form_checkbox('device_mcast', 1, $is_selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('device_mcast') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_rtp">DEVICE_RTP</label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="device_rtp" class="checkbox"';
        $is_selected = !empty($devices['device_rtp']) && $devices['device_rtp'] == 1 ? TRUE : FALSE;
        echo form_checkbox('device_rtp', 1, $is_selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('device_rtp') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_dvbc">DEVICE_DVBC</label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="device_dvbc" class="checkbox"';
        $is_selected = !empty($devices['device_dvbc']) && $devices['device_dvbc'] == 1 ? TRUE : FALSE;
        echo form_checkbox('device_dvbc', 1, $is_selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('device_dvbc') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="device_ott">DEVICE_OTT</label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="device_ott" class="checkbox"';
        $is_selected = !empty($devices['device_ott']) && $devices['device_ott'] == 1 ? TRUE : FALSE;
        echo form_checkbox('device_ott', 1, $is_selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('device_ott') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="local_storage">Local Storage</label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="local_storage" class="checkbox"';
        $is_selected = !empty($devices['local_storage']) && $devices['local_storage'] == 1 ? TRUE : FALSE;
        echo form_checkbox('local_storage', 1, $is_selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('local_storage') ?></span>
    </div>
</div>
<div class="device_details">
    <div class="form-group">
        <label class="group_first_label" for="PiP">PiP</label>
        <label class="seperator_char">:</label>
        <?php
        $html_attrs = 'id="PiP" class="checkbox"';
        $is_selected = !empty($devices['PiP']) && $devices['PiP'] == 1 ? TRUE : FALSE;
        echo form_checkbox('PiP', 1, $is_selected, $html_attrs);
        ?>
        <span id='error'><?= form_error('PiP') ?></span>
    </div>
</div>
<div class="main_control_btns" class="buttons" style="margin-top:0px;" > 
    <button onclick="history.back();return false;" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-step-backward" style="padding-right:10px;"></span>Back</button>
    <?php
    if (isset($devices['id'])) {
        print '<button type="submit" class="btn btn-success" name="update"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Update Device</button>';
        //print form_submit('update','Update Device');
    } else {
        print '<button type="submit" class="btn btn-success" name="submit"><span class="glyphicon glyphicon-plus-sign" style="padding-right:10px;"></span>Add Device</button>';
        //print form_submit('submit','Create Device');
    }
    ?>
</div>
<? print form_close(); ?>