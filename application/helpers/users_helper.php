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

function select_ugroup($id = '')
{
  $ds = '';
  $ds .= '<option value="1" '.is_selected('1', $id).'>Admin</option>';
  $ds .= '<option value="2" '.is_selected('2', $id).'>Outsource Manager</option>';
  $ds .= '<option value="3" '.is_selected('3', $id).'>Outsource</option>';

  return $ds;
}

function uname($id)
{
  $ci =& get_instance();
  return $ci->user_model->get_uname($id);
}
 ?>
