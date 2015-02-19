<?php namespace Dotink\Flourish
{
	/**
	 * Employed by any asset which can be validated
	 *
	 * @copyright Copyright (c) 2015, Matthew J. Sahagian
	 * @author Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license Please reference the LICENSE.md file at the root of this distribution
	 *
	 * @package Flourish
	 */
	interface ValidationInterface
	{
		/**
		 * Validate an asset
		 *
		 * @access public
		 * @param array $message The existing messages for the asset alias
		 * @param Monitor $monitor The validation monitor for extending validation to related assets
		 * @return array The new messages for the asset alias (add or remove per validation)
		 */
		public function validate(array $messages, Monitor $monitor);
	}
}
