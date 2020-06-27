<?php


namespace App\Tests\Entities;


use App\Entities\Tree;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    private Tree $tree;
    public function setUp(): void
    {
        $this->tree = Tree::getInstance();
    }

//    public function
}