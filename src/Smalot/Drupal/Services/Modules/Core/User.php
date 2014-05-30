<?php

namespace Smalot\Drupal\Services\Modules\Core;

use Smalot\Drupal\Services\Modules\ModuleAbstract;

/**
 * Class User
 *
 * @package Smalot\Drupal\Services\Actions\Core
 */
class User extends ModuleAbstract
{
    /**
     * @return string
     */
    protected function getModule()
    {
        return 'user';
    }

    /**
     * @param array $user
     *
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function create($user)
    {
        return $this->__createAction('create', array(), array('user' => $user));
    }

    /**
     * @param array $user
     *
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function update($user)
    {
        $user = (array) $user;

        return $this->__createAction('update', array($user['uid']), array('user' => $user));
    }

    /**
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function index()
    {
        return $this->__createAction('index');
    }

    /**
     * @param int $uid
     *
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function retrieve($uid)
    {
        return $this->__createAction('retrieve', array($uid));
    }

    /**
     * @param int $uid
     *
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function delete($uid)
    {
        return $this->__createAction('delete', array($uid));
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function login($username, $password)
    {
        return $this->__createAction('login', array(), array('username' => $username, 'password' => $password));
    }

    /**
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function logout()
    {
        return $this->__createAction('logout');
    }

    /**
     * @param array $user
     *
     * @return \Smalot\Drupal\Services\ActionInterface
     */
    public function register($user)
    {
        return $this->__createAction('register', array(), $user);
    }
}
