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

  public function send_data($doc, $wl)
  {
    $curl = curl_init();
    $url = $this->url . "?cmd=changeMeterV2/work_cm_save";
    $token = getConfig('SCS_TOKEN');
    $username = getConfig('SCS_USER');
    $now = now();


    $data = array(
      "data" => "{
      'token': '{$token}',
      'params': {
        'job_id': 2,
        'CANo': '{$wl->ca_no}',
        'Plan_TableName': '{$wl->Plan_TableName}',
        'oldPeaNo': '{$wl->pea_no}',
        'oldPeaNoFull': '{$wl->pea_no_full}',
        'oldMatCodeFull': '{$wl->mat_code_full}',
        'isComplete': '1',
        'signImageUri': '{$doc->image3}',
        'signStatus': {$doc->sign_status},
        'meterOldReadEnd': {$doc->u_power_no},
        'meterSelected': '{$doc->i_pea_no}',
        'meterReadStart': '{$doc->i_power_no}',
        'ReasonIdSelected': '{$doc->damage_id}',
        'reasonDetail': null,
        'lat': '{$doc->latitude}',
        'lng': '{$doc->longitude}',
        'imageDataUri1': '{$doc->image1}',
        'imageDataUri2': '{$doc->image2}',
        'username': '{$username}',
        'WorkTimeEnd': '{$now}',
        'TimeEnd_Confirm': null,
        'phaseSelected': {$doc->phase},
        'CreatedDate': '{$now}'
      }",
      "image1" => new CURLFILE($doc->image1),
      "image2" => new CURLFILE($doc->image2)
    );

    if($doc->sign_status == 0)
    {
      $data['image3'] = new CURLFILE($doc->image3);
    }

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


  public function send_inform($ds)
  {
    $curl = curl_init();
    $url = $this->url . "?cmd=changeMeterV2/work_cm_save";
    $token = getConfig('SCS_TOKEN');
    $username = getConfig('SCS_USER');
    $now = now();
    $data = array(
      "data" => "{
      'token': '{$token}',
      'params': {
        'job_id': 2,
        'CANo': '{$ds['ca_no']}',
        'Plan_TableName': '{$ds['Plan_TableName']}',
        'oldPeaNo': '{$ds['pea_no']}',
        'oldPeaNoFull': '{$ds['pea_no_full']}',
        'oldMatCodeFull': '{$ds['mat_code_full']}',
        'isComplete': '0',
        'signImageUri': null,
        'signStatus': null,
        'meterOldReadEnd': null,
        'meterSelected': null,
        'meterReadStart': null,
        'ReasonIdSelected': null,
        'reasonDetail': '{$ds['remark']}',
        'lat': '{$ds['latitude']}',
        'lng': '{$ds['longitude']}',
        'imageDataUri1': '{$ds['image1']}',
        'imageDataUri2': '{$ds['image2']}',
        'username': '{$username}',
        'WorkTimeEnd': '{$now}',
        'TimeEnd_Confirm': null,
        'phaseSelected': null,
        'CreatedDate': ''
      }",
      "image1" => new CURLFILE($ds['f_path']),
      "image2" => new CURLFILE($ds['s_path'])
    );

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


} //--- end class


 ?>
