<?php

namespace App\Entities;

class Tree
{
    private static $instance;
    private Node $root;
    private Node $node;

    private function __construct(){}

    //lazy instantiation version
    public static function getInstance(): Tree
    {
        if (self::$instance == null) {
            self::$instance  = new Tree();
        }
        return self::$instance;
    }

    public function build(array $operandsStack, string $token)
    {

    }

    public function getRoot(): Node
    {
        return $this->root;
    }

    public function setRoot(Node $root): Tree
    {
        $this->root = $root;
        return $this;
    }

    public function getNode(): Node
    {
        return $this->node;
    }

    public function setNode(Node $node): Tree
    {
        $this->node = $node;
        return $this;
    }

}