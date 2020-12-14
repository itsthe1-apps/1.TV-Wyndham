<h1><?php echo $title; ?></h1>
<span class="star" style="padding-left:0px;">* Mandatory fields</span>
<?php
//Ckeditor's configuration
		$ckeditor = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'description',
			'path'	=>	'js/ckeditor',
		
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"450px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
			),
		
			//Replacing styles from the "Styles tool"
			'styles' => array(
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Blue',
						'font-weight' 		=> 	'bold'
					)
				),
				
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 		=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 			=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		);
$attributes = array('name' => 'myform','autocomplete'=>'off');

$upload_file_error = !empty($upload_file_error) ? $upload_file_error : "";

echo form_open_multipart($this->uri->uri_string(), $attributes);

$data_name = array('name' => 'name', 'id' => 'name', 'size' => 25, 'value'=>isset($rest_menu['name']) ? $rest_menu['name'] : $this->input->post('name'));

$data_icon = array('name' => 'image', 'id' => 'image','value'=>$this->input->post('image'));

$data_description = array('name' => 'description', 'id' => 'description', 'rows' => 5, 'cols' => '40', 'value' => isset($rest_menu['description']) ? html_entity_decode($rest_menu['description']) : html_entity_decode($this->input->post('description')));

if(isset($rest_menu['image'])){
	$file	= $rest_menu['image'];
	print form_input(array('name'=>'file_img_name','type'=>'hidden', 'value'=>$file));
}


$table = "<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

$opt_menutype[''] = 'Select';
if(count($menu_type)>0){
	foreach($menu_type as $mt){
		$opt_menutype[$mt->id] = $mt->name;
	}
}

$opt_restaurant[''] = 'Select';
if(count($restaurant)>0){
	foreach($restaurant as $rt){
		$opt_restaurant[$rt->id] = $rt->name;
	}
}

$table.="<tr>";
$table.="<td width='30%'><label for='name'>Type</label><span class='star'> * </span></td>";
$table.="<td width='10%'>:</td>";
$table.="<td width='30%'><div id='result'>".form_dropdown('type',$opt_menutype,isset($rest_menu['type']) ? $rest_menu['type'] : $this->input->post('type'))."</div></td>";
$table.="<td width='30%'><span id='error'>".form_error('type')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Name</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input($data_name) . "</td>";
$table.="<td><span id='error'>" . form_error('name') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Price</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>" . form_input('price',isset($rest_menu['price']) ? str_replace(' AED','',$rest_menu['price']) : $this->input->post('price')) . " AED</td>";
$table.="<td><span id='error'>" . form_error('price') . "</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Restaurant</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_dropdown('restaurant',$opt_restaurant,isset($rest_menu['restaurant']) ? $rest_menu['restaurant'] : $this->input->post('restaurant'))."</td>";
$table.="<td><span id='error'>".form_error('restaurant')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>To Date</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_input('to_date',isset($rest_menu['to_date']) ? $rest_menu['to_date'] : $this->input->post('to_date'))." (2012-04-21)</td>";
$table.="<td><span id='error'>".form_error('to_date')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='name'>Menu Order</label><span class='star'> * </span></td>";
$table.="<td>:</td>";
$table.="<td>".form_input('menu_order',isset($rest_menu['menu_order']) ? $rest_menu['menu_order'] : $this->input->post('menu_order'),'size=3')."</td>";
$table.="<td><span id='error'>".form_error('menu_order')."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td><label for='icon'>Image <font>(Width=".$image_width_menu.", Height=".$image_height_menu.")</font></label><span class='star'> * </span></td>";
$table.="<td>:</td>";

isset($rest_menu['image']) ? $st_img = "<img  width='50' src='".$this->config->item('rest_icon_url').$rest_menu['image']."' align='right'>" : $st_img = "";

$table.="<td>" . form_upload($data_icon) . "&nbsp;&nbsp;$st_img</td>";
$table.="<td><span id='error'>".$upload_file_error."</span></td>";
$table.="</tr>";

$table.="<tr>";
$table.="<td valign='top'><label for='description'>Description</label><span class='star'> * </span></td>";
$table.="<td valign='top'>:</td>";
$table.="<td>" . form_textarea($data_description) . display_ckeditor($ckeditor). "</td>";
$table.="<td><span id='error'>" . form_error('description') . "</span></td>";
$table.="</tr>";

if($task == "update"){
	$table.="<tr>";
$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="update"><img src="' . base_url() . 'images/apply2.png" alt=""/>Update</button></div></td>';
$table.="</tr>";
}else{
	$table.="<tr>";
	$table.='<td colspan="4"><br/><div class="buttons"><button onclick="history.back();return false;" class="positive"><img src="' . base_url() . 'images/cross.png" alt=""/>Back</button><button type="submit" class="positive" name="submit"><img src="' . base_url() . 'images/apply2.png" alt=""/>Create</button></div></td>';
	$table.="</tr>";
}
$table.="</table>";

print $table;

echo form_close();
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#language').live('change', function(){
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>index.php/restaurants/ajax_menutype",
			data: {
				language : $(this).val(),
				selected : '<?=isset($rest_menu['type']) ? $rest_menu['type'] : $this->input->post('type')?>'
			},
			dataType: 'html',
			beforeSend: function() {
						
			},
			complete: function() {
						
			},
			success: function(data, textStatus){
				$('#result').html(data);
				//alert(data);
			}
		});
	});
	$('#language').trigger('change');
});
</script>