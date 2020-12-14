<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open('welcome/art_edit');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25,'value'=>$category['a_name']);
echo form_input($data) ."</p>";
echo "<p><label for='description'>Description</label><br/>";
$data = array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40','value'=>$category['a_description']);
echo form_textarea($data) ."</p>";
echo form_hidden('id',$category['a_id']);
echo form_submit('submit','Update Artist');
echo form_close();
?>