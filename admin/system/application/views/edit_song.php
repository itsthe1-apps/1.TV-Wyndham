<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open_multipart('welcome/song_edit');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25, 'value'=>$category['name']);
echo form_input($data) ."</p>";
echo " <p><label for='artist'>Artist</label><br/> ". form_dropdown('a_id',$Artist,$artist['a_id'])."</p>";
echo " <p><label for='genre'>Genre</label><br/> ". form_dropdown('g_id',$Genre,$genre['g_id'])."</p>";
echo " <p><label for='album'>Album</label><br/> ". form_dropdown('al_id',$Album,$album['al_id'])."</p>";
echo "<p><label for='icon'>Icon</label><br/>";
$data = array('name'=> 'icon','id'=> 'icon');
echo form_upload($data) ." <img  width='50' src=".base_url()."uploads/song/".$category['icon'].">"."</p>";
/*echo "<p><label for='icon'>Icon</label><br/>";
$data = array('name'=>'icon','id'=>'icon','size'=> 25,'value'=>$category['icon']);
echo form_input($data) ."</p>";*/
echo "<p><label for='path'>Path</label><br/>";
$data = array('name'=>'path','id'=>'path','size'=> 25,'value'=>$category['path']);
echo form_input($data) ."</p>";
echo "<p><label for='description'>Description</label><br/>";
$data = array('name'=>'description','id'=>'description','rows'=> 5, 'cols'=>'40','value'=>$category['description']);
echo form_textarea($data) ."</p>";
echo form_hidden('id',$category['id']);
echo form_submit('submit','Update Song');
echo form_close();
?>