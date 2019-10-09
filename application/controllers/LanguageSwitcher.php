<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageSwitcher extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function switchLang($language = "")
    {
        $toLang = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $toLang);

        redirect(filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    }
}
