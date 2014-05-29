<?php

namespace Smalot\Drupal\Modules\Services;

use Smalot\Drupal\Modules\ModuleAbstract;

/**
 * Class Node
 *
 * @package Smalot\Drupal\Actions\Services
 */
class Node extends ModuleAbstract
{
    /**
     * @return string
     */
    protected function getModule()
    {
        return 'node';
    }

    /**
     * @param $node
     *
     * @return \Smalot\Drupal\ActionInterface
     */
    public function create($node)
    {
        return $this->__createAction('create', array(), array('node' => $node));
    }

    /**
     * @param $node
     *
     * @return \Smalot\Drupal\ActionInterface
     */
    public function update($node)
    {
        $node = (array) $node;
        
        return $this->__createAction('update', array($node['nid']), array('node' => $node));
    }

    /**
     * @param $nid
     *
     * @return \Smalot\Drupal\ActionInterface
     */
    public function retrieve($nid)
    {
        return $this->__createAction('retrieve', array($nid));
    }

    /**
     * @param $nid
     *
     * @return \Smalot\Drupal\ActionInterface
     */
    public function delete($nid)
    {
        return $this->__createAction('delete', array($nid));
    }
}
