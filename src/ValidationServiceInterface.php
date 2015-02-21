<?php namespace Dotink\Flourish
{
	/**
	 * Employed by any service which can validate assets
	 *
	 * @copyright Copyright (c) 2015, Matthew J. Sahagian
	 * @author Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license Please reference the LICENSE.md file at the root of this distribution
	 *
	 * @package Flourish
	 */
	interface ValidationServiceInterface
	{
		/**
		 * Validate an asset
		 *
		 * @access public
		 * @param Monitor $monitor The validation monitor
		 * @return void
		 */
		public function validate(Monitor $monitor);
	}
}
