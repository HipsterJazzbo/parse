<?php

namespace Psecio\Parse\Tests;

/**
 * The ereg functions have been deprecated as of PHP 5.3.0
 * Don't use them!
 */
class TestNoEregFunctions extends \Psecio\Parse\Test
{
	private $functions = array(
		'ereg', 'eregi', 'ereg_replace', 'eregi_replace'
	);

	protected $description = 'Remove any use of ereg functions, deprecated and removed. Use preg_*';

	public function evaluate($node, $file = null)
	{
		$node = $node->getNode();
		$nodeName = (is_object($node->name)) ? $node->name->parts[0] : $node->name;

		if (get_class($node) == "PhpParser\\Node\\Expr\\FuncCall" && in_array(strtolower($nodeName), $this->functions)) {
			return false;
		}
		return true;
	}
}