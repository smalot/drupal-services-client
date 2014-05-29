<?php

namespace Smalot\Drupal\Modules;

use Smalot\Drupal\Action;
use Smalot\Drupal\ActionInterface;
use Smalot\Drupal\RemoteAdapterInterface;

/**
 * Class ModuleAbstract
 *
 * @package Smalot\Drupal
 */
abstract class ModuleAbstract
{
    /**
     * @var RemoteAdapterInterface
     */
    protected $remoteAdapter;

    /**
     * @param RemoteAdapterInterface $remoteAdapter
     */
    public function __construct(RemoteAdapterInterface $remoteAdapter = null)
    {
        $this->remoteAdapter = $remoteAdapter;
    }

    /**
     * @param string $operation
     * @param array  $parameters
     * @param array  $data
     * @param array  $headers
     *
     * @return ActionInterface
     */
    protected function __createAction($operation, $parameters = array(), $data = array(), $headers = array())
    {
        return new Action($this->getModule(), $operation, $parameters, $data, $headers, $this->remoteAdapter);
    }

    /**
     * @return string
     */
    abstract protected function getModule();
}
