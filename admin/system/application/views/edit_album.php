<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open('welcome/alb_edit');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25,'value'=>$category['al_name']);
echo form_input($data) ."</p>";
echo " <p><label for='artist'>Artist</label><br/> ";
echo form_dropdown('a_id',$Artist,$artist['a_id']) ." </p> ";
echo " <p><label for='genre'>Genre</label><br/> ";
echo form_dropdown('g_id',$Genre,$genre['g_id']) ." </p> ";
echo "<p><label for='description'>Description</label><br/>";
$data = array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40','value'=>$category['al_description']);
echo form_textarea($data) ."</p>";
echo form_hidden('id',$category['al_id']);
echo form_submit('submit','Update Album');
echo form_close();
?>