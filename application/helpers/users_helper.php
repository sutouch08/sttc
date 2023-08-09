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
  $ds .= '<option value="1" '.is_selected('1', $id).'>User</option>';
  $ds .= '<option value="2" '.is_selected('2', $id).'>Admin</option>';

  return $ds;
}


function uname($id)
{
  $ci =& get_instance();
  return $ci->user_model->get_uname($id);
}


function display_name($id)
{
  $ci =& get_instance();
  return $ci->user_model->get_name($id);
}



function select_user($id = NULL)
{
  $ds = "";
  $ci =& get_instance();
  $users = $ci->user_model->get_all_active();

  if( ! empty($users))
  {
    foreach($users as $rs)
    {
      $ds .= '<option value="'.$rs->id.'" '.is_selected($id, $rs->id).'>'.$rs->uname.' : '.$rs->name.'</option>';
    }
  }

  return $ds;
}


function get_permission($menu, $user_id)
{
  $CI =& get_instance();

  $user = $CI->user_model->get($user_id);

  if( ! empty($user))
  {
    if($user->ugroup == -987654321)
    {
      return grant_permission();
    }
    else
    {
      $pm = $CI->user_model->get_permission($menu, $user_id);

      if( ! empty($pm))
      {
        if(getConfig('CLOSE_SYSTEM') == 2)
        {
          $pm->can_add = FALSE;
          $pm->can_edit = FALSE;
          $pm->can_delete = FALSE;
          $pm->can_approve = FALSE;
        }

        return $pm;
      }
    }
  }

  return reject_permission();
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
