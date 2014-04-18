<?php namespace IPay88\Payment;

use IPay88\Security\Signature;

class Request
{
	private $merchantKey;
	private $merchantCode;
	private $paymentId;
	private $currency;
	private $transId;
	private $authCode;
	private $errDesc;
	private $signature;
	private $refNo;
	private $amount;
	private $remark;
	private $status;

    public static $requeryUrl = 'https://www.mobile88.com/epayment/enquiry.asp';

	public function getMerchantCode()
	{
		return $this->merchantCode;
	}

	public function setMerchantCode($val)
	{
		return $this->merchantCode = $val;
	}

	public function getPaymentId()
	{
		return $this->paymentId;
	}

	public function setPaymentId($val)
	{
		return $this->paymentId = $val;
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	public function setCurrency($val)
	{
		return $this->currency = $val;
	}

	public function getTransId()
	{
		return $this->transId;
	}

	public function setTransId($val)
	{
		return $this->transId = $val;
	}

	public function getAuthCode()
	{
		return $this->authCode;
	}

	public function setAuthCode($val)
	{
		return $this->authCode = $val;
	}

	public function getErrDesc()
	{
		return $this->errDesc;
	}

	public function setErrDesc($val)
	{
		return $this->errDesc = $val;
	}

	public function getSignature()
	{
		return Signature::generate_signature(
			$this->merchantKey,
			$this->getMerchantCode(),
			$this->getRefNo(),
			$this->getAmount(),
			$this->getCurrency()
			);
	}

	public function getRefNo()
	{
		return $this->refNo;
	}

	public function setRefNo($val)
	{
		return $this->refNo = $val;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function setAmount($val)
	{
		return $this->amount = $val;
	}

	public function getRemark()
	{
		return $this->remark;
	}

	public function setRemark($val)
	{
		return $this->remark = $val;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function setStatus($val)
	{
		return $this->status = $val;
	}


     /**
     * Check payment status (re-query).
     *
     * @access public
     * @param array $paymentDetails The following variables are required:
     * - MerchantCode (Optional)
     * - RefNo
     * - Amount
     * @return string Possible payment status from iPay88 server:
     * - 00                 - Successful payment
     * - Invalid parameters - Parameters passed is incorrect
     * - Record not found   - Could not find the record.
     * - Incorrect amount   - Amount differs.
     * - Payment fail       - Payment failed.
     * - M88Admin           - Payment status updated by Mobile88 Admin (Fail)
     */
    public static function requery($merchantCode, $refNo, $amount) 
    {
        if (!function_exists('curl_init')) {
            trigger_error('PHP cURL extension is required.');
            return false;
        }
        $curl = curl_init(
        			self::$requeryUrl . '?' . http_build_query(array(
		        		'MerchantCode' => $merchantCode,
		        		'RefNo' => $refNo,
		        		'Amount'=> $amount
		        	))
		        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = trim(curl_exec($curl));
        curl_close($curl);

        return $result;
    }

    public function __construct($merchantKey)
    {
    	$this->merchantKey = $merchantKey;
    }
}
