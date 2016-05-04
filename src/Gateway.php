<?php

namespace Omnipay\PeachPayments;

use Omnipay\Common\AbstractGateway;

/**
 * PeachPayments Gateway
 *
 * @link https://www.peachpayments.com
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PeachPayments';
    }
    
    public function getDefaultParameters()
    {
        return array(
            'userId' => '',
            'password' => '',
            'entityId' => '',
            'testMode' => false,
        );
    }

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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PeachPayments\Message\PurchaseRequest', $parameters);
    }
}