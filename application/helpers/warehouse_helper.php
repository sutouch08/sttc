<?php
function select_warehouse($code = NULL)
{
	$ds = '';
	$ci =& get_instance();
	$ci->load->model('admin/warehouse_model');

	$option = $ci->warehouse_model->get_all();

	if( ! empty($option))
	{
		foreach($option as $rs)
		{
			$ds .= '<option value="'.$rs->code.'" '.is_selected($rs->code, $code).'>'.$rs->name.'</option>';
		}
	}

	return $ds;
}


function select_listed_warehouse($code = NULL)
{
	$ds = '';
	$ci =& get_instance();
	$ci->load->model('admin/warehouse_model');

	$option = $ci->warehouse_model->get_listed();

	if( ! empty($option))
	{
		foreach($option as $rs)
		{
			$ds .= '<option value="'.$rs->code.'" '.is_selected($rs->code, $code).'>'.$rs->code.' : '.$rs->name.'</option>';
		}
	}

	return $ds;
}


function user_warehouse_names($user_id)
{
	$ds = "";
	$ci =& get_instance();
	$ci->load->model('admin/warehouse_model');

	$list = $ci->warehouse_model->get_user_warehouse($user_id);

	if( ! empty($list))
	{
		$i = 1;
		foreach($list as $rs)
		{
			$ds .= $i == 1 ? $rs->name : ",<br> {$rs->name}";
			$i++;
		}
	}

	return $ds;
}
?>
