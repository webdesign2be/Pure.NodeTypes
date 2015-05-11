<?php
namespace Pure\NodeTypes\TypoScript;

use TYPO3\TypoScript\TypoScriptObjects\RawArrayImplementation;

/**
 * Class ValueOptionsListImplementation
 *
 * Usage:
 *
 * selectOptions = Pure.NodeTypes:ValueOptionsList {
 *      value = ${q(node).property('selectOptions')}
 * }
 *
 * where `value` is multi-line options list in format:
 * ```
 * = Label for empty value
 * value1 = Label 1
 * value2 = Label 2
 * Label which is also value
 * ```
 *
 * This will generate array in format value => label.
 *
 * @see Pure.NodeTypes:FormInputSelect
 *
 * @package Pure\NodeTypes\TypoScript
 */
class ValueOptionsListImplementation extends RawArrayImplementation {

	public function evaluate() {
		$optionsList = array();

		$lines = explode(chr(10), $this->tsValue('value'));

		foreach ($lines as $line) {
			$arr = explode('=', $line);
			$value = trim(array_shift($arr));
			$label = ($l = trim(array_shift($arr))) ? $l : $value;
			$optionsList[$value] = $label;
		}

		return $optionsList;
	}
}
