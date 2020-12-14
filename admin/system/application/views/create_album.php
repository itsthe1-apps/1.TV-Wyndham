<h1><?php echo $title; ?></h1>
<?php
echo $this->validation->error_string;
echo form_open('welcome/addalbum');
echo "<p><label for='name'>Name</label><br/>";
$data = array('name' => 'name', 'id' => 'name', 'size' => 25);
echo form_input($data) . "</p>";
echo " <p><label for='artist'>Artist</label><br/> " . form_dropdown('a_id', $artist) . "</p>";
echo " <p><label for='genre'>Genre</label><br/> " . form_dropdown('g_id', $genre) . "</p>";
echo "<p><label for='description'>Description</label><br/>";
$data = array('name' => 'description', 'id' => 'description', 'rows' => 5, 'cols' => '40');
echo form_textarea($data) . "</p>";
echo form_submit('submit', 'Creat Album');
echo form_close();
?>