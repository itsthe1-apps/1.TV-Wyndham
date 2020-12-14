<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open_multipart('welcome/addepg');
echo "<p><label for='channel'>Select a channel</label><br/>".form_dropdown('Id',$channels)."</p>";
echo "<p><label for='path'>Path</label><br/>";
$data = array('name'=>'path','id'=>'path','size'=> 70);
echo form_input($data) ."</p>";
echo form_submit('submit','Create Epg');
echo form_close();
?>