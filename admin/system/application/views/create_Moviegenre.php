<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open('welcome/addMovieGenre');
echo "<p><label for='name'>GenreName</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25);
echo form_input($data) ."</p>";
echo form_hidden('LangID',1);
echo form_submit('submit','Creat Genre');
echo form_close();
?>