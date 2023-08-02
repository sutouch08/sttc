<?php
  function dispose_reason_array()
  {
    $ci =& get_instance();
    $ci->load->model('inventory/dispose_reason_model');

    $ds = array();

    $list = $ci->dispose_reason_model->get_all();

    if( ! empty($list))
    {
      foreach($list as $rs)
      {
        $ds[$rs->reason_id] = $rs->title;
      }
    }

    return $ds;
  }


  function dispose_reason_name($reason_id = 0)
  {
    $ci =& get_instance();
    $ci->load->model('inventory/dispose_reason_model');

    return $ci->dispose_reason_model->get_name($reason_id);
  }
 ?>
