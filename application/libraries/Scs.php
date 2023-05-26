<?php
class Scs
{
  private $url = "https://peacos.pea.co.th/services_v1/";
  protected $ci;

  private $timeout = 3000;

  public function __construct()
  {
    $this->ci =& get_instance();
  }


  public function get_token()
  {
    $userName = getConfig('SCS_USER');
    $pwd = getConfig('SCS_PWD');

    if( ! empty($userName) && ! empty($pwd))
    {
      $curl = curl_init();
      $url = $this->url . "?cmd=user_login";
      $data = array("data" => '{"username":"'.$userName.'", "password":"'.$pwd.'", "uuid":"1234"}');
    
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => $this->timeout,
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_VERBOSE => TRUE
      ));

      $response = curl_exec($curl);

      if($response === FALSE)
      {
        $response = curl_error($curl);
      }

      curl_close($curl);

      return $response;
    }

    return FALSE;
  }



  public function init()
	{
    $curl = curl_init();
    $url = $this->url . "?cmd=initial&data={}";

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_SSL_VERIFYPEER => FALSE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => $this->timeout,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(),
      CURLOPT_VERBOSE => TRUE
    ));

    $response = curl_exec($curl);

    if($response === FALSE)
    {
      $response = curl_error($curl);
    }

    curl_close($curl);
    return $response;
  }


  public function get_work_list()
  {
    $curl = curl_init();
    $url = $this->url . "?cmd=changeMeterV2/work_cm_list";
    $token = getConfig('SCS_TOKEN');

    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_SSL_VERIFYPEER => FALSE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => $this->timeout,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array("data" => "{'token' : '{$token}'}"),
      CURLOPT_VERBOSE => TRUE
    ));

    $response = curl_exec($curl);

    if($response === FALSE)
    {
      $response = curl_error($curl);
    }

    curl_close($curl);
    return $response;
  }
} //--- end class


 ?>
