<?php

namespace Omnipay\PeachPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Peach Payments Charge Token Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
    }

    public function isSuccessful()
    {
        if (!$this->data) {
            return false;
        }

        if (isset($this->data['result'])) {

            // Success codes - (http://support.peachpayments.com/hc/en-us/articles/200694456-Available-Return-Codes-000-000-000-to-999-999-999-)

            $successCodes = ['000.000.000', '000.100.110', '000.100.111', '000.100.112'];
            $resultCode = $this->data['result']['code'];

            if (in_array($resultCode, $successCodes))
                return true;
            }
        }

        return false;
    }

    public function getTransactionReference()
    {
        if (!$this->data) {
            return null;
        }

        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }

    public function getMessage()
    {
        if (isset($this->data['result']) {
            return $this->data['result']['description'];
        }

        return null;
    }


}