<?php

namespace Nnjeim\Respond\Tests;

use Nnjeim\Respond\RespondServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	public function setUp(): void
	{
		parent::setUp();
		// additional setup
	}

	protected function getPackageProviders($app)
	{
		return [
			RespondServiceProvider::class,
		];
	}

	protected function getEnvironmentSetUp($app)
	{
		// perform environment setup
	}
}
