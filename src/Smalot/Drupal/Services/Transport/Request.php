<?php

namespace Smalot\Drupal\Services\Transport;

use Smalot\Drupal\Services\ActionInterface;
use Smalot\Drupal\Services\Security\SecurityInterface;

/**
 * Class Request
 *
 * @package Smalot\Drupal\Services\Transport
 */
class Request implements RequestInterface
{
    /**
     * @var \Smalot\Drupal\Services\ActionInterface
     */
    protected $action;

    /**
     * @var \Smalot\Drupal\Services\Security\SecurityInterface
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
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return \Smalot\Drupal\Services\Security\SecurityInterface
     */
    public function getSecurity()
    {
        return $this->security;
    }
}
