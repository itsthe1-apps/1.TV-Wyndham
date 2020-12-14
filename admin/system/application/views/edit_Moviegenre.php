<h1><?php echo $title;?></h1>
<?php
echo $this->validation->error_string;
echo form_open('welcome/editMovieGenre');
echo "<p><label for='name'>GenreName</label><br/>";
$data = array('name'=>'name','id'=>'name','size'=> 25,'value'=>$category['Category']);
echo form_input($data) ."</p>";
echo form_hidden('id',$category['Id']);
echo form_submit('submit','Update Genre');
echo form_close();
?>