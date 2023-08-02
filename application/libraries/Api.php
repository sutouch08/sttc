<?php
class Api
{
  private $url;
  protected $ci;
	//public $error;
  private $timeout = 0; //--- timeout in seconds;

  public function __construct()
  {
		$this->ci =& get_instance();

    $this->url = getConfig('SAP_API_HOST');
		if($this->url[-1] != '/')
		{
			$this->url .'/';
		}
  }


	public function cancle_sap_transfer($arr)
	{
		$url = $this->url .'SalesOrder';
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($curl, CURLOPT_TIMEOUT, 0);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($arr));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

		$response = curl_exec($curl);

    if($response === FALSE)
    {
      $response = curl_error($curl);
    }

		curl_close($curl);

		$rs = json_decode($response);

		if(! empty($rs) && ! empty($rs->status))
		{
			if($rs->status == 'success')
			{
				return TRUE;
			}
			else
			{
				$this->ci->error = $rs->error;
			}
		}
    else
    {
      $this->ci->error = "no data";
    }

    return FALSE;
	}


	public function exportTransfer($id)
	{
    $this->ci->load->model('inventory/transfer_model');
    $this->ci->load->model('logs_model');

		$testMode = getConfig('TEST_MODE') ? TRUE : FALSE;

		if($testMode)
		{
			$arr = array(
				'export_status' => 'S',
				'DocEntry' => 1,
				'DocNum' => "22000001"
			);

			$this->ci->transfer_model->update($id, $arr);
			return TRUE;
		}

		$logJson = getConfig('LOGS_JSON') == 1 ? TRUE : FALSE;



		$sc = TRUE;
		$doc = $this->ci->transfer_model->get($id);
    $details = $this->ci->transfer_model->get_details($id);

		if(! empty($doc) && ! empty($details))
		{
      $ds = array(
        'U_WEBCODE' => $doc->code,
        'DocType' => 'I',
        'CANCELED' => 'N',
        'DocDate' => sap_date($doc->date_add, TRUE),
        'DocDueDate' => sap_date($doc->date_add, TRUE),
        'CardCode' => NULL,
        'CardName' => NULL,
        'VatPercent' => 0.000000,
        'VatSum' => 0.000000,
        'VatSumFc' => 0.000000,
        'DiscPrcnt' => 0.000000,
        'DiscSum' => 0.000000,
        'DiscSumFC' => 0.000000,
        'DocCur' => NULL,
        'DocRate' => 1,
        'DocTotal' => 0.000000,
        'DocTotalFC' => 0.000000,
        'Filler' => $doc->fromWhsCode,
        'ToWhsCode' => $doc->toWhsCode,
        'Comments' => $doc->remark,
        'DocLine' => array()
      );

      foreach($details as $rs)
      {
        $arr =  array(
          'U_WEBCODE' => $rs->transfer_code,
          'LineNum' => $rs->LineNum,
          'ItemCode' => $rs->ItemCode,
          'Dscription' => $rs->ItemName,
          'Quantity' => $rs->qty,
          'unitMsr' => NULL,
          'PriceBefDi' => 0.000000,
          'LineTotal' => 0.000000,
          'ShipDate' => sap_date($doc->date_add, TRUE),
          'Currency' => NULL,
          'Rate' => 1,
          'DiscPrcnt' => 0.000000,
          'Price' => 0.000000,
          'TotalFrgn' => 0.000000,
          'FromWhsCod' => $rs->fromWhsCode,
          'WhsCode' => $rs->toWhsCode,
          'TaxStatus' => 'Y',
          'VatPrcnt' => 0.000000,
          'VatGroup' => NULL,
          'PriceAfVAT' => 0.000000,
          'VatSum' => 0.000000,
          'TaxType' => 'Y',
          'SerialNum' => $rs->i_pea_no
        );

        array_push($ds['DocLine'], $arr);
      }

			$url = getConfig('SAP_API_HOST');

			if($url[-1] != '/')
			{
				$url .'/';
			}

			$url = $url."transfer";

      $json = json_encode($ds);

      if($logJson)
      {
        $logs = array(
          'code' => $doc->code,
          'status' => 'send',
          'json' => $json
        );

        $this->ci->logs_model->log_transfer($logs);
      }

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl, CURLOPT_TIMEOUT, 0);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

			$response = curl_exec($curl);

      if($logJson)
      {
        $logs = array(
          'code' => $doc->code,
          'status' => 'result',
          'json' => $response
        );

        $this->ci->logs_model->log_transfer($logs);
      }

      if($response === FALSE)
      {
        $response = curl_error($curl);
      }

			curl_close($curl);

			$rs = json_decode($response);

			if(! empty($rs) && ! empty($rs->status))
			{
				if($rs->status == 'success')
				{
					$arr = array(
						'export_status' => 'S',
						'DocEntry' => $rs->docEntry,
						'DocNum' => $rs->docNum
					);

					$this->ci->transfer_model->update($id, $arr);

				}
        elseif($rs->status == 'exists')
        {
          $arr = array(
						'export_status' => 'S',
						'DocEntry' => $rs->docEntry,
						'DocNum' => $rs->docNum
					);

					$this->ci->transfer_model->update($id, $arr);
        }
				else
				{
					$arr = array(
						'export_status' => 'F',
						'Message' => $rs->message
					);

					$this->ci->transfer_model->update($id, $arr);

					$sc = FALSE;
					$this->ci->error = $rs->message;

					if($logJson)
					{
						$logs = array(
							'code' => $doc->code,
							'status' => 'error',
							'json' => $rs->message
						);

						$this->ci->logs_model->log_transfer($logs);
					}
				}
			}
			else
			{
				$sc = FALSE;
				$this->ci->error = "Export failed : {$response}";

				$arr = array(
					'export_status' => 'F',
					'Message' => $response
				);

				$this->ci->transfer_model->update($id, $arr);
			}
		}
		else
		{
			$sc = FALSE;
			$this->ci->error = "No data found";
		}

		return $sc;
	}


  public function exportReturn($id)
	{
    $this->ci->load->model('inventory/return_product_model');
    $this->ci->load->model('logs_model');

		$testMode = getConfig('TEST_MODE') ? TRUE : FALSE;

		if($testMode)
		{
			$arr = array(
				'status' => 1,
				'docEntry' => 1,
				'docNum' => "22000001"
			);

			$this->ci->return_product_model->update($id, $arr);
			return TRUE;
		}

		$logJson = getConfig('LOGS_JSON') == 1 ? TRUE : FALSE;

		$sc = TRUE;
		$doc = $this->ci->return_product_model->get($id);
    $details = $this->ci->return_product_model->get_details($id);

		if(! empty($doc) && ! empty($details))
		{

      $ds = array(
        'U_WEBCODE' => $doc->code,
        'DocType' => 'I',
        'CANCELED' => 'N',
        'DocDate' => sap_date($doc->date_add, TRUE),
        'DocDueDate' => sap_date($doc->date_add, TRUE),
        'CardCode' => NULL,
        'CardName' => NULL,
        'VatPercent' => 0.000000,
        'VatSum' => 0.000000,
        'VatSumFc' => 0.000000,
        'DiscPrcnt' => 0.000000,
        'DiscSum' => 0.000000,
        'DiscSumFC' => 0.000000,
        'DocCur' => NULL,
        'DocRate' => 1,
        'DocTotal' => 0.000000,
        'DocTotalFC' => 0.000000,
        'Filler' => $doc->whsCode,
        'ToWhsCode' => $doc->toWhsCode,
        'Comments' => $doc->remark,
        'DocLine' => array()
      );

      $lineNum = 0;

      foreach($details as $rs)
      {
        $arr =  array(
          'U_WEBCODE' => $rs->return_code,
          'LineNum' => $lineNum,
          'ItemCode' => $rs->ItemCode,
          'Dscription' => $rs->ItemName,
          'Quantity' => $rs->Qty,
          'unitMsr' => NULL,
          'PriceBefDi' => 0.000000,
          'LineTotal' => 0.000000,
          'ShipDate' => sap_date($doc->date_add, TRUE),
          'Currency' => NULL,
          'Rate' => 1,
          'DiscPrcnt' => 0.000000,
          'Price' => 0.000000,
          'TotalFrgn' => 0.000000,
          'FromWhsCod' => $rs->WhsCode,
          'WhsCode' => $doc->toWhsCode,
          'FisrtBin' => NULL,
          'F_FROM_BIN' => NULL,
          'F_TO_BIN' => NULL,
          'AllocBinC' => NULL,
          'TaxStatus' => 'Y',
          'VatPrcnt' => 0.000000,
          'VatGroup' => NULL,
          'PriceAfVAT' => 0.000000,
          'VatSum' => 0.000000,
          'TaxType' => 'Y',
          'SerialNum' => $rs->Serial
        );

        array_push($ds['DocLine'], $arr);
        $lineNum++;
      }

			$url = getConfig('SAP_API_HOST');

			if($url[-1] != '/')
			{
				$url .'/';
			}

			$url = $url."return";

      $json = json_encode($ds);

      if($logJson)
      {
        $logs = array(
          'code' => $doc->code,
          'status' => 'send',
          'json' => $json
        );

        $this->ci->logs_model->log_transfer($logs);
      }

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl, CURLOPT_TIMEOUT, 0);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

			$response = curl_exec($curl);

      if($logJson)
      {
        $logs = array(
          'code' => $doc->code,
          'status' => 'result',
          'json' => $response
        );

        $this->ci->logs_model->log_transfer($logs);
      }

      if($response === FALSE)
      {
        $response = curl_error($curl);
      }

			curl_close($curl);

			$rs = json_decode($response);

			if(! empty($rs) && ! empty($rs->status))
			{
				if($rs->status == 'success')
				{
					$arr = array(
						'status' => 1,
						'docEntry' => $rs->docEntry,
						'docNum' => $rs->docNum
					);

					$this->ci->return_product_model->update($id, $arr);

				}
        elseif($rs->status == 'exists')
        {
          $arr = array(
						'status' => 1,
						'docEntry' => $rs->docEntry,
						'docNum' => $rs->docNum
					);

					$this->ci->return_product_model->update($id, $arr);
        }
				else
				{
					$arr = array(
						'status' => 3,
						'message' => $rs->message
					);

					$this->ci->return_product_model->update($id, $arr);

					$sc = FALSE;
					$this->ci->error = $rs->message;

          if($logJson)
					{
						$logs = array(
							'code' => $doc->code,
							'status' => 'error',
							'json' => $rs->message
						);

						$this->ci->logs_model->log_transfer($logs);
					}
				}
			}
			else
			{
				$sc = FALSE;
				$this->ci->error = "Export failed : {$response}";

				$arr = array(
					'status' => 3,
					'message' => $response
				);

				$this->ci->return_product_model->update($id, $arr);
			}
		}
		else
		{
			$sc = FALSE;
			$this->ci->error = "No data found";
		}

		return $sc;
	}

} //--- end class
?>
