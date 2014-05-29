<?php

namespace Smalot\Drupal;

/**
 * Class Action
 *
 * @package Smalot\Drupal
 */
class Action implements ActionInterface
{
    /**
     * @var string
     */
    protected $operation = null;

    /**
     * @var array
     */
    protected $arguments = null;

    /**
     * @var RemoteAdapterInterface
     */
    protected $remoteAdapter = null;

    /**
     * @param string                 $module
     * @param string                 $operation
     * @param array                  $parameters
     * @param array                  $data
     * @param array                  $headers
     * @param RemoteAdapterInterface $remoteAdapter
     */
    public function __construct(
      $module,
      $operation,
      array $parameters = array(),
      array $data = array(),
      array $headers = array(),
      RemoteAdapterInterface $remoteAdapter = null
    ) {
        $this->module        = $module;
        $this->operation     = $operation;
        $this->parameters    = $parameters;
        $this->data          = $data;
        $this->headers       = $headers;
        $this->remoteAdapter = $remoteAdapter;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function execute()
    {
        return $this->remoteAdapter->call($this);
    }

    /**
     * @param MultiCallQueueInterface $queue
     * @param callable                $callback
     *
     * @return mixed|void
     */
    public function addToQueue(MultiCallQueueInterface $queue, $callback = null)
    {
        $queue->addAction($this, $callback);
    }
}
