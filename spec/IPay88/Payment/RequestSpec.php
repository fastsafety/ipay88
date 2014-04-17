<?php

namespace spec\IPay88\Payment;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
	function let($die)
	{
		$this->beConstructedWith(array(
			'MerchantCode' => '123code',
			'PaymentId'=> 2,
			'RefNo' => '12345',
			'Amount'=> '1,278.99',
			'Currency' => 'MYR',
			'ProdDesc' => 'A test payment',
			'UserName' => 'John Doe',
			'UserEmail'=> 'john.doe@yopmail.com',
			'UserContact' => '0124346785',
			'Remark'=> 'This is a test payment from John Doe',
			'Lang'  => 'UTF-8',
			'RespondURL'  => 'http://merchant.com/payment/respond',
			'BackendURL'  => 'http://merchant.com/payment/respond/backend'
			));
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('IPay88\Payment\Request');
    }


    /**
    * we dont want to call ipay88 everytime we run the test dont we
    *
    
    function it_can_requery_payment()
    {
    	$this->requery("123code", "12345622", "1,278.99")->shouldHaveType("string");
    }
    */
}
