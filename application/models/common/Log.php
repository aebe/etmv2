<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addEntry(string $type, int $id_user)
    {
        $data = ["type"        => $type,
                 "user_iduser" => $id_user];

        $this->db->insert('log', $data);
    }

}
