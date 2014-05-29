<?php

namespace Smalot\Drupal\Modules\Services;

use Smalot\Drupal\Modules\ModuleAbstract;

/**
 * Class User
 *
 * @package Smalot\Drupal\Actions\Services
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

    public function create()
    {

    }

    public function update()
    {

    }

    public function retrieve()
    {

    }

    public function delete()
    {

    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return \Smalot\Drupal\ActionInterface
     */
    public function login($username, $password)
    {
        return $this->__createAction('login', array(), array('username' => $username, 'password' => $password));
    }

    /**
     * @return \Smalot\Drupal\ActionInterface
     */
    public function logout()
    {
        return $this->__createAction('logout');
    }

    /**
     * @param $user
     *
     * @return \Smalot\Drupal\ActionInterface
     */
    public function register($user)
    {
        return $this->__createAction('register', array(), $user);
    }
}
