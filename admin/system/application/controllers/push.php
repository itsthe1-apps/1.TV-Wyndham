<?php

class Push extends Controller {

    var $path = '';

    function Push() {
        parent::Controller();
        //$this->load->library('DX_Auth');
        $this->load->helper('url');
        //$this->dx_auth->check_uri_permissions();
        $this->load->model('push/Push_model');
        $this->path = 'push/';
    }

    function index($id = false) {
        //$data['model'] = $this->Push_model->get_data();
        //$data['guest_id'] = $id;
       // $data['main'] = $this->path . 'sample';
       // $this->load->view($this->path . 'template', $data);
    }

    function data_reload($id = 0, $device = 0) {
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
        header("Connection: keep-alive");
        
        $this->load->model('WebService');
        
          $counter=0;
          $weather_counter=0;
          while (true) 
          {
            if($counter>=360) //I have set push timer to 5sec , so 5*360=1800=30 minutes
            $counter=0;
            
            if($weather_counter>=8640) //I have set push timer to 12Hrs , so 8640*5=43200=12 Hours
            $weather_counter=0;
            
            $flag = $this->WebService->get_flag_api();
            $result = $this->Push_model->get_guestSTBStatus($device);
            if($result==true)
            $flag[0]['need_restart']="yes";
            else
            $flag[0]['need_restart']="no";

            $message = $this->WebService->getUserMessage($id);
            $flag[0]['message']="no";
            if ($message>0)
            $flag[0]['message'] = "yes"; // 200 being the HTTP response code

           
            
            $flag[0]['tape'] = "no"; 
            if($counter==0)  // call tape data each 30 min based on the counter
            {
                $flag[0]['tape'] = "yes"; 
            }
            
            $flag[0]['weather'] = "no"; 
            if($weather_counter==0)  // call tape data each 30 min based on the counter
            {
                $flag[0]['weather'] = "yes"; 
            }
            
            $flag[0]['alarm'] = "no";
            if ($id > 0) {
            $alarm = $this->WebService->getUserAlarm($id);
            if (count($alarm)>0)
                $flag[0]['alarm'] = $alarm[0]['udp'];            
            }

            $flag[0]['exit'] = 0; 
            $rows = $this->WebService->getRoomExit();
            if (count($rows)>0)
                 $flag[0]['exit'] = $rows[0]['status'];
            
            $flag[0]['counter'] = $counter;
            $flag[0]['wcounter'] = $weather_counter;
            $data['data']= json_encode($flag[0]);
            //echo "id: $lastId\n";
            echo "data:". $data['data'] ."\n\n";
            ob_flush();
            flush();
            $counter++;
            $weather_counter++;
             // Check that lastId is not larger than the size of array - if it is larger close connection.
             /*jk if ($lastId >= 10) {
                  die();
              }*/
             sleep(HTML_PUSH_SLEEP);
        }

        /*
          $this->load->model('WebService');
          $flag = $this->WebService->get_flag_api();
          $result = $this->Push_model->get_guestSTBStatus($device);
          if($result==true)
          $flag[0]['need_restart']="yes";
          else
          $flag[0]['need_restart']="no";

          $message = $this->WebService->getUserMessage($id);
          $flag[0]['message']="no";
          if ($message>0)
          $flag[0]['message'] = "yes"; // 200 being the HTTP response code

          $data['data']= json_encode($flag[0]);
          //$this->firephp->log($data['data']);


          $data['main'] = $this->path . 'data_reload';
          $this->load->view($this->path . 'template', $data);
         * 
         */
    }

    function guest_restart($id = 0) {

        $need_restart = "no";
        $id = $id;
        $result = $this->Push_model->get_guestSTBStatus($id);

        if ($result) {
            $need_restart = "yes";
            $this->Push_model->update_guestSTBStatus($id, 0);
        }
        $data['need_restart'] = $need_restart;
        $data['main'] = $this->path . 'guest_restart';
        $this->load->view($this->path . 'template', $data);
    }

    function user_reload($id = 0) {
        $id = $id;
        $this->load->model('WebService');

        if ($id > 0) {
            $flag = $this->WebService->get_userflag_api($id);
            if (!empty($flag[0]['date_added'])) {
                $d1 = $flag[0]['date_added'];
            } else {
                $d1 = "no_data";
            }
        } else {
            $d1 = "no_data";
        }

        $data['data'] = $d1;
        $data['listen_type'] = "user_reload";
        $data['main'] = $this->path . 'user_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function userprofile_reload($id = 0) {
        $id = $id;
        $this->load->model('WebService');

        if ($id > 0) {
            $flag = $this->WebService->get_userprofileflag_api($id);
            $d1 = $flag[0]['date_updated'];
        } else {
            $d1 = "no_data";
        }
        $data['data'] = $d1;
        $data['main'] = $this->path . 'userprofile_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function channel_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_channelflag_api();
        $d1 = $flag[0]['tv'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'channel_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function info_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_infoflag_api();
        $d1 = $flag[0]['localinfo'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'info_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function media_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_mediaflag_api();
        $d1 = $flag[0]['promotions'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'media_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function movie_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_movieflag_api();
        $d1 = $flag[0]['vod'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'movie_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function news_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_newsflag_api();
        $d1 = $flag[0]['news'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'news_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function radio_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_radioflag_api();
        $d1 = $flag[0]['radio'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'radio_reload';
        $this->load->view($this->path . 'template', $data);
    }
     function internet_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_internetflag_api();
        $d1 = $flag[0]['internet'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'internet_reload';
        $this->load->view($this->path . 'template', $data);
    }
    

    function rest_reload() {
        $this->load->model('WebService');
        $flag = $this->WebService->get_restflag_api();
        $d1 = $flag[0]['restaurant'];
        $data['data'] = $d1;
        $data['main'] = $this->path . 'rest_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function ttape_reload() {
        $data['data'] = "no_data";
        $data['main'] = $this->path . 'ttape_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function weather_reload() {
        $data['data'] = "no_data";
        $data['main'] = $this->path . 'weather_reload';
        $this->load->view($this->path . 'template', $data);
    }

    function newmessage_checker($id = 0) {
        $id = $id;
        $data['data'] = "no";
        $this->load->model('WebService');

        if ($id > 0) {
            $message = $this->WebService->getUserMessage($id);
            if ($message)
                $data['data'] = "yes"; // 200 being the HTTP response code
            $data['main'] = $this->path . 'newmessage_reload';
            $this->load->view($this->path . 'template', $data);
        }
    }

    function alarm_checker($id = 0) {
        $id = $id;
        $data['data'] = "no";
        $this->load->model('WebService');

        if ($id > 0) {
            $message = $this->WebService->getUserAlarm($id);
            if (count($message)>0)
                $data['data'] = $message[0]['udp']; // 200 being the HTTP response code
            else
                $data['data'] = 0;
            //print $data['data'];
            $data['main'] = $this->path . 'alarm_reload';
            $this->load->view($this->path . 'template', $data);
        }
    }
    
      function exit_checker() {
        header("Content-Type: text/event-stream");
        header("Cache-Control: no-cache");
        header("Connection: keep-alive");
        $this->load->model('WebService');
        while (true) {
        $data['data'] = 0;
            $rows = $this->WebService->getRoomExit();
            if (count($rows)>0)
                $data['data'] = $rows[0]['status']; // 200 being the HTTP response code 
                echo "data:". $data['data'] ."\n\n";
                ob_flush();
                flush();
                sleep(HTML_PUSH_EXIT_SLEEP);
             }
              
        //    $data['main'] = $this->path . 'exit_reload';
        //    $this->load->view($this->path . 'template', $data);
        
    }

}