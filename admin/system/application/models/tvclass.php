<?php

class TVclass extends Model {

    var $set_style = "";
    var $set_css_li = "";
    var $set_css_a = "";

    function TVclass() {
        parent::Model();
        $this->load->helper('url');

        $this->CI = & get_instance();
        $this->guest_alarm = $this->db->dbprefix . 'guest_alarm';
    }

    function Replacechar($string) {
        $string = preg_replace($this->config->item('quotes'), '', $string);
        //$string = preg_replace("/\n\r|\r\n|\n|\r/", "", $string);
        return $string;
    }

    function UnixConvert($timestamp) {
        return date('Y-m-d H:i:s', $timestamp);
    }

    function Unhtmlentities($string) {
        // replace numeric entities
        $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
        $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
        // replace literal entities
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);
        return strtr($string, $trans_tbl);
    }

    function menu($parentmenu = false, $parentmenu_url = false, $childmenu = false, $childmenu_url = false, $current = false) {
        //echo $current;

        if ($childmenu == true) {
            foreach ($childmenu as $key => $value) {
                $is_key_array[] = $key;
            }
        } else {
            $is_key_array[] = "";
        }

        if (count($parentmenu) > 0) {
            for ($i = 0; $i < count($parentmenu); $i++) {
                $replace_char = array(' ', '-', '&');
                $replace_space = strtolower(str_replace($replace_char, "", $parentmenu[$i]));
                //echo $replace_space;
                $selected = $replace_space == strtolower($current) ? "_selected" : "";
                $html = '<li class="menu">';
                $html .= '<ul>';
                $html .= '<li class="button">';
                $html .= '<a href="#" onclick="goURL(\'' . $parentmenu_url[$i] . '\')">';
                $html .= '<div class="roundedcornr_box_main' . $selected . '"><div class="roundedcornr_top_main' . $selected . '"><div></div></div>';
                $html .= '<div class="roundedcornr_content_main' . $selected . '" id="left_menu_text' . $selected . '">' . $parentmenu[$i] . '</div>';
                $html .= '<div class="roundedcornr_bottom_main' . $selected . '"><div></div></div></div>';
                $html .= '</a>';
                $html .= '</li>';
//                $system_array = array(
//                    'AUTH' => array('USER ROLES', ''),
//                );
                if (isset($is_key_array) && count($is_key_array) > 0) {
                    if (in_array($parentmenu[$i], $is_key_array)) {
                        $url_join = $this->uri->segment(1) . '/' . $this->uri->segment(2);
//                        if (in_array($url_join, $childmenu_url['AUTH'])) {
//                            if ($parentmenu[$i] == "AUTH") {
//                                $this->set_style = 'style="display:block;"';
//                                $this->set_css_li = 'style="background:#F58220;"';
//                                $this->set_css_a = 'style="color:#FFF; font-weight:bold;"';
//                            } else {
//                                $this->set_style = "";
//                            }
//                        }
                        if (in_array($url_join, $childmenu_url['ENTITIES'])) {
                            if ($parentmenu[$i] == "ENTITIES") {
                                $this->set_style = 'style="display:block;"';
                                $this->set_css_li = 'style="background:#F58220;"';
                                $this->set_css_a = 'style="color:#FFF; font-weight:bold;"';
                            } else {
                                $this->set_style = "";
                            }
                        }
                        if (in_array($url_join, $childmenu_url['GENRE'])) {
                            if ($parentmenu[$i] == "GENRE") {
                                $this->set_style = 'style="display:block;"';
                                $this->set_css_li = 'style="background:#F58220;"';
                                $this->set_css_a = 'style="color:#FFF; font-weight:bold;"';
                            } else {
                                $this->set_style = "";
                            }
                        }
                        if (in_array($url_join, $childmenu_url['PACKAGES'])) {
                            if ($parentmenu[$i] == "PACKAGES") {
                                $this->set_style = 'style="display:block;"';
                                $this->set_css_li = 'style="background:#F58220;"';
                                $this->set_css_a = 'style="color:#FFF; font-weight:bold;"';
                            } else {
                                $this->set_style = "";
                            }
                        }
                        if (in_array($url_join, $childmenu_url['SETTINGS'])) {
                            if ($parentmenu[$i] == "SETTINGS") {
                                $this->set_style = 'style="display:block;"';
                                $this->set_css_li = 'style="background:#F58220;"';
                                $this->set_css_a = 'style="color:#FFF; font-weight:bold;"';
                            } else {
                                $this->set_style = "";
                            }
                        }
                        $html .= '<li class="dropdown" ' . $this->set_style . '>';
                        $html .= '<ul>';
                        for ($j = 0; $j < count($childmenu[$parentmenu[$i]]); $j++) {

                            $childmenu_url[$parentmenu[$i]][$j] == $url_join ? $set_li = $this->set_css_li : $set_li = '';
                            $childmenu_url[$parentmenu[$i]][$j] == $url_join ? $set_a = $this->set_css_a : $set_a = '';

                            $html .= '<li ' . $set_li . '><a href="' . base_url() . 'index.php/' . $childmenu_url[$parentmenu[$i]][$j] . '" ' . $set_a . '>' . $childmenu[$parentmenu[$i]][$j] . '</a></li>';
                        }
                        $html .= '</ul>';
                        $html .= '</li>';
                    }
                }
                $html .= '</ul>';
                $html .= '</li><br/>';
                print $html;
            }
        }
    }

    function set_image_path($folder_name = false, $image_name = false) {
        if ($folder_name == true) {
            $url = base_url() . "icons/" . $folder_name . "/" . $image_name;
            return $url;
        } else {
            return NULL;
        }
    }

    function update_flag($field = false) {
        $data = array($field => date('Y-m-d H:i:s'));
        $flag = $this->CI->config->item($this->CI->db->dbprefix . 'flag');
        $this->CI->db->update($flag, $data);
    }

    function current_date() {
        $date = date('Y-m-d H:i:s');
        return $date;
    }

    function _create_thumbnail($fileName, $path) {
        $this->CI->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path . $fileName;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = $this->CI->config->item('thumb_maintain_ratio');
        $config['width'] = $this->CI->config->item('thumb_width');
        $config['height'] = $this->CI->config->item('thumb_height');
        $config['new_image'] = $path . $fileName;
        $this->CI->image_lib->initialize($config);
        if (!$this->CI->image_lib->resize()) {
            //echo $this->image_lib->display_errors();
        }
    }

    function get_thumb_filename($file) {
        $info = pathinfo($file);
        $file_name = basename($file, '.' . $info['extension']);
        return $file_name . '_thumb.' . $info['extension'];
    }

    function unicode_conv($originalString) {
        $replacedString = preg_replace("/\\\\u([0-9abcdef]{4})/", "&#x$1;", $originalString);
        $unicodeString = mb_convert_encoding($replacedString, 'UTF-8', 'HTML-ENTITIES');
        return $unicodeString;
    }

    function language_dp($name, $selected = false, $attributes = false) {
        $this->language = $this->db->dbprefix . 'language';
        $this->db->orderby('short_label', 'asc');
        $query = $this->db->get($this->language);
        if ($query->num_rows() > 0) {
            $html = '<select name="' . $name . '" class="language form-control select_form_option" style="width:150px;display: inline;"' . $attributes . '>';
            foreach ($query->result() as $row) {
                if ($selected == false) {
                    $selected = $this->config->item('system_lang');
                }

                if ($selected == true && is_array($selected)) {
                    if (array_key_exists($row->short_label, $selected)) {
                        $s = 'selected="selected"';
                    } else {
                        $s = '';
                    }
                } else {
                    $s = $row->short_label == $selected ? 'selected="selected"' : '';
                }

                $html.= '<option value="' . $row->short_label . '" ' . ($s) . '>' . $row->desc . '</option>';
            }
            $html.= '</select>';
            return $html;
        }
    }

    function wakeup_message() {
        $this->db->where('status', 0);
        $query = $this->db->get($this->guest_alarm);
        return $query;
    }

}

?>