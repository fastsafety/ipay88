<?php

namespace IPay88\Payment;

use IPay88\Security\Signature;

class Response
{
	private $referrer;
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

	public function getReferrer()
	{
		return $this->referrer;
	}

	public function getMerchantCode()
	{
		return $this->merchantCode;
	}

	public function getPaymentId()
	{
		return $this->paymentId;
	}

	public function getCurrency()
	{
		return $this->currency;
	}

	public function getTransId()
	{
		return $this->transId;
	}

	public function getAuthCode()
	{
		return $this->authCode;
	}

	public function getErrDesc()
	{
		return $this->errDesc;
	}

	public function getSignature()
	{
		return $this->signature;
	}

	public function getRefNo()
	{
		return $this->refNo;
	}

	public function getAmount()
	{
		return $this->amount;
	}

	public function getRemark()
	{
		return $this->remark;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function __call($method, $args)
    {
        if ( ! preg_match('/(?P<accessor>set|get)(?P<property>[A-Z][a-zA-Z0-9]*)/', $method, $match) ||
             ! property_exists(__CLASS__, $match['property'] = lcfirst($match['property']))
        ) {
            throw new \BadMethodCallException(sprintf(
                "'%s' does not exist in '%s'.", $method, get_class(__CLASS__)
            ));
        }

        switch ($match['accessor']) {
            case 'get':
                return $this->{$match['property']};
            case 'set':
                if ( ! $args) {
                    throw new InvalidArgumentException(sprintf("'%s' requires an argument value.", $method));
                }
                $this->{$match['property']} = $args[0];
                return $this;
        }
    }

}
