<?php

namespace Omnipay\PeachPayments\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * PeachPayment Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    protected $liveEndpoint = 'https://oppwa.com/v1';
    protected $testEndpoint = 'https://test.oppwa.com/v1';

    public function getUserId()
    {
        return $this->getParameter('userId');
    }

    public function setUserId($value)
    {
        return $this->setParameter('userId', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getEntityId()
    {
        return $this->getParameter('entityId');
    }

    public function setEntityId($value)
    {
        return $this->setParameter('entityId', $value);
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getPaymentType()
    {
        return $this->getParameter('paymentType');
    }

    public function setPaymentType($value)
    {
        return $this->setParameter('paymentType', $value);
    }

    public function getRecurringType()
    {
        return $this->getParameter('recurringType');
    }

    public function setRecurringType($value)
    {
        return $this->setParameter('recurringType', $value);
    }

    public function getMerchantTransactionId()
    {
        return $this->getParameter('merchantTransactionId');
    }

    public function setMerchantTransactionId($value)
    {
        return $this->setParameter('merchantTransactionId', $value);
    }

    public function getEndpoint()
    {
        $endpoint = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;

        $endpoint = $endpoint . '/registrations/' . $this->getToken() . '/payments';

        return $endpoint;
    }

    public function getData()
    {

        $this->validate('amount', 'description');
        
        $data = array();

        $data['authentication.userId'] = $this->getUserId();
        $data['authentication.password'] = $this->getPassword();
        $data['authentication.entityId'] = $this->getEntityId();
        $data['amount'] = $this->getAmount();
        $data['currency'] = $this->getCurrency();
        $data['paymentType'] = $this->getPaymentType();
        $data['recurringType'] = $this->getRecurringType();

        // Optional parameters
        if ($this->getMerchantTransactionId()) {
            $data['merchantTransactionId'] = $this->getMerchantTransactionId();
        }
        

        return $data;
    }

    public function sendData($data)
    {

        $jsonDataObject = null;

        try {
            $httpResponse = $this->httpClient->post($this->getEndpoint(), null, $data)->send();
            $jsonDataObject = $httpResponse->json();

        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
            $jsonDataObject = $e->getResponse()->json();
        }
        
        return $this->response = new PurchaseResponse($this, $jsonDataObject);
    }
}