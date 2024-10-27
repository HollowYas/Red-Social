<?php

class ejemplo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPrivi()
    {
        $this->db->query('SELECT * FROM privilegios');
        return $this->db->registers();
    }
}