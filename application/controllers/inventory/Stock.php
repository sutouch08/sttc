<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends PS_Controller
{
  public $menu_code = 'OPSTOCK';
	public $menu_group_code = 'OP';
	public $title = 'รายงานสินค้าคงเหลือ';
	public $segment = 4;
  public $error;
  public $ms;

  public function __construct()
  {
    parent::__construct();

    $this->ms = $this->load->database('ms', TRUE);
    $this->home = base_url().'inventory/stock';
    $this->load->model('inventory/stock_model');
    $this->load->model('admin/warehouse_model');
    $this->load->model('admin/team_model');
    $this->load->helper('warehouse');
  }

  public function index()
  {
    $ds = array(
      'warehouse_list' => $this->warehouse_model->get_listed(),
      'area_list' => $this->team_model->get_all_active()
    );

    $this->load->view('inventory/stock/stock_report', $ds);
  }


  public function get_report()
  {
    $sc = TRUE;

    $viewType = $this->input->post('viewType');

    $items = $this->stock_model->get_items_list();
    $page = NULL;

    if( ! empty($items))
    {
      if($viewType == 'warehouse')
      {
        $page = $this->get_stock_by_warehouse($items);

        if($page === FALSE)
        {
          $sc = FALSE;
        }
      }

      if($viewType == 'area')
      {
        $page = $this->get_stock_by_area($items);
      }

      if($viewType == 'role')
      {
        $page = $this->get_stock_by_role($items);
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการสินค้า";
    }


    $arr = array(
      'status' => $sc === TRUE ? 'success' : 'failed',
      'message' => $sc === TRUE ? 'success' : $this->error,
      'result' => $sc === TRUE ? $page : NULL
    );

    echo json_encode($arr);
  }


  public function get_stock_by_warehouse($items)
  {
    $sc = TRUE;

    if( ! empty($items))
    {
      $count = count($items);
      $width = $count + 200;

      $pd = array();
      $total = array();

      $page  = '<table class="table table-striped table-bordered" style="min-width:'.$width.'px;">';
      $page .= '<thead><tr><th class="fix-width-150 text-center">คลัง</th>';

      foreach($items as $item)
      {
        $page .= '<th class="fix-width-100 text-center">'.$item->ItemCode.'</th>';
        $pd[] = $item->ItemCode;
        $total[$item->ItemCode] = 0;
      } //--- end foreach

      $page .= '<th class="min-width-100">Total</th>';
      $page .= '</tr></thea>';

      $warehouse = $this->stock_model->get_listed_warehouse();

      if( ! empty($warehouse))
      {
        foreach($warehouse as $wh)
        {
          $qs = $this->stock_model->get_stock_by_warehouse($wh->code, $pd);

          if( ! empty($qs))
          {
            $total_row = 0;
            $page .= '<tr>';
            $page .= '<td class="text-center">'.$wh->code.'</td>';

            foreach($qs as $rs)
            {
              $page .= '<td class="text-center">'.number($rs->OnHand).'</td>';
              $total[$rs->ItemCode] += $rs->OnHand;
              $total_row += $rs->OnHand;
            }

            $page .= '<td class="">'.number($total_row).'</td>';

            $page .= '</tr>';
          }
        }

        $page .= '<tr><td class="text-center">Total</td>';
        $allTotal = 0;
        foreach($pd as $code)
        {
          $page .= '<td class="text-center">'.number($total[$code]).'</td>';
          $allTotal += $total[$code];
        }

        $page .= '<td class="">'.number($allTotal).'</td></tr>';
      }
      else
      {
        $sc = FALSE;
        $this->error = "ไม่พบคลังสินค้า";
      }

      $page .= '</table>';
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการสินค้า";
    }

    return $sc === TRUE ? $page : FALSE;
  }


  public function get_stock_by_area($items)
  {
    $this->load->model('inventory/team_model');

    $sc = TRUE;

    if( ! empty($items))
    {
      $count = count($items);
      $width = $count + 200;

      $pd = array();
      $total = array();

      $page  = '<table class="table table-striped table-bordered" style="min-width:'.$width.'px;">';
      $page .= '<thead><tr><th class="fix-width-150 text-center">คลัง</th>';

      foreach($items as $item)
      {
        $page .= '<th class="fix-width-100 text-center">'.$item->ItemCode.'</th>';
        $pd[] = $item->ItemCode;
        $total[$item->ItemCode] = 0;
      } //--- end foreach

      $page .= '<th class="min-width-100">Total</th>';
      $page .= '</tr></thea>';

      $area = $this->team_model->get_all_active();

      if( ! empty($area))
      {
        foreach($area as $ar)
        {
          $warehouse = $this->stock_model->get_listed_warehouse_by_area($ar->id);

          if( ! empty($warehouse))
          {
            $qs = $this->stock_model->get_stock_by_area($warehouse, $pd);

            if( ! empty($qs))
            {
              $total_row = 0;
              $page .= '<tr>';
              $page .= '<td class="text-center">'.$ar->name.'</td>';

              foreach($qs as $rs)
              {
                $page .= '<td class="text-center">'.number($rs->OnHand).'</td>';
                $total[$rs->ItemCode] += $rs->OnHand;
                $total_row += $rs->OnHand;
              }

              $page .= '<td class="">'.number($total_row).'</td>';

              $page .= '</tr>';
            }
          }

        }

        $page .= '<tr><td class="text-center">Total</td>';
        $allTotal = 0;
        foreach($pd as $code)
        {
          $page .= '<td class="text-center">'.number($total[$code]).'</td>';
          $allTotal += $total[$code];
        }

        $page .= '<td class="">'.number($allTotal).'</td></tr>';
      }
      else
      {
        $sc = FALSE;
        $this->error = "ไม่พบคลังสินค้า";
      }

      $page .= '</table>';
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการสินค้า";
    }

    return $sc === TRUE ? $page : FALSE;
  }


  public function get_stock_by_role($items)
  {
    $sc = TRUE;

    if( ! empty($items))
    {
      $count = count($items);
      $width = $count + 200;

      $pd = array();
      $total = array();
      $role = array(
        '0' => 'คลังรอเบิก',
        '1' => 'คลังเบิก',
        '2' => 'คลังสำเร็จ',
        '3' => 'คลังลงลัง'
      );

      $page  = '<table class="table table-striped table-bordered" style="min-width:'.$width.'px;">';
      $page .= '<thead><tr><th class="fix-width-150 text-center">คลัง</th>';

      foreach($items as $item)
      {
        $page .= '<th class="fix-width-100 text-center">'.$item->ItemCode.'</th>';
        $pd[] = $item->ItemCode;
        $total[$item->ItemCode] = 0;
      } //--- end foreach

      $page .= '<th class="min-width-100">Total</th>';
      $page .= '</tr></thea>';

      if( ! empty($role))
      {
        foreach($role as $index => $name)
        {
          $warehouse = $this->stock_model->get_listed_warehouse_by_role($index);

          if( ! empty($warehouse))
          {
            $qs = $this->stock_model->get_stock_by_role($warehouse, $pd);

            if( ! empty($qs))
            {
              $total_row = 0;
              $page .= '<tr>';
              $page .= '<td class="text-center">'.$name.'</td>';

              foreach($qs as $rs)
              {
                $page .= '<td class="text-center">'.number($rs->OnHand).'</td>';
                $total[$rs->ItemCode] += $rs->OnHand;
                $total_row += $rs->OnHand;
              }

              $page .= '<td class="">'.number($total_row).'</td>';

              $page .= '</tr>';
            }
          }

        }

        $page .= '<tr><td class="text-center">Total</td>';
        $allTotal = 0;
        foreach($pd as $code)
        {
          $page .= '<td class="text-center">'.number($total[$code]).'</td>';
          $allTotal += $total[$code];
        }

        $page .= '<td class="">'.number($allTotal).'</td></tr>';
      }
      else
      {
        $sc = FALSE;
        $this->error = "ไม่พบคลังสินค้า";
      }

      $page .= '</table>';
    }
    else
    {
      $sc = FALSE;
      $this->error = "ไม่พบรายการสินค้า";
    }

    return $sc === TRUE ? $page : FALSE;
  }


  public function get_warehouse($data)
  {
    $this->db
    ->select('code')
    ->where('listed', 1)
    ->where('status', 1);

    if(empty($data->allArea) && ! empty($data->area))
    {
      $this->db->where_in('team_id', $data->area);
    }

    if(empty($data->allRole) && ! empty($data->role))
    {
      $this->db->where_in('role', $data->role);
    }

    if(empty($data->allWh) && ! empty($data->warehouse))
    {
      $this->db->where_in('code', $data->warehouse);
    }

    $rs = $this->db->order_by('code', 'ASC')->get('warehouse');

    if($rs->num_rows() > 0)
    {
      $ds = array();

      foreach($rs->result() as $row)
      {
        $ds[] = $row->code;
      }

      return $ds;
    }

    return NULL;
  }
} //--- end class
