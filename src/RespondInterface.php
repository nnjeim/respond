<?php

namespace Nnjeim\Respond;

interface RespondInterface
{
	/**
	 * @param  string  $message
	 * @return self
	 */
	public function setMessage(string $message): self;

	/**
	 * @param $data
	 * @return self
	 */
	public function setData($data): self;

	/**
	 * @param  array  $meta
	 * @return self
	 */
	public function setMeta(array $meta): self;

	/**
	 * @param  array  $errors
	 * @return self
	 */
	public function setErrors(array $errors): self;

	/**
	 * @param  int  $code
	 * @return self
	 */
	public function setStatusCode(int $code): self;
}
