<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends PS_Controller{
	public $menu_code = 'SCCONF';
	public $menu_group_code = 'SC'; //--- System security
	public $title = 'การกำหนดค่า';

  public function __construct()
  {
    parent::__construct();
    $this->home = base_url().'admin/setting';
		$this->load->model('admin/config_model');
		$this->load->helper('warehouse');
  }



  public function index($tab = 'company')
  {
		if($this->config->item('system_date'))
		{
			$groups = array('Company', 'Document', 'Order', 'SAP', 'system');

			$ds = array(
				'tab' => $tab
			);

			foreach($groups as $rs)
			{
				$group = $this->config_model->get_config_by_group($rs);

				if(!empty($group))
				{
					foreach($group as $rd)
					{
						$ds[$rd->code] = $this->config_model->get($rd->code);
					}
				}
			}

			$this->load->view('admin/setting/configs', $ds);
		}
		else
		{
			redirect(base_url().'suspended');
		}

  }



	public function update_config()
  {
    $sc = TRUE;

    if($this->input->post())
    {
      $this->error = "Cannot update : ";
      $configs = $this->input->post();
      foreach($configs as $name => $value)
      {
        if(! $this->config_model->update($name, $value))
        {
          $sc = FALSE;
          $this->error .= "{$name}, ";
        }
      }
    }
    else
    {
      $sc = FALSE;
      $this->error = "Form content not found";
    }

  	$this->_response($sc);
  }

}//--- end class


 ?>
