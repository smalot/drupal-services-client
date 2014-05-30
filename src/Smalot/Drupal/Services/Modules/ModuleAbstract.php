<?php

namespace Smalot\Drupal\Services\Modules;

use Smalot\Drupal\Services\Action;
use Smalot\Drupal\Services\ActionInterface;
use Smalot\Drupal\Services\RemoteAdapterInterface;

/**
 * Class ModuleAbstract
 *
 * @package Smalot\Drupal\Services
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
