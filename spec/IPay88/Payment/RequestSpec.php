<?php

namespace spec\IPay88\Payment;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestSpec extends ObjectBehavior
{
	function let($die)
	{
		$this->beConstructedWith('123key');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('IPay88\Payment\Request');
    }

    function it_can_be_statically_generated()
    {
    	$this->make('123key',array(
			'merchantCode' => '123code',
			'paymentId'=> 2,
			'refNo' => '12345',
			'amount'=> '1,278.99',
			'currency' => 'MYR',
			'prodDesc' => 'A test payment',
			'userName' => 'John Doe',
			'userEmail'=> 'john.doe@yopmail.com',
			'userContact' => '0124346785',
			'remark'=> 'This is a test payment from John Doe',
			'lang'  => 'UTF-8',
			'respondURL'  => 'http://merchant.com/payment/respond',
			'backendURL'  => 'http://merchant.com/payment/respond/backend'
			))->shouldHaveType('IPay88\Payment\Request');
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
