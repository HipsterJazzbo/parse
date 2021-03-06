<?php

namespace Psecio\Parse\Tests;

/**
 * Don't use $GLOBALS, know where your data is coming from
 */
class TestAvoidGlobalsUse extends \Psecio\Parse\Test
{
	protected $description = 'The use of $GLOBALS should be avoided.';

	public function evaluate($node, $file = null)
	{
		$node = $node->getNode();
		if ($node instanceof \PhpParser\Node\Expr\Variable && $node->name == 'GLOBALS') {
			return false;
		}
		return true;
	}
}