<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open('welcome/addartist');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25);
echo form_input($data) ."</p>";
echo "<p><label for='description'>Description</label><br/>";
$data = array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40');
echo form_textarea($data) ."</p>";
echo form_submit('submit','Creat Artist');
echo form_close();
?>