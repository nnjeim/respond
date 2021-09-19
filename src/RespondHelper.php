<?php

namespace Nnjeim\Respond;

use Nnjeim\Respond\RespondBuilder;
use Nnjeim\Respond\RespondInterface;

use Illuminate\Http\JsonResponse;

class RespondHelper extends RespondBuilder implements RespondInterface {
	/**
	 * @param  string  $message
	 * @return $this
	 */
	public function setMessage(string $message): self
	{
		$this->message = $message;

		return $this;
	}

	/**
	 * @param $data
	 * @return $this
	 */
	public function setData($data): self
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * @param  array  $meta
	 * @return $this
	 */
	public function setMeta(array $meta): self
	{
		$this->meta = $meta;

		return $this;
	}

	/**
	 * @param  array  $errors
	 * @return $this
	 */
	public function setErrors(array $errors): self
	{
		$this->errors = $errors;

		return $this;
	}

	/**
	 * @param  int  $code
	 * @return $this
	 */
	public function setStatusCode(int $code): self
    {
        $this->status = $code;

        return $this;
    }

	/**
	 * @return $this
	 */
	public function toJson(): self
    {
        $this->json = true;

        return $this;
    }
}
