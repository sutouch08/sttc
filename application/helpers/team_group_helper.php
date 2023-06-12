<?php
function select_team_group($id = NULL)
{
  $ds = "";
  $ci =& get_instance();
  $ci->load->model('admin/group_model');

  $list = $ci->group_model->get_all();

  if( ! empty($list))
  {
    foreach($list as $rs)
    {
      $ds .= '<option value="'.$rs->id.'" '.is_selected($id, $rs->id).'>'.$rs->name.'</option>';
    }
  }

  return $ds;
}

 ?>
