<?php

namespace Smalot\Drupal\Services;

use Smalot\Drupal\Services\Security\SecurityInterface;
use Smalot\Drupal\Services\Transport\Request;
use Smalot\Drupal\Services\Transport\TransportInterface;

/**
 * Class RemoteAdapter
 *
 * @package Smalot\Drupal\Services
 */
class RemoteAdapter implements RemoteAdapterInterface
{
    /**
     * @var SecurityInterface
     */
    protected $security;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @param SecurityInterface  $security
     * @param TransportInterface $transport
     */
    public function __construct(SecurityInterface $security, TransportInterface $transport)
    {
        $this->security  = $security;
        $this->transport = $transport;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->logout();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function login()
    {
        return $this->security->login($this->transport);
    }

    /**
     * @return bool
     */
    public function logout()
    {
        return $this->security->logout($this->transport);
    }

    /**
     * @throws RemoteAdapterException
     */
    protected function checkSecurity()
    {
        if (!$this->security->isLogged()) {
            $this->login();
        }
    }

    /**
     * @param ActionInterface $action
     * @param bool            $throwsException
     *
     * @return array|false
     * @throws \Exception
     */
    public function call(ActionInterface $action, $throwsException = true)
    {
        try {
            $this->checkSecurity();

            $request  = new Request($action, $this->security);
            $response = $this->transport->call($request);

            return $response;

        } catch (\Exception $e) {
            if ($throwsException) {
                throw $e;
            }

            return false;
        }
    }

    /**
     * @param MultiCallQueueInterface $queue
     * @param bool                    $throwsException
     *
     * @return array|false
     * @throws \Exception
     */
    public function multiCall(MultiCallQueueInterface $queue, $throwsException = true)
    {
        try {
            $this->checkSecurity();

            $actions  = $this->getActions($queue);
            $action   = new Action('system', 'multicall', array(), $actions);
            $request  = new Request($action, $this->security);
            $response = $this->transport->multiCall($request);

            $this->handleCallbacks($queue, $response);

            return $response;

        } catch (\Exception $e) {
            if ($throwsException) {
                throw $e;
            }

            return false;
        }
    }

    /**
     * @param MultiCallQueueInterface $queue
     *
     * @return array
     */
    protected function getActions(MultiCallQueueInterface $queue)
    {
        $actions = array();

        foreach ($queue as $item) {
            $action = $item['action'];

            /** @var $action ActionInterface */
            $actions[] = array(
              $action->getMethod(),
              $action->getArguments(),
            );
        }

        return $actions;
    }

    /**
     * @param MultiCallQueueInterface $queue
     * @param array                   $results
     */
    protected function handleCallbacks(MultiCallQueueInterface $queue, $results)
    {
        foreach ($queue as $position => $item) {
            $callback = $item['callback'];

            if (is_callable($callback)) {
                call_user_func($callback, $results[$position]);
            }
        }
    }
}
