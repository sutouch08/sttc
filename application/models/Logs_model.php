<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logs_model extends CI_Model
{
		public $logs;

    public function __construct()
    {
        parent::__construct();
    }


		public function log_transfer($ds)
    {
      return $this->db->insert('logs_transfer', $ds);
    }


		public function log_scs($ds)
		{
			return $this->db->insert('logs_scs', $ds);
		}

} //---
