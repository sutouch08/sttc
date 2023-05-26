<?php
  function select_team($id = NULL)
  {
    $ds = '';
    $ci =& get_instance();
    $ci->load->model('admin/team_model');

    $option = $ci->team_model->get_all_active();

    if( ! empty($option))
    {
      foreach($option as $rs)
      {
        $ds .= '<option value="'.$rs->id.'" '.is_selected($rs->id, $id).'>'.$rs->name.'</option>';
      }
    }

    return $ds;
  }


  function user_team_names($user_id)
  {
    $ds = "";
    $ci =& get_instance();
    $ci->load->model('admin/team_model');

    $list = $ci->team_model->get_user_team($user_id);

    if( ! empty($list))
    {
      $i = 1;

      foreach($list as $rs)
      {
        $ds .= $i == 1 ? $rs->name : ",<br> {$rs->name}";
        $i++;
      }
    }

    return $ds;
  }


  function team_array()
  {
    $ds = array();

    $ci =& get_instance();
    $ci->load->model('admin/team_model');

    $list = $ci->team_model->get_all();

    if( ! empty($list))
    {
      foreach($list as $rs)
      {
        $ds[$rs->id] = $rs->name;
      }
    }

    return $ds;
  }


  function outsource_in_team($team_id)
  {
    $ds = array();

    $ci =& get_instance();
    $ci->load->model('admin/team_model');

    $list = $ci->team_model->get_outsource_by_team($team_id);

    if( ! empty($list))
    {
      foreach($list as $rs)
      {
        $ds[] = $rs;
      }
    }

    return $ds;
  }


  function select_my_team($user_id, $team_id)
  {
    $ds = '';
    $ci =& get_instance();
    $ci->load->model('admin/team_model');

    $option = $ci->team_model->get_user_team($user_id);

    if( ! empty($option))
    {
      foreach($option as $rs)
      {
        $ds .= '<option value="'.$rs->id.'" '.is_selected($rs->id, $team_id).'>'.$rs->name.'</option>';
      }
    }

    return $ds;
  }


 ?>
