<h1><?php echo $title; ?></h1>
<?php
$text_area_length = 250;
print form_open('newsmenu/addnews');

$title = array('name' => 'title', 'id' => 'title','class' => 'form-control', 'size' => 25, 'value' => $this->input->post('title'));
$summary = array('name' => 'summary', 'id' => 'summary', 'rows' => 6, 'cols' => 60, 'value' => $this->input->post('summary'), 'maxlength' => $text_area_length, 'onkeyup' => 'return ismaxlength(this)');
$full_news = array('name' => 'fullnews', 'id' => 'fullnews','class' => 'form-control', 'rows' => 10, 'cols' => 60, 'value' => $this->input->post('fullnews'));

$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0' class='table'>";

$table.="<tr>";
$table.="<td width='20%'><label for='name'>Language </label><span class='star'> * </span></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>";
$table.= $this->TVclass->language_dp('language', isset($_POST['language']) ? $_POST['language'] : $this->session->userdata($session_keyword));
$table.="</td>";
$table.="<td><span id='error'>" . form_error('language') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='20%'><label for='name'>Title</label><span class='star'> * </span></td>";
$table.="<td width='5%'>:</td>";
$table.="<td width='20%'>" . form_input($title) . "</td>";
$table.="<td><span id='error'>" . form_error('title') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td width='20%' valign='top'><label for='name'>Summary</label><span class='star'> * </span></td>";
$table.="<td width='5%' valign='top'>:</td>";
$table.="<td width='20%' valign='top'>" . form_textarea($summary) . "<br/>(Max length $text_area_length characters)</td>";
$table.="<td valign='top'><span id='error'>" . form_error('summary') . "</span></td>";
$table.="</tr>";

$table.="<tr style='display:none'>";
$table.="<td width='20%' valign='top'><label for='name'>Full News</label><span class='star'> * </span></td>";
$table.="<td width='5%' valign='top'>:</td>";
$table.="<td width='20%' valign='top'>" . form_textarea($full_news) . "</td>";
$table.="<td valign='top'><span id='error'>" . form_error('fullnews') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="btn btn-danger">Back</button>
&nbsp;&nbsp;<button type="submit" class="btn btn-success" name="submit">Create News</button></div></td>';
$table.="</tr>";

$table.= "</table>";

print $table;

print form_hidden('dateadded', date('Y-m-d H:i:s'));

print form_close();
?>