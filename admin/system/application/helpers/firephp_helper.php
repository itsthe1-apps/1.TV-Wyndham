<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Firephp helper
 * 
 */
require_once APPPATH . 'libraries/FirePHPCore/firephp.class.php'; // path to your firephp libs

/*
 * fire_output
 */

function fire_print($type, $msg, $optional_label = '')
{
    //output only when on development environtment. set on index.php
    if (ENVIRONMENT == 'development')
    {

        $firephp = FirePHP::getInstance(true);
        
        if($type=="json"){
           $type = 'info';
           $msg = json_decode($msg);
        }
        
        $firephp->$type($msg, $optional_label);
    }
}

function fire_trace($trace_label = '')
{
    //output only when on development environtment. set on index.php
    if (ENVIRONMENT === 'development')
    {
        $firephp = FirePHP::getInstance(true);
        $firephp->trace($trace_label);
    }
}

/* End of file fire_debug_helper.php */
/* Location: ./application/helpers/seo_helper.php */