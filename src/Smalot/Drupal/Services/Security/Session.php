<?php

namespace Smalot\Drupal\Services\Security;

use Smalot\Drupal\Services\Modules\Core\User;
use Smalot\Drupal\Services\Transport\Request;
use Smalot\Drupal\Services\Transport\TransportException;
use Smalot\Drupal\Services\Transport\TransportInterface;

/**
 * Class Session
 *
 * @package Smalot\Drupal\Services\Security
 */
class Session implements SecurityInterface
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var array
     */
    protected $data;


    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->data     = array();
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        return (!empty($this->data));
    }

    /**
     * @param TransportInterface $transport
     *
     * @return bool
     * @throws TransportException
     */
    public function login(TransportInterface $transport)
    {
        $user       = new User(null);
        $action     = $user->login($this->username, $this->password);
        $request    = new Request($action, new Anonymous());
        $this->data = $transport->call($request);

        return true;
    }

    /**
     * @return array|null
     */
    public function getUser()
    {
        if ($this->isLogged()) {
            return $this->data['user'];
        }

        return null;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return ($this->isLogged() ? $this->data['session_name'] . '=' . $this->data['sessid'] : '');
    }

    /**
     * @return string
     */
    public function getCsrfToken()
    {
        return ($this->isLogged() ? $this->data['token'] : '');
    }

    /**
     * @param TransportInterface $transport
     *
     * @return bool
     */
    public function logout(TransportInterface $transport)
    {
        if ($this->isLogged()) {
            $user    = new User(null);
            $action  = $user->logout();
            $request = new Request($action, $this);
            $transport->call($request);
            $this->data = array();

            return true;
        }

        return false;
    }
}
