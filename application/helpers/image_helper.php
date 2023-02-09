<?php
function get_image_path($name, $folder = 'installed')
{
	$ci =& get_instance();
  $path = $ci->config->item('image_path').$folder;
	$image_path = base_url().$path."/{$name}.jpg";
	$file = $ci->config->item('image_file_path')."{$folder}/{$name}.jpg";

	return file_exists($file) ? $image_path : no_image_path();

}


function delete_image($name, $folder = "installed")
{
	$sc = TRUE;

  $ci =& get_instance();
  $path = $ci->config->item('image_file_path').$folder;
  $image_path = "{$path}/{$name}.jpg";

	if(file_exists($image_path))
	{
		if(! unlink($image_path))
		{
			$sc = FALSE;
		}
	}

	return $sc;
}


function no_image_path()
{
  $ci =& get_instance();
  $path = $ci->config->item('image_path');
  $no_image_path = base_url().$path.'/no_image.jpg';
  return $no_image_path;
}
?>
