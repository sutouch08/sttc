<?php
function _check_login()
{
  $CI =& get_instance();
  $uid = get_cookie('uid');
  if($uid === NULL OR $CI->user_model->verify_uid($uid) === FALSE)
  {
    if(getConfig('CLOSE_SYSTEM'))
    {
      redirect(base_url().'maintenance');
    }
    else
    {
      redirect(base_url().'users/authentication');
    }
  }
}

function user_array($id = NULL)
{
  $ci =& get_instance();
  $ds = array();

  $list = $ci->user_model->get_all();

  if( ! empty($list))
  {
    foreach($list as $rs)
    {
      $ds[$rs->id] = $rs->name;
    }
  }

  return $ds;
}



function select_ugroup($id = '')
{
  $ds = '';
  $ds .= '<option value="1" '.is_selected('1', $id).'>Admin</option>';
  $ds .= '<option value="2" '.is_selected('2', $id).'>Manager</option>';
  $ds .= '<option value="3" '.is_selected('3', $id).'>Outsource</option>';

  return $ds;
}


function uname($id)
{
  $ci =& get_instance();
  return $ci->user_model->get_uname($id);
}


function select_outsource($id = NULL)
{
  $ds = "";
  $ci =& get_instance();
  $users = $ci->user_model->get_oursource_list();

  if( ! empty($users))
  {
    foreach($users AS $us)
    {
      $ds .= '<option value="'.$us->id.'" '.is_selected($id, $us->id).'>'.$us->uname.' : '.$us->name.'</option>';
    }
  }

  return $ds;
}


function get_permission($menu, $user_id)
{
  $CI =& get_instance();

  $user = $CI->user_model->get($user_id);

  if(empty($user))
  {
    return reject_permission();
  }

  //--- If super admin
  if($user->ugroup == -987654321)
  {
    $pm = new stdClass();
    $pm->can_view = TRUE;
    $pm->can_add = TRUE;
    $pm->can_edit = TRUE;
    $pm->can_delete = TRUE;
    $pm->can_approve = TRUE;
  }
  else
  {
    $pm = $CI->user_model->get_permission($menu, $user_id);

    if(empty($pm))
    {
      return reject_permission();
    }
    else
    {
      if(getConfig('CLOSE_SYSTEM') == 2)
      {
        $pm = new stdClass();
        $pm->can_add = FALSE;
        $pm->can_edit = FALSE;
        $pm->can_delete = FALSE;
        $pm->can_approve = FALSE;
      }
    }
  }

  return $pm;
}


function grant_permission()
{
  $pm = new stdClass();
  $pm->can_view = TRUE;
  $pm->can_add = TRUE;
  $pm->can_edit = TRUE;
  $pm->can_delete = TRUE;
  $pm->can_approve = TRUE;

  return $pm;
}


function reject_permission()
{
  $pm = new stdClass();
  $pm->can_view = FALSE;
  $pm->can_add = FALSE;
  $pm->can_edit = FALSE;
  $pm->can_delete = FALSE;
  $pm->can_approve = FALSE;

  return $pm;
}
 ?>
