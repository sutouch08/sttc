<?php
class Api
{
  private $url;
  protected $ci;
	public $error;
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
				$this->error = $rs->error;
			}
		}
    else
    {
      $this->error = "no data";
    }

    return FALSE;
	}


	public function exportTransfer($id)
	{
    $this->ci->load->model('inventory/transfer_model');

		$testMode = getConfig('TEST_MODE') ? TRUE : FALSE;

		if($testMode)
		{
			$arr = array(
				'status' => 1,
				'docEntry' => 1,
				'docNum' => "22000001"
			);

			$this->ci->transfer_model->update($id, $arr);
			return TRUE;
		}

		$logJson = getConfig('LOGS_JSON') == 1 ? TRUE : FALSE;



		$sc = TRUE;
		$doc = $this->ci->transfer_model->get($id);

		if(! empty($doc) && ! empty($details))
		{
      $currency = getConfig('CURRENCY');
      $vat_rate = getConfig('SALE_VAT_RATE');
      $vat_code = getConfig('SALE_VAT_CODE');

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
        'DocCur' => $currency,
        'DocRate' => 1,
        'DocTotal' => 0.000000,
        'DocTotalFC' => 0.000000,
        'Filler' => $doc->fromWhsCode,
        'ToWhsCode' => $doc->toWhsCode,
        'Comments' => $doc->remark
      );

			$orderLine = array();

      $arr = array(
        'U_WEBCODE' => $doc->code,
        'LineNum' => 0,
        'ItemCode' => $rs->ItemCode,
        'Dscription' => $rs->ItemName,
        'Quantity' => $rs->Qty,
        'unitMsr' => NULL,
        'PriceBefDi' => 0.000000,
        'LineTotal' => 0.000000,
        'ShipDate' => sap_date($doc->date_add, TRUE),
        'Currency' => $currency,
        'Rate' => 1,
        'DiscPrcnt' => 0.000000,
        'Price' => 0.000000,
        'TotalFrgn' => 0.000000,
        'FromWhsCod' => $doc->fromWhsCode,
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
        'TaxType' => 'Y'
      );

			$ds['DocLine'] = $orderLine;


			$url = getConfig('SAP_API_HOST');

			if($url[-1] != '/')
			{
				$url .'/';
			}

			$url = $url."transfer";

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($curl, CURLOPT_TIMEOUT, 0);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($ds));
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
					$arr = array(
						'status' => 1,
						'docEntry' => $rs->DocEntry,
						'docNum' => $rs->DocNum
					);

					$this->ci->transfer_model->update($id, $arr);

				}
				else
				{
					$arr = array(
						'status' => 3,
						'message' => $rs->error
					);

					$this->ci->transfer_model->update($id, $arr);

					$sc = FALSE;
					$this->error = $rs->error;

					if($logJson)
					{
						$this->ci->load->model('rest/logs_model');

						$logs = array(
							'code' => $doc->code,
							'status' => 'error',
							'json' => json_encode($ds)
						);

						$this->ci->logs_model->log_transfer($logs);
					}
				}
			}
			else
			{
				$sc = FALSE;
				$this->error = "Export failed : {$response}";

				$arr = array(
					'status' => 3,
					'message' => $response
				);

				$this->ci->transfer_model->update($id, $arr);
			}
		}
		else
		{
			$sc = FALSE;
			$this->error = "No data found";
		}

		return $sc;
	}

} //--- end class
?>
