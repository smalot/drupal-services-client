<?php

namespace Smalot\Drupal\Services\Transport;

use Smalot\Drupal\Services\Security\Session;

/**
 * Class Rest
 *
 * @package Smalot\Drupal\Services\Transport
 */
class Rest implements TransportInterface
{
    /**
     * @var
     */
    protected $url;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param string $url
     * @param array  $options
     */
    public function __construct($url, $options = array())
    {
        $this->url     = $url;
        $this->options = $options;
    }

    /**
     * @param RequestInterface $request
     *
     * @return mixed
     * @throws \Exception
     */
    public function call(RequestInterface $request)
    {
        // Global values.
        $options = $this->options;

        // Local values.
        $options[CURLOPT_HEADER]         = 0;
        $options[CURLOPT_RETURNTRANSFER] = 1;
        $options[CURLOPT_FAILONERROR]    = 0;

        // Set header, url and method.
        $this->prepareRequestMethod($request, $options);

        // Set data.
        $this->prepareRequestData($request, $options);

        // Set cookie and add header security token.
        $this->prepareRequestSecurity($request, $options);

        // Use curl to call remote server.
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $content   = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Handle response code.
        if ($http_code == 0 || $http_code >= 400) {
            if ($http_code) {
                if ($json = json_decode($content, true)) {
                    $message = current($json);
                } else {
                    $message = $content;
                }
            } else {
                $message = 'Invalid ending point.';
            }

            throw new TransportException($message, $http_code);
        }

        // Decode json response.
        $json = json_decode($content, true);

        return $json;
    }

    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function multiCall(RequestInterface $request)
    {
        return $this->call($request);
    }

    /**
     * @param RequestInterface $request
     * @param                  $options
     */
    protected function prepareRequestMethod(RequestInterface $request, &$options)
    {
        $action     = $request->getAction();
        $operation  = $action->getOperation();
        $parameters = $action->getParameters();
        $url        = $this->url . '/' . $action->getModule();

        switch (strtolower($operation)) {
            case 'delete':
                $customRequest = 'DELETE';
                break;

            case 'update':
                $customRequest = 'PUT';
                break;

            case 'index':
            case 'retrieve':
            case 'relationships':
                $customRequest = 'GET';
                break;

            case 'create':
                $customRequest = 'POST';
                break;

            default:
                $customRequest = 'POST';
                $url .= '/' . $operation;
        }

        $options[CURLOPT_HTTPHEADER]    = array(
          'Content-Type: application/json',
          'Accept: application/json',
        );
        $options[CURLOPT_URL]           = $url . (count($parameters) ? '/' . implode('/', $parameters) : '');
        $options[CURLOPT_CUSTOMREQUEST] = $customRequest;
    }

    /**
     * @param RequestInterface $request
     * @param                  $options
     */
    protected function prepareRequestData(RequestInterface $request, &$options)
    {
        $action = $request->getAction();
        $data   = $action->getData();

        if ($data) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }
    }

    /**
     * @param RequestInterface $request
     * @param                  $options
     */
    protected function prepareRequestSecurity(RequestInterface $request, &$options)
    {
        $security = $request->getSecurity();

        // Add security identification.
        if ($security instanceof Session && $security->isLogged()) {
            $options[CURLOPT_HTTPHEADER][] = 'X-CSRF-Token: ' . $security->getCsrfToken();
            $options[CURLOPT_COOKIE]       = $security->getSessionId();
        }
    }
}
