<?php

function transfer_status_label($status = -1)
{
  $label = "<span class='label label-lg label-purple arrowed'>Draft</span>";
  switch($status)
  {
    case -1:
    $label = "<span class='label label-lg label-purple arrowed'>Draft</span>";
    break;
    case 0 :
    $label = "<span class='label label-lg label-warning arrowed'>Pending</span>";
    break;
    case 1 :
    $label = "<span class='label label-lg label-success arrowed'>Success</span>";
    break;
    case 2 :
    $label = "<span class='label label-lg label-danger arrowed'>Cancelled</span>";
    break;
    case 3 :
    $label = "<span class='label label-lg label-danger arrowed'>Failed</span>";
    break;
    default :
    $label = "<span class='label label-lg label-purple arrowed'>Draft</span>";
    break;
  }

  return $label;
}

function transfer_line_status_label($status = 'O')
{
  $label = "<span class='label label-lg label-info arrowed'>Open</span>";
  switch($status)
  {
    case 'O':
    $label = "<span class='label label-lg label-info arrowed'>Open</span>";
    break;
    case 'C' :
    $label = "<span class='label label-lg label-success arrowed'>Closed</span>";
    break;
    case 'D' :
    $label = "<span class='label label-lg arrowed'>Cancelled</span>";
    break;
    default :
    $label = "<span class='label label-lg label-info arrowed'>Open</span>";
    break;
  }

  return $label;
}

function condLabel($cond)
{
  return $cond == 1 ? "สภาพดี" : "ชำรุด";
}


function condLabelColor($age, $cond)
{
  $color = "red";

  if($age < 10)
  {
    if($cond == 2 && $age > 3)
    {
      $color = "orange";
    }

    if($cond == 2 && $age <= 3)
    {
      $color = "blue";
    }

    if($cond == 1)
    {
      $color = "green";
    }
  }

  $label = '<div style="background-color:'.$color.'; width:20px; height:20px;"></div>';

  return $label;
}

function select_cond($se = NULL)
{
  $sc = '<option value="1" '.is_selected('1', $se).'>สภาพดี</option>';
  $sc .= '<option value="2" '.is_selected('2', $se).'>ชำรุด</option>';

  return $sc;  
}
 ?>
