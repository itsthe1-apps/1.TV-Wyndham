<h1><?php echo $title;?></h1>
<?php
$text_area_length = 250;
/**
echo $this->validation->error_string;
echo form_open_multipart('welcome/editnews');
echo "<p><label for='title'>Title</label><br/>";
$data = array('name'=>'title','id'=>'title','size'=> 25,'value'=>$category['title']);
echo form_input($data) ."</p>";
echo "<p><label for='summary'>Summary</label><br/>";
$data = array('name'=>'summary','id'=>'summary','rows'=> 3,'value'=>$category['summary']);
echo form_textarea($data) ."</p>";
echo "<p><label for='fullnews'>FullNews</label><br/>";
$data = array('name'=>'fullnews','id'=>'fullnews','rows'=> 7,'value'=>utf8_decode($category['fullnews']));
echo form_textarea($data) ."</p>";
$date=date('Y-m-d H:i:s');
echo form_hidden('dateadded',$date);
echo form_hidden('id',$category['id']);
echo form_submit('submit','Update news');
echo form_close();
**/
print form_open('newsmenu/editnews');

$title 		= array('name'=>'title','id'=>'title','class' => 'form-control','size'=> 25, 'value'=>$category['title']!="" ? $category['title'] : $this->input->post('title'),'maxlength'=>100);
$summary	= array('name'=>'summary','id'=>'summary','class' => 'form-control','rows'=> 6,'cols'=>60, 'value' =>$category['summary'] ? $category['summary'] : $this->input->post('summary'),'maxlength'=>$text_area_length,'onkeyup'=>'return ismaxlength(this)');
$full_news  = array('name'=>'fullnews','id'=>'fullnews','rows'=> 10, 'cols'=>80, 'value' =>$category['fullnews'] ? utf8_decode($category['fullnews']) : $this->input->post('fullnews'));	

$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0' class='table'>";

$table.="<tr>";
$table.="<td width='20%'><label for='name'>Language </label><span class='star'> * </span></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>";
$table.= $this->TVclass->language_dp('language',isset($_POST['language']) ? $_POST['language'] : $category['language']);
$table.="</td>";
$table.="<td><span id='error'>".form_error('language')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130'><label for='name'>Title</label><span class='star'> * </span></td>";
$table.="<td width='30'>:</td>";
$table.="<td width='150'>".form_input($title)."</td>";
$table.="<td><span id='error'>".form_error('title')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='130' valign='top'><label for='name'>Summary</label><span class='star'> * </span></td>";
$table.="<td width='30' valign='top'>:</td>";
$table.="<td width='150' valign='top'>".form_textarea($summary)."<br/>(Max length $text_area_length characters)</td>";
$table.="<td valign='top'><span id='error'>".form_error('summary')."</span></td>";
$table.="</tr>";


$table.="<tr style='display:none;'>";
$table.="<td width='130' valign='top'><label for='name'>Full News</label><span class='star'> * </span></td>";
$table.="<td width='30' valign='top'>:</td>";
$table.="<td width='150' valign='top'>".form_textarea($full_news)."</td>";
$table.="<td valign='top'><span id='error'>".form_error('fullnews')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="btn btn-danger">Back</button>
&nbsp;&nbsp;<button type="submit" class="btn btn-primary" name="submit">Update News</button></div></td>';
$table.="</tr>";

$table.= "</table>";

print $table;

$date=date('Y-m-d H:i:s');
echo form_hidden('dateadded',$date);
echo form_hidden('id',$category['id']);

print form_close();
?>