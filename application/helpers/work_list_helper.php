<?php

function status_text($status = 'P')
{
  $text = "Pending";
  /*
  *  P = Pending (รอติดตั้ง)
  *  I = Installed (ติดตั้งแล้ว รอหลังบ้านอนุมัติ)
  *  A = Approved (หลังบ้านอนุมัติแล้ว แต่ยังไม่ส่งไป PEA)
  *  R = Rejected (หลังบ้านไม่อนุมัติ ต้องกลับไปแก้ไขที่จุดติดตั้ง)
  *  W = Waitin (ส่งข้อมูลไป PEA แล้ว รอผลว่าผ่านหรือไม่)
  *  S = Success (PEA อนุมัติแล้วการสลับมิเตอร์เสร็จสมบูรณ์)
  *  U = Rejectd (PEA ตรวจแล้วไม่ผ่าน ต้องกลับไปแก้ไขใหม่)
  */

  switch($status)
  {
    case 'P' :
      $text = "รอสับเปลี่ยน";
      break;
    case 'I' :
      $text = "รออนุมัติ";
      break;
    case 'A' :
      $text = "อนุมัติแล้ว";
      break;
    case 'R' :
      $text = "ไม่อนุมัติ";
      break;
    case 'S' :
      $text = "PEA อนุมัติแล้ว";
      break;
    case 'W' :
      $text = "รอ PEA ตรวจสอบ";
      break;
    case 'U' :
      $text = "PEA ไม่อนุมัติ";
      break;
    case 'F' :
      $text = "เหตุสุดวิสัย";
      break;
    default :
      $text = "รอสับเปลี่ยน";
      break;
  }

  return $text;
}


function status_color($status = 'P')
{
  $text = "";
  /*
  *  P = Pending (รอติดตั้ง)
  *  I = Installed (ติดตั้งแล้ว รอหลังบ้านอนุมัติ)
  *  A = Approved (หลังบ้านอนุมัติแล้ว แต่ยังไม่ส่งไป PEA)
  *  R = Rejected (หลังบ้านไม่อนุมัติ ต้องกลับไปแก้ไขที่จุดติดตั้ง)
  *  W = Waitin (ส่งข้อมูลไป PEA แล้ว รอผลว่าผ่านหรือไม่)
  *  S = Success (PEA อนุมัติแล้วการสลับมิเตอร์เสร็จสมบูรณ์)
  *  U = Rejectd (PEA ตรวจแล้วไม่ผ่าน ต้องกลับไปแก้ไขใหม่)
  */

  switch($status)
  {
    case 'P' :
      $text = "";
      break;
    case 'I' :
      $text = "color:#0a74e1;";
      break;
    case 'A' :
      $text = "color:green;";
      break;
    case 'R' :
      $text = "color:red;";
      break;
    case 'S' :
      $text = "color:limegreen;";
      break;
    case 'W' :
      $text = "color:orange;";
      break;
    case 'U' :
      $text = "color:red;";
      break;
    case 'F' :
      $text = "color:red;";
      break;
    default :
      $text = "";
      break;
  }

  return $text;
}

 ?>
