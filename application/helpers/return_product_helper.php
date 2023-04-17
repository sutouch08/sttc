<?php

function return_status_label($status, $is_approve)
{
  $label = "Unknow";

  if($status == -1)
  {
    $label = "<span class='label label-lg label-purple arrowed'>ดราฟ</span>";
  }

  if($status == 0)
  {
    $label = "<span class='label label-lg label-warning arrowed'>รอยืนยัน</span>";
  }

  if($status == 1 && $is_approve == 0)
  {
    $label = "<span class='label label-lg label-info arrowed'>รออนุมัติ</span>";
  }

  if($status == 1 && $is_approve == 1)
  {
    $label = "<span class='label label-lg label-success arrowed'>สำเร็จ</span>";
  }

  if($status == 2)
  {
    $label = "<span class='label label-lg label-danger arrowed'>ยกเลิก</span>";
  }

  if($status == 3)
  {
    $label = "<span class='label label-lg label-danger arrowed'>ผิดพลาด</span>";
  }

  return $label;
}


function return_status_text($status, $is_approve)
{
  $label = "Unknow";

  if($status == -1)
  {
    $label = "ดราฟ";
  }

  if($status == 0)
  {
    $label = "รอยืนยัน";
  }

  if($status == 1 && $is_approve == 0)
  {
    $label = "รออนุมัติ";
  }

  if($status == 1 && $is_approve == 1)
  {
    $label = "สำเร็จ";
  }

  if($status == 2)
  {
    $label = "ยกเลิก";
  }

  if($status == 3)
  {
    $label = "ผิดพลาด";
  }

  return $label;
}
 ?>
