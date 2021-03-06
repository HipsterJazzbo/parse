<?php

namespace Psecio\Parse\Tests;

/**
 * Be sure you're not using an echo with a file_get_contents
 */
class TestEchoWithFileGetContents extends \Psecio\Parse\Test
{
	protected $description = 'Using `echo` with results of `file_get_contents` could lead to injection issues. ';

	public function evaluate($node, $file = null)
	{
		$node = $node->getNode();
		if ($node instanceof \PhpParser\Node\Stmt\Echo_) {
			if (isset($node->exprs[0]) && $node->exprs[0] instanceof \PhpParser\Node\Expr\BinaryOp\Concat) {

				// Check the right side
				$right = $node->exprs[0]->right;
				if ($right instanceof \PhpParser\Node\Expr\FuncCall && $right->name == 'file_get_contents') {
					return false;
				}

				// Check the left side
				$left = $node->exprs[0]->left;
				if ($left instanceof \PhpParser\Node\Expr\FuncCall && $left->name == 'file_get_contents') {
					return false;
				}
			}
		}

		return true;
	}
}