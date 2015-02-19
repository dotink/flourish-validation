<?php namespace Dotink\Lab
{
	use Dotink\Flourish\Monitor;
	use Dotink\Flourish\ValidationInterface;

	return [
		'setup' => function($data, $shared) {
				needs($data['root'] . '/src/Monitor.php');
				needs($data['root'] . '/src/ValidationInterface.php');

				class Test implements ValidationInterface
				{
					public function validate(array $messages, Monitor $monitor) {
						return ['name' => 'Your name is invalid'];
					}
				}
		},

		'tests' => [

			/**
			 *
			 */
			'Simple Test' => function($data, $shared)
			{
				$monitor = new Monitor();
				$monitor->addAsset('test', new Test());

				assert('Dotink\Flourish\Monitor::scan')
					-> using($monitor)
					-> with(TRUE)
					-> equals(['test' => ['name' => 'Your name is invalid']])
				;

				$monitor->setFormatter(function($message) {
						?><div class="error"><?= $message ?></div><?php
				});

				assert('Dotink\Flourish\Monitor::scan')
					-> using($monitor)
					-> with(TRUE)
					-> equals(['test' => ['name' => '<div class="error">Your name is invalid</div>']])
				;
			}
		]
	];
}
