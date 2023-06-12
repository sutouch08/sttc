<?php

function transfer_status_label($status = 'I')
{
  $arr = array(
    'I' => '<span style="color:#ff892a;">รออนุมัติ</span>',
    'A' => '<span style="color:#478fca;">อนุมัติแล้ว</span>',
    'R' => '<span style="color:red;">ไม่อนุมัติ</span>',
    'W' => '<span style="color:blue;">รอตรวจรับ</span>',
    'S' => '<span style="color:green;">ตรวจรับแล้ว</span>',
    'U' => '<span style="color:red;">ต้องแก้ไข</span>',
    'C' => '<span style="color:darkgrey;">ยกเลิก</span>'
  );

  return $arr[$status];
}

function sap_status_label($status = 'P')
{
  $arr = array(
    'P' => '<span class="orange">Pending</span>',
    'S' => '<span class="green">Success</span>',
    'F' => '<span class="red">Failed</span>'
  );

  return $arr[$status];
}


function sticker_color($cond, $age)
{
  $color = "red";

  if($age <= 10)
  {
    if($cond != 0 && $age > 3)
    {
      $color = "orange";
    }

    if($cond != 0 && $age <= 3)
    {
      $color = "blue";
    }

    if($cond == 0)
    {
      $color = "green";
    }
  }

  $label = '<div style="background-color:'.$color.'; width:40px; height:40px;"></div>';

  return $label;
}


function select_damage($damage_id = 0)
{
  $ds = "";
  $ci =& get_instance();
  $ci->load->model('admin/dispose_reason_model');

  $list = $ci->dispose_reason_model->get_all();

  if( ! empty($list))
  {
    foreach($list as $rs)
    {
      $ds .= '<option value="'.$rs->reason_id.'" '.is_selected($damage_id, $rs->reason_id).'>'.$rs->title.'</option>';
    }
  }

  return $ds;
}


function damage_name($damage_id = 0)
{
  $ds = "";
  $ci =& get_instance();
  $ci->load->model('admin/dispose_reason_model');

  return $ci->dispose_reason_model->get_title($damage_id);
}
 ?>
