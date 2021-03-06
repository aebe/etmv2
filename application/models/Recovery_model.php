<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Recovery_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmail(string $username, string $email)
    {
        $this->db->where('username', $username);
        $this->db->where('email', $email);
        $query  = $this->db->get('user');
        $result = $query->row();

        return $result;
    }

    public function getUsernameByEmail(string $email)
    {
        $this->db->select('username');
        $this->db->where('email', $email);
        $query  = $this->db->get('user');
        $result = $query->row();

        return $result;
    }
}
