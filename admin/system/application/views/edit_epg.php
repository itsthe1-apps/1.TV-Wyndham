<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open_multipart('welcome/editepg');
echo "<p><label for='channel'>Select a channel</label><br/>".form_dropdown('Id',$channels,set_value('Id',$channel['id']))."</p>";
echo "<p><label for='path'>Path</label><br/>";
$data = array('name'=>'path','id'=>'path','size'=> 70,'value'=>$category['path']);
echo form_input($data) ."</p>";echo form_hidden('id',$category['id']);
echo form_submit('submit','Update epg');
echo form_close();
?>