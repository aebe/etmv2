<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->db->cache_off();
        $this->load->library('session');
    }

    public function processData()
    {
        $username       = $this->security->xss_clean($this->input->post('username'));
        $password       = $this->security->xss_clean($this->input->post('password'));
        $repeatpassword = $this->security->xss_clean($this->input->post('repeatpassword'));
        $email          = $this->security->xss_clean($this->input->post('email'));
        $apikey         = (int) $this->security->xss_clean($this->input->post('apikey'));
        $vcode          = $this->security->xss_clean($this->input->post('vcode'));
        $reports        = $this->security->xss_clean($this->input->post('reports'));

        $this->load->model('Register_model');
        $result = $this->Register_model->validate($username, $password, $repeatpassword, $email, $apikey, $vcode, $reports);

        if (!isset($result['username']) && !isset($result['password']) && !isset($result['email']) && !isset($result['api']) && !isset($result['reports'])) {
            $this->load->model('Register_model');
            $result = $this->Register_model->getCharacters($apikey, $vcode);

            $data['characters'] = $result;
            $data['view']       = "register/register_characters_v";
            $data['apikey']     = $apikey;
            $data['vcode']      = $vcode;
            $data['no_header']  = 1;
            $this->load->view('main/_template_v', $data);
        } else {
            $data['result']    = $result;
            $data['view']      = "register/register_v";
            $data['no_header'] = 1;
            $this->load->view('main/_template_v', $data);
        }

    }

    public function processCharacters()
    {
        $this->load->model('register_model');

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $email    = $this->security->xss_clean($this->input->post('email'));
        $apikey   = (int) $this->security->xss_clean($this->input->post('apikey'));
        $vcode    = $this->security->xss_clean($this->input->post('vcode'));
        $reports  = $this->security->xss_clean($this->input->post('reports'));

        $chars = array();

        if ($char1 = $this->security->xss_clean($this->input->post('char1'))) {
            array_push($chars, $char1);
        } else {
            $char1 = "";
        }

        if ($char2 = $this->security->xss_clean($this->input->post('char2'))) {
            array_push($chars, $char2);
        } else {
            $char2 = "";
        }

        if ($char3 = $this->security->xss_clean($this->input->post('char3'))) {
            array_push($chars, $char3);
        } else {
            $char3 = "";
        }

        //no characters selected
        if (count($chars) == 0) {
            $characters         = $this->register_model->getCharacters($apikey, $vcode);
            $data['characters'] = $characters;
            buildMessage("error", Msg::NO_CHARACTER_SELECTED, "register/register_characters_v");
            $data['view']      = "register/register_characters_v";
            $data['no_header'] = 1;
            $this->load->view('main/_template_v', $data);
            return;
        }

        if ($this->register_model->verifyCharacters($chars, $apikey, $vcode)) {
            $result = $this->register_model->createAccount($username, $password, $email, $apikey, $vcode, $reports, $chars);
            if ($result != "ok") {
                $data['message']    = $result;
                $data['notice']     = "error";
                $data['characters'] = $this->register_model->getCharacters($apikey, $vcode);
                $data['view']       = "register/register_characters_v";
                $data['no_header']  = 1;
                $this->load->view('main/_template_v', $data);
            } else {
                $data['message']   = Msg::ACCOUNT_CREATE_SUCCESS;
                $data['notice']    = "success";
                $data['view']      = "login/login_v";
                $data['no_header'] = 1;
                $this->load->view('main/_template_v', $data);
            }
        }
    }
}
