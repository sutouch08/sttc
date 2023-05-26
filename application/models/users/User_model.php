<?php
class User_model extends CI_Model
{
	private $tb = "user";

  public function __construct()
  {
    parent::__construct();
  }



  public function add(array $data = array())
  {
    if(!empty($data))
    {
      $rs = $this->db->insert($this->tb, $data);

			if($rs)
			{
				return $this->db->insert_id();
			}
    }

    return FALSE;
  }




  public function update($id, array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->where('id', $id)->update($this->tb, $ds);
    }

    return FALSE;
  }



  public function delete($id)
  {
    return $this->db->where('id', $id)->delete($this->tb);
  }



  public function get($id)
  {
		$this->db
		->select('u.*, u.name AS display_name, g.name AS group_name, t.name AS team_name')
		->select('tg.name AS team_group_name')
		->from('user AS u')
		->join('user_group AS g', 'u.ugroup = g.id', 'left')
		->join('team AS t', 'u.team_id = t.id', 'left')
		->join('team_group AS tg', 'u.team_group_id = tg.id', 'left');

    $rs = $this->db->where('u.id', $id)->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_user_by_uid($uid)
  {
		$this->db
		->select('u.*, u.name AS display_name, g.name AS group_name, t.name AS team_name')
		->select('tg.name AS team_group_name, tg.fromWhsCode, tg.toWhsCode')
		->select('fw.name AS from_warehouse_name, tw.name AS to_warehouse_name')
		->from('user AS u')
		->join('user_group AS g', 'u.ugroup = g.id', 'left')
		->join('team AS t', 'u.team_id = t.id', 'left')
		->join('team_group AS tg', 'u.team_group_id = tg.id', 'left')
		->join('warehouse AS fw', 'tg.fromWhsCode = fw.code', 'left')
		->join('warehouse AS tw', 'tg.toWhsCode = tw.code', 'left');

    $rs = $this->db->where('u.uid', $uid)->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


	public function get_by_uname($uname)
	{
		$this->db
		->select('u.*, u.name AS display_name, g.name AS group_name, t.name AS team_name')
		->select('tg.name AS team_group_name, tg.fromWhsCode, tg.toWhsCode')
		->select('fw.name AS from_warehouse_name, tw.name AS to_warehouse_name')
		->from('user AS u')
		->join('user_group AS g', 'u.ugroup = g.id', 'left')
		->join('team AS t', 'u.team_id = t.id', 'left')
		->join('team_group AS tg', 'u.team_group_id = tg.id', 'left')
		->join('warehouse AS fw', 'tg.fromWhsCode = fw.code', 'left')
		->join('warehouse AS tw', 'tg.toWhsCode = tw.code', 'left');

    $rs = $this->db->where('u.uname', $uname)->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

		return NULL;
	}



  public function get_name($id)
  {
    $rs = $this->db->where('id', $id)->get($this->tb);
    if($rs->num_rows() == 1)
    {
      return $rs->row()->name;
    }

    return "";
  }


	public function get_uname($id)
	{
		$rs = $this->db->where('id', $id)->get($this->tb);

		if($rs->num_rows() === 1)
		{
			return $rs->row()->uname;
		}

		return NULL;
	}



	public function get_all()
	{
		$rs = $this->db->where('id >', 0, FALSE)->get($this->tb);

		if($rs->num_rows() > 0)
		{
			return $rs->result();
		}

		return NULL;
	}


	public function get_all_active()
	{
		$rs = $this->db->where('id >', 0, FALSE)->where('active', 1)->get($this->tb);

		if($rs->num_rows() > 0)
		{
			return $rs->result();
		}

		return NULL;
	}


	public function get_outsource_by_team($team_id)
	{
		$rs = $this->db
		->where('ugroup', 3)
		->where('team_id', $team_id)
		->where('active', 1)
		->get($this->tb);

		if($rs->num_rows() > 0)
		{
			return $rs->result();
		}

		return NULL;
	}


	public function get_user_team($user_id)
	{
		$qr = "SELECT * FROM user_team WHERE user_id = {$user_id}";
		$rs = $this->db->query($qr);

		if($rs->num_rows() > 0)
		{
			return $rs->result();
		}

		return NULL;
	}


	public function get_user_team_name($team_id)
	{
		$rs = $this->db->select('name')->where('id', $team_id)->get('team');

		if($rs->num_rows() == 1)
		{
			return $rs->row()->name;
		}

		return NULL;
	}



	public function get_list(array $ds = array(), $perpage = 20, $offset = 0)
	{
		$this->db
		->select('u.*, u.name AS display_name, g.name AS group_name, t.name AS team_name')
		->select('tg.name AS team_group_name')
		->from('user AS u')
		->join('user_group AS g', 'u.ugroup = g.id', 'left')
		->join('team AS t', 'u.team_id = t.id', 'left')
		->join('team_group AS tg', 'u.team_group_id = tg.id', 'left')
		->where('u.id >', 0);

		if( ! empty($ds['uname']))
		{
			$this->db->like('u.uname', $ds['uname']);
		}

		if( ! empty($ds['dname']))
		{
			$this->db->like('u.name', $ds['dname']);
		}

		if( ! empty($ds['team_group']))
		{
			$this->db->like('tg.name', $ds['team_group']);
		}

		if(isset($ds['ugroup']) && $ds['ugroup'] != 'all')
		{
			$this->db->where('u.ugroup', $ds['ugroup']);
		}

		if(isset($ds['team_id']) && $ds['team_id'] != 'all')
		{
			if($ds['team_id'] == "NULL")
			{
				$this->db->where('u.team_id IS NULL', NULL, FALSE);
			}
			else
			{
				$this->db->where('u.team_id', $ds['team_id']);
			}
		}

		if(isset($ds['active']) && $ds['active'] != 'all')
		{
			$this->db->where('u.active', $ds['active']);
		}

		if(isset($ds['get_meter']) && $ds['get_meter'] != 'all')
		{
			$this->db->where('u.can_get_meter', $ds['get_meter']);
		}

		$rs = $this->db->order_by('u.uname', 'ASC')->limit($perpage, $offset)->get();

		if($rs->num_rows() > 0)
		{
			return $rs->result();
		}
	}




  public function count_rows(array $ds = array())
  {
		$this->db
		->from('user AS u')
		->join('user_group AS g', 'u.ugroup = g.id', 'left')
		->join('team AS t', 'u.team_id = t.id', 'left')
		->join('team_group AS tg', 'u.team_group_id = tg.id', 'left')
		->where('u.id >', 0);

		if( ! empty($ds['uname']))
		{
			$this->db->like('u.uname', $ds['uname']);
		}

		if( ! empty($ds['dname']))
		{
			$this->db->like('u.name', $ds['dname']);
		}

		if( ! empty($ds['team_group']))
		{
			$this->db->like('tg.name', $ds['team_group']);
		}

		if(isset($ds['ugroup']) && $ds['ugroup'] != 'all')
		{
			$this->db->where('u.ugroup', $ds['ugroup']);
		}

		if(isset($ds['team_id']) && $ds['team_id'] != 'all')
		{
			if($ds['team_id'] == "NULL")
			{
				$this->db->where('u.team_id IS NULL', NULL, FALSE);
			}
			else
			{
				$this->db->where('u.team_id', $ds['team_id']);
			}
		}

		if(isset($ds['active']) && $ds['active'] != 'all')
		{
			$this->db->where('u.active', $ds['active']);
		}

		if(isset($ds['get_meter']) && $ds['get_meter'] != 'all')
		{
			$this->db->where('u.can_get_meter', $ds['get_meter']);
		}

    return $this->db->count_all_results();
  }




  public function is_exists_uname($uname, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $rs = $this->db->where('uname', $uname)->count_all_results($this->tb);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }



  public function is_exists_display_name($dname, $id = NULL)
  {
    if( ! empty($id))
    {
      $this->db->where('id !=', $id);
    }

    $rs = $this->db->where('name', $dname)->count_all_results($this->tb);

    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }



  public function get_user_credentials($uname)
  {
    $this->db->where('uname', $uname);
    $rs = $this->db->get($this->tb);
    return $rs->row();
  }



  public function verify_uid($uid)
  {
    $this->db->select('uid');
    $this->db->where('uid', $uid);
    $this->db->where('active', 1);
    $rs = $this->db->get($this->tb);

    return $rs->num_rows() === 1 ? TRUE : FALSE;
  }



	public function has_transection($id)
	{
		$total = 1;

		return $total > 0 ? TRUE : FALSE;
	}


	public function get_oursource_list()
	{
		$rs = $this->db->where('ugroup', 3)->get('user');

		if( ! empty($rs))
		{
			return $rs->result();
		}

		return NULL;
	}


	public function get_permission($menu, $user_id)
	{
		$pm = array(
			'can_view' => 0,
			'can_add' => 0,
			'can_edit' => 0,
			'can_delete' => 0,
			'can_approve' => 0
		);

		$rs = $this->db->where('menu', $menu)->where('user_id', $user_id)->get('permission');

		if($rs->num_rows() > 0)
		{
			$pm = array(
				'can_view' => $rs->row()->can_view,
				'can_add' => $rs->row()->can_add,
				'can_edit' => $rs->row()->can_edit,
				'can_delete' => $rs->row()->can_delete,
				'can_approve' => $rs->row()->can_approve
			);
		}

		return (object) $pm;
	}


	public function drop_permission($user_id)
	{
		return $this->db->where('user_id', $user_id)->delete('permission');
	}

	public function add_permission(array $ds = array())
	{
		return $this->db->insert('permission', $ds);
	}

} //---- End class

 ?>
