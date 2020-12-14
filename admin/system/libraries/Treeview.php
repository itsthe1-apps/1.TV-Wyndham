<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Unlimited level node array
 * example of array garnered from eg table below
 * Array ( 
    [0] => Array ( 
        [id] => 1 [name] => welcome [nodelevel] => 1 
            [children] => Array ( 
                [0] => Array ( [id] => 4 [name] => more welcome [nodelevel] => 2 [children] => ) ) ) 
    [1] => Array ( 
        [id] => 2 [name] => about us [nodelevel] => 1 [children] => ) 
    [2] => Array ( 
        [id] => 3 [name] => contact [nodelevel] => 1 [children] => ) 

+------+------------------+---------+-------------+ 
|  id  |      name        |  p_id   | section_id  |
+------+------------------+---------+-------------+
|  1   |    welcome       |   0     |      1      |
+------+------------------+---------+-------------+ 
|  1   |    about us      |   0     |      1      |
+------+------------------+---------+-------------+ 
|  1   |    contact       |   0     |      1      |
+------+------------------+---------+-------------+ 
|  1   |  more welcome    |   1     |      1      |
+------+------------------+---------+-------------+ 

@param section_id - site has multiple sections each with its own menu list
@param p_id -  parent id, the first level of each section has a parent id of 0


Separated building the html from the node array collection itself 
so I could employ other menu trees more easily if required and also check 
in a straigntforward way if the array was gathering the information correctly
 by testing via print_r()

The node collection is recursive but with a check (hasChildren)
to see if the recursion is necessary

$this->load->library('treeview');
//set section id
$this->treeview->section_id = $section_id;
//call the menu
$data = $this->treeview->buildmenu();
*/

class CI_Treeview 
{

    public $section_id = 1;
    private $nodesql = "SELECT * FROM tabs ";
    private $anchor = "/index.php/node/id/"; 
    private $orderby = " order by id";  
    
    function __construct()
    {
        $this->obj =& get_instance();
    }
    
    // built specifically for silver stripe tree menu
    public function buildmenu()
    {
        // get the nodes array starting with the parent one
        $menu_array = $this->get_menu_nodes();
        
        $html='';
        foreach ($menu_array as $menu)
        {
            if ($this->obj->dx_auth->is_logged_in())
			{
				if ($this->hasChildren($menu['id']))
				{

					
					$html.="<li><a href='". $menu['url'] ."'><span class='menu_left'><span class='menu_right'><span class='myhover'>".$menu['name']."</span></span></span></a>\n<ul class='sf-menu'>\n";
					
					$childarray = $menu['parent_id'];
					
					foreach ( $childarray as $child)
					{
						if($this->hasChildren($child['id']))
						{	
							$html.="<li><a href='".$child['url']."'><span class='menu_left'><span class='menu_right'><span class='myhover'>".$child['name']."</span></span></span></a>\n<ul class='sf-menu'>\n";
							
							$childarray2 = $child['parent_id'];
								foreach ( $childarray2 as $child2)
								{
									$exp = explode("/",$child2['url']);
									$uri = "";
									if(count($exp, COUNT_RECURSIVE)!=1)
									{
										$uri = $exp[2];
									}
									
									$this->obj->uri->segment(2)==$uri ? $switch="_selected" : $switch="";
									
									$html.="<li><a href='".base_url()."index.php".$child2['url']."'><span class='menu_left$switch'><span class='menu_right$switch'><span class='myhover$switch'>".$child2['name']."</span></span></span></a></li>\n";
								}
								$html.= "</li>\n</ul>\n";
							
						}else{
							$exp = explode("/",$child['url']);
							$uri = "";
							if(count($exp, COUNT_RECURSIVE)!=1)
							{
								$uri = $exp[2];
							}
							
							$this->obj->uri->segment(2)==$uri ? $switch="_selected" : $switch="";
														
							$html.="<li><a href='".base_url()."index.php".$child['url']."'><span class='menu_left$switch'><span class='menu_right$switch'><span class='myhover$switch'>".$child['name']."</span></span></span></a></li>\n";
						}					
					}
					
					$html.= "</li>\n</ul>\n";
				
				} else {
					
					// Highlight selected menu
					$exp = explode("/",$menu['url']);
					$uri = "";
					if(count($exp, COUNT_RECURSIVE)!=1)
					{
						$uri = $exp[2];
					}
					
					$this->obj->uri->segment(2)==$uri ? $switch="_selected" : $switch="";
															
					$html.="<li><a href='".base_url()."index.php".$menu['url']."'><span class='menu_left$switch'><span class='menu_right$switch'><span class='myhover$switch'>".$menu['name']."</span></span></span></a></li>\n";
				}
			}else{
				if($menu['is_main']==1)
				{
					$this->obj->uri->segment(1)=="" ? $switch_home="_selected" : $switch_home="";
					
					$html.="<li><a href='".base_url()."index.php".$menu['url']."'><span class='menu_left$switch_home'><span class='menu_right$switch_home'><span class='myhover$switch_home'>".$menu['name']."</span></span></span></a></span></li>\n";
				}
			}
        }
		$this->obj->uri->segment(2)=="login" ? $switch_log="_selected"  : $switch_log="";
		
        $this->obj->dx_auth->is_logged_in() ? $html.="<li><a href='".base_url()."index.php/auth/logout'><span class='menu_left$switch_log'><span class='menu_right$switch_log'><span class='myhover$switch_log'>LOGOUT</span></span></span></a></li>" : $html.="<li><span><a href='".base_url()."index.php/auth/login'><span class='menu_left$switch_log'><span class='menu_right$switch_log'><span class='myhover$switch_log'>LOGIN</span></span></span></a></li>";
        return $html;
    }
    
    //starts the gathering the section's parent nodes
    function get_menu_nodes()
    {
        $sql = "$this->nodesql ";
        
        // First get top level nodes i.e. parent id = 0
        $sql .= " WHERE parent_id = 0";
                
        $sql .= $this->orderby;
        
        $result = $this->build_menu_array($sql);
        return $result;
    }
    
    //called if required by build_menu_array
    //@param pid = collects nodes with this parent id
    function get_child_nodes($pid)
    {
        // just get top level nodes initially
        $sql = "$this->nodesql
                WHERE parent_id = $pid order by parent_order asc";
        $result = $this->build_menu_array($sql);
        return $result;
    }
         
    //the recursive menu 'engine'
    function build_menu_array($sql)
    {
        
    $query = $this->obj->db->query($sql);
    
    foreach ($query->result_array() as $row)
        {
            $node_items = array();
            $node_items['id'] = $row['id'];
            $node_items['name'] = $row['name'];
            $node_items['parent_id'] = $row['parent_id'];   
			$node_items['url'] = $row['url'];
			$node_items['is_main'] = $row['is_main']; 
            
            // if the node has children get them now - recursive
            // store in in children array
           if ($this->hasChildren($row['id']))
           {   
               $children = $this->get_child_nodes($row['id']);           
               $node_items['parent_id'] = $children;           
           } else {
               $node_items['parent_id'] = '';
           }
           $node_array[] = $node_items;
        }                  
        return $node_array;
    }


    function hasChildren($id)
    {
        $bool = FALSE;
        $sql = "Select * from tabs where parent_id = $id";
        $query = $this->obj->db->query($sql);
        
        if ($query->num_rows() > 0) $bool = TRUE;
        
        return $bool;
    }


}
?>