<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open_multipart('welcome/addgame');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25);
echo form_input($data) ."</p>";
echo "<p><label for='description'>Description</label><br/>";
$data = array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40');
echo form_textarea($data) ."</p>";
echo "<p><label for='icon'>Icon</label><br/>";
$data = array('name'=> 'icon','id'=> 'icon');
echo form_upload($data) ."</p>";
/*echo "<p><label for='icon'>Icon</label><br/>";
$data = array('name'=>'icon','id'=>'icon','size'=> 25);
echo form_input($data) ."</p>";*/
echo "<p><label for='path'>Path</label><br/>";
$data = array('name'=>'path','id'=>'path','size'=> 25);
echo form_input($data) ."</p>";
echo "<p><label for='year'>Year</label><br/>";
$data = array('name'=>'year','id'=>'year','size'=> 25);
echo form_input($data) ."(year formate\"Y-m-d H:i:s\")</p>";
echo "<p><label for='dateadded'>DateAdded</label><br/>";
$data = array('name'=>'dateadded','id'=>'dateadded','size'=> 25);
echo form_input($data) ."(year formate\"Y-m-d H:i:s\")</p>";
echo form_submit('submit','Creat Game');
echo form_close();
?>