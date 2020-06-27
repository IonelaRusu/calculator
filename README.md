# CLI RPN Calculator

This is a command-line reverse polish notation (RPN) calculator for Unix CLI utilities.

## Installation

```
composer install
```
## Short description of calculator interface structure
The entry point of this calculator application is the "run.php" script. The script opens the "php://stdin" 
(an already opened stream to stdin) in read mode, in order to create a file descriptor. This file descriptor is basically 
the parameter send to calculator application. In this way the file descriptor can come from opening a socket or a file,
without affecting further the implementation.

Calculator class has 4 functions: start, stop, display operator, display calculation result, like a real calculator.
It displays the operands you introduce if you write them one on a line and displays the calculation result of your hole 
expression when you introduce the last operator at the end of a line, or one on the line.

Start function processes the received input so that all operands and operators to be correct as type, or in a logical
order for a postfix expression. If all is correctly introduced, then the expression processing stage can begin. 

Stop function it exits you from calculator, when you press "q", CTRL+D, or find EOF, and also exits you when you get an 
error of your wrong expression.

## Important concepts:
   - application is based on a stack structure and a binary tree structure.
   - the stack holds node object.
   - a node object has a value, a left child and a right child (other nodes)
   - there are 2 types of node: operator(ex: - , +) and operands(ex: 2, 3)
   - the mathematical expression is represented through a tree with these node types
   - the expression is build in stack, with the help of a tree structure for components correct orders
   
##About implementation
Calculator class calls the expression process function.
Expression class uses Dependency Injection Design Pattern (Constructor Injection) and it can be created through an
expression validator. This validator verifies the Calculator node stack to contain elements that do not contradict the 
logical of current expression.
 
If everything is ok, the nodes are created with Factory Design Pattern, based on their
type. Based on "operator" vs "operand" type the operand node is created, however the "operand" node contains a nested 
factory and is created on the "operator value type: - + / *". This nestead factory in factory can be easily evolved into 
an Abstract Factory Design Pattern if the "operand" numerical type will ever be extended.

After the right node instance is created, we get the tree instance, which will be always the same one due to Singleton 
Design Pattern. If the node is "operand" type it is added into the node stack, otherwise if the node is "operator" type, then 
2 "operand" nodes are popped out from node stack and the tree is build. The root of the tree will always be an "operator" 
node, the last added to node stack.

The tree is built with an "operator" node as root, and root has the right child the first "operand" node popped out from 
stack, and as a left child the second "operand" node popped out. The root node of the tree is push back in the node stack.

When the expression can be calculated, due to a current correct structure, the tree is traverse in post order(LRN):
    - traverse the left subtree by recursively calling the post-order function
    - traverse the right subtree by recursively calling the post-order function
    - access the data from the current node
In the traversal time, all accepted types of node are visited by a NodeVisitor, implementend through Visitor Design Pattern.
In the visit stage of an "operator" node, between the left and right children, the chosen operation is applied. Their 
result is store in "operator" node value, this changing as a value in an "operand" node for the upper levels of the tree. 
Finally, in the "operator" root node, the result of hole expression will be stored.

In node stack this root node is still kept, due to further operations with this result. By accessing the last node value
from the node stack, the result will be displayed.


## How to run application

```
php run.php
```


## How to run application

```
./vendor/bin/phpunit App/Tests/
```

