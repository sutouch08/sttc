<?php
function select_area($id = NULL)
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

function select_area_code($code = NULL)
{
  $ds = '';
  $ci =& get_instance();
  $ci->load->model('admin/team_model');

  $option = $ci->team_model->get_all_active();

  if( ! empty($option))
  {
    foreach($option as $rs)
    {
      $ds .= '<option value="'.$rs->code.'" '.is_selected($rs->code, $code).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}

function area_code_array()
{
  $ds = array();
  $ci =& get_instance();
  $ci->load->model('admin/team_model');
  $option = $ci->team_model->get_all_active();

  if( ! empty($option))
  {
    foreach($option as $rs)
    {
      $ds[$rs->code] = $rs->name;
    }
  }

  return $ds;
}

function area_array()
{
  $ds = array();
  $ci =& get_instance();
  $ci->load->model('admin/team_model');
  $option = $ci->team_model->get_all_active();

  if( ! empty($option))
  {
    foreach($option as $rs)
    {
      $ds[$rs->id] = $rs->name;
    }
  }
}

function area_name($id)
{
  $ci =& get_instance();
  $ci->load->model('admin/team_model');

  return $ci->team_model->get_name($id);
}

function area_name_by_code($code)
{
  $ci =& get_instance();
  $ci->load->model('admin/team_model');

  return $ci->team_model->get_name_by_code($code);
}
 ?>
