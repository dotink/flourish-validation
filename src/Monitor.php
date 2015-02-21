<?php namespace Dotink\Flourish
{
	/**
	 * The monitor is responsible for aggregating validation assets and collecting their output
	 *
	 * @copyright Copyright (c) 2015, Matthew J. Sahagian
	 * @author Matthew J. Sahagian [mjs] <msahagian@dotink.org>
	 *
	 * @license Please reference the LICENSE.md file at the root of this distribution
	 *
	 * @package Flourish
	 */
	class Monitor
	{
		const MSG_FIX_ERRORS = 'Please check the submitted data and try again';

		/**
		 * A callable formatter for formatting validation messages
		 *
		 * @access protected
		 * @var callable
		 */
		protected $formatter = NULL;


		/**
		 * Create a new validation monitor
		 *
		 * @access public
		 * @return void
		 */
		public function __construct()
		{
			$this->formatter = function($message) {
				echo $message;
			};
		}


		/**
		 * Add a new ValidationAssetInterface object to the monitor as an aliased asset
		 *
		 * @access public
		 * @param string $alias The alias for the object
		 * @param ValidationAssetInterface $asset The object which can validate
		 * @return Monitor The called instance for method chaining
		 */
		public function addAsset($alias, ValidationAssetInterface $asset)
		{
			$this->assets[$alias] = $asset;

			$this->addCallback($alias, [$asset, 'validate']);

			return $this;
		}


		/**
		 * Add a new callback associate with an alias/asset
		 *
		 * @access public
		 * @param string|ValidationInterface $asset The asset with which to associate the callback
		 * @param callable $callback The callback to handle additional validation
		 * @return Monitor The called instance for method chaining
		 */
		public function addCallback($asset, callable $callback)
		{
			$alias = $asset;

			if ($asset instanceof ValidationInterface) {
				$alias = array_search($asset, $this->assets);
			}

			settype($alias, 'string');

			if (!isset($this->callbacks[$alias])) {
				$this->callbacks[$alias] = array();
			}

			$this->callbacks[$alias][] = $callback;
		}


		/**
		 * Add a new ValidationServiceInterface object to the monitor
		 *
		 * @access public
		 * @param ValidationServiceInterface $service The service which canvalidate
		 * @return Monitor The called instance for method chaining
		 */
		public function addService(ValidationServiceInterface $service)
		{
			if (!in_array($service, $this->services)) {
				$this->services[] = $service;
			}

			$this->addCallback(NULL, [$service, 'validate']);

			return $this;
		}


		/**
		 * Check if a message exists for a particular alias
		 *
		 * @access public
		 * @param string $alias The asset alias to check
		 * @param string $message The message name to check
		 * @return boolean TRUE if the message exists, FALSE otherwise
		 */
		public function check($alias, $message)
		{
			return isset($this->messages[$alias][$message]);
		}


		/**
		 * Outputs a validation message to the screen with an optional formatting callback
		 *
		 * @access public
		 * @param string $alias The asset alias to compose
		 * @param string $message The message name to compose
		 * @param callable $formatter A callable formatter to output the message
		 * @return void
		 */
		public function compose($alias, $message, callable $formatter = NULL)
		{
			$formatter = $formatter ?: $this->formatter;

			if ($this->check($alias, $message)) {
				ob_start();
				$formatter($this->messages[$alias][$message]);

				return ob_get_clean();
			}

			return NULL;
		}


		/**
		 * Get all the monitored assets keyed by alias
		 *
		 * @access public
		 * @return array The monitored assets keyed by alias
		 */
		public function getAssets()
		{
			return $this->assets;
		}


		/**
		 * Ignore certain validation messages
		 *
		 * This is useful if there are known instances where you do not have a value yet but you
		 * will post-validation.
		 *
		 * @access public
		 * @param string $alias The asset alias to ignore
		 * @param array $messages A list of messages to ignore
		 * @return Monitor The called instance for method chaining
		 */
		public function ignore($alias, array $messages)
		{
			$this->ignores = array_merge($this->ignores, [$alias => $messages]);

			return $this;
		}


		/**
		 * Set a validation message for a given alias and message name
		 *
		 * @access public
		 * @param string $alias The alias to set the message on
		 * @param string $message The message name or identifier
		 * @param string $value The value for the message
		 * @return Monitor The called instanced for method chaining
		 */
		public function setMessage($alias, $message, $value)
		{
			if (!isset($this->ignores[$alias]) || !in_array($message, $this->ignores[$alias])) {
				if (!isset($this->messages[$alias])) {
					$this->messages[$alias] = array();
				}

				$this->messages[$alias][$message] = $value;
			}

			return $this;
		}


		/**
		 * Scan all assets for validation errors
		 *
		 * @access public
		 * @param boolean $return_messages Whether or not messages should be returned
		 * @return array An array of formatted messages keyed by alias => $message
		 */
		public function scan($return_messages = FALSE)
		{
			$this->messages = array();

			reset($this->callbacks);

			do {
				$alias = key($this->callbacks);

				reset($this->callbacks[$alias]);

				do {
					$callback = current($this->callbacks[$alias]);

					if (!$alias) {
						$callback($this);
					} else {
						$callback($this, $alias);
					}

				} while(next($this->callbacks[$alias]));

			} while (next($this->callbacks));

			if ($return_messages) {
				foreach (array_keys($this->messages) as $alias) {
					foreach (array_keys($this->messages[$alias]) as $message) {
						$this->messages[$alias][$message] = $this->compose($alias, $message);
					}
				}

				return $this->messages;
			}

			if (count($this->messages)) {
				throw new ValidationException(self::MSG_FIX_ERRORS);
			}
		}


		/**
		 * Set a formatter for the validation messages
		 *
		 * @access public
		 * @param callable $formatter The formatter callback to use to format messages
		 * @return void
		 */
		public function setFormatter(callable $formatter)
		{
			$this->formatter = $formatter;
		}
	}
}
