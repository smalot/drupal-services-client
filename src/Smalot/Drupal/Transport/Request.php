<?php

namespace Smalot\Drupal\Transport;

use Smalot\Drupal\ActionInterface;
use Smalot\Drupal\Security\SecurityInterface;

/**
 * Class Request
 *
 * @package Smalot\Drupal\Transport
 */
class Request implements RequestInterface
{
    /**
     * @var \Smalot\Drupal\ActionInterface
     */
    protected $action;

    /**
     * @var \Smalot\Drupal\Security\SecurityInterface
     */
    protected $security;

    /**
     * @param ActionInterface   $action
     * @param SecurityInterface $security
     */
    public function __construct(ActionInterface $action, SecurityInterface $security)
    {
        $this->action   = $action;
        $this->security = $security;
    }

    /**
     * @return \Smalot\Drupal\ActionInterface
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return \Smalot\Drupal\Security\SecurityInterface
     */
    public function getSecurity()
    {
        return $this->security;
    }
}
