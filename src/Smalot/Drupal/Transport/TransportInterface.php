<?php

namespace Smalot\Drupal\Transport;

/**
 * Interface TransportInterface
 *
 * @package Smalot\Drupal\Transport
 */
interface TransportInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function call(RequestInterface $request);

    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function multiCall(RequestInterface $request);
}
