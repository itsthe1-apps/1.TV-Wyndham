<?php

/**
 * Created by PhpStorm.
 * User: yeshansachithak
 * Date: 4/25/18
 * Time: 12:22 PM
 */
class Notice
{
    private $CI;
    private $license_validity;
    private $div_status;
    private $txt_msg;
    private $isClientApp = false;//Client App
    private $isDashboard = false;//Admin App

    /**
     * Notice constructor.
     */
    public function __construct()
    {
        //Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->license_validity = "LIFETIME";
        $this->div_status = "none";
        $this->txt_msg = "";
    }

    /**
     * display_html
     */
    private function display_html()
    {
        $html = "";
        $html .= '<script type="text/javascript">function dismiss(el){el.parentNode.style.display="none";};</script>';
        $html .= '<div id="app_status" style="display: ' . $this->div_status . ' !important;position: absolute;width: 100%;height: 90px;background: red;top: 0px;left: 0px;z-index: 99;font-weight:bold;">';
        $html .= '<div id="appCloseBtn" style="display: ' . $this->div_status . ' !important;width: 40px;height: 40px;text-align: center;padding: 10px;color: #fff;cursor: pointer;position: absolute;right: 20px;top: 10px;" onclick="dismiss(this);">x</div>';
        $html .= '<div id="app_message" style="display:' . $this->div_status . ' !important;padding: 16px;font-size: 20px;color: #fff;text-align: center;">' . $this->txt_msg . '</div>';
        $html .= '</div>';
        if ((BLK_ADMIN) && ($this->isDashboard)) {
            if (BLK_MSG) {
                echo $html;
            }
            if ($this->license_validity == "EXPIRED") {
                if (BLK_MSG) {
                    echo $html;
                }
                die();
            }
        }
        if ((BLK_CLIENT) && ($this->isClientApp) && ($this->license_validity == "EXPIRED")) {
            die();
        }
    }

    /**
     * validate_application_status
     */
    private
    function validate_application_status()
    {
        $license_validity = $this->license_validity;
        // echo "validate_application_status :: $license_validity <br/>";
        if ($license_validity) {
            switch ($license_validity) {
                case 'LIFETIME':
                    //
                    break;
                case 'RENEW':
                    $this->div_status = 'block';
                    $this->txt_msg = 'Please note your Annual Maintenance Contract(AMC) is due for renewal. <br/> Contact ITS THE1 SOLUTIONS LLC. Contact Number : 00971 4 551 9963 Email : sales@itsthe1.com';
                    break;
                case 'EXPIRED':
                    $this->div_status = 'block';
                    $this->txt_msg = 'Please note your Annual Maintenance Contract(AMC) has Expired. <br/> Contact ITS THE1 SOLUTIONS LLC. Contact Number : 00971 4 551 9963 Email : sales@itsthe1.com';
                    break;
            }
        }
    }

    /**
     * get_application_status
     */
    private
    function get_application_status()
    {
        $license_validity = $this->license_validity;
        if (APP_HASLIFE) {
            $today = date("Y-m-d");
            //$today = date("2019-06-30");
            $expire_date = date(EXPIRE_DATE);
            $check_date = date("Y-m-d", strtotime(CHECK_EXPIRE, strtotime(EXPIRE_DATE)));
            // echo "today :: $today <br/>";
            // echo "expire_date :: $expire_date <br/>";
            // echo "check_date :: $check_date <br/>";
            if ($today >= $expire_date) {
                $license_validity = "EXPIRED";
            } else {
                if ($today >= $check_date) {
                    $license_validity = "RENEW";
                }
            }
            //if client app only
            if ($this->isClientApp) {
                $expire_date = date("Y-m-d", strtotime("+1 months", strtotime(EXPIRE_DATE)));//+1 months
                // echo "isClientApp :: true <br/>";
                // echo "expire_date :: $expire_date <br/>";
                if ($today >= $expire_date) {
                    $license_validity = "EXPIRED";
                } else {
                    $license_validity = "LIFETIME";
                }
            }
        } else {
            //HAS no LIFE
            $license_validity = "LIFETIME";
        }
        // echo "license_validity :: $license_validity <br/>";
        // die();
        $this->license_validity = $license_validity;
    }

    /**
     * init_notice
     */
    public function init_notice()
    {
        // echo "<pre>";
        // print_r($this->CI->session->all_userdata());
        // echo "</pre>";
        // die();
        // if (!(empty($this->CI->session->userdata('DX_user_id')))) {
        if ($this->CI->session->userdata('DX_user_id')) {
            $this->isDashboard = true;
        } else {
            $segment_1 = $this->CI->uri->segment('1');
            // echo "segment_1 :: $segment_1 <br/>";
            if ($segment_1 != "auth") {
                $this->isClientApp = true;
            }
        }
        $this->get_application_status();
        $this->validate_application_status();
        $this->display_html();
        // if ($this->isDashboard) {
        //     echo "Yes :: isDashboard";
        // } else {
        //     echo "No :: isDashboard";
        // }
        // echo "<br/>";
        // if ($this->isClientApp) {
        //     echo "Yes :: isClientApp";
        // } else {
        //     echo "No :: isClientApp";
        // }
        // echo "<br/>";
    }
}