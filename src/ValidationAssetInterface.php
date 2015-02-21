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
	interface ValidationAssetInterface
	{
		/**
		 * Validate an asset
		 *
		 * @access public
		 * @param Monitor $monitor The validation monitor
		 * @param string $alias Thea alias for which this asset is registered
		 * @return void
		 */
		public function validate(Monitor $monitor, $alias);
	}
}
