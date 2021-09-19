<?php

namespace Nnjeim\Respond;

use Exception;

class RespondException extends Exception
{
	/**
	 * @param  string  $method
	 * @return static
	 */
	public static function methodNotFoundException(string $method) {

		return new static(trans('respond::messages.exceptions.method_not_found', compact('method')));
	}
}
