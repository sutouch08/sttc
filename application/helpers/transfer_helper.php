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
 ?>
