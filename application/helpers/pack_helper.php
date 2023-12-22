<?php
function sum_pack_qty($pack_id)
{
  $ci =& get_instance();
  $ci->load->model('inventory/pack_model');

  return $ci->pack_model->get_sum_qty($pack_id);
}


function pack_status_label($status = 'O')
{
  $arr = array(
    'O' => 'Open',
    'F' => 'Finished',
    'C' => 'Closed',
    'D' => 'Cancelled'
  );

  return empty($arr[$status]) ? 'Open' : $arr[$status];
}

function color_name($color)
{
  $arr = array(
    'Green' => 'เขียว',
    'Blue' => 'น้ำเงิน',
    'Orange' => 'ส้ม',
    'Red' => 'แดง'
  );

  return ! empty($arr[$color]) ? $arr[$color] : "Unknow";
}

 ?>
