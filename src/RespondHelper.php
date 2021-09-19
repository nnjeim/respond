<?php

namespace Nnjeim\Respond;

use Nnjeim\Respond\RespondBuilder;
use Nnjeim\Respond\RespondInterface;

use Illuminate\Http\JsonResponse;

class RespondHelper extends RespondBuilder implements RespondInterface {

    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;
    public const HTTP_ACCEPTED = 202;
    public const HTTP_NO_CONTENT = 204;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;
    public const HTTP_NOT_FOUND = 404;
    public const HTTP_UNPROCESSABLE_ENTITY = 422;
    public const HTTP_INTERNAL_SERVER_ERROR = 500;

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

	/**
	 * @param  null  $data
	 * @return array|JsonResponse
	 */
	public function withSuccess($data = null)
    {
        $this->success = true;

        $this->status ??= self::HTTP_OK;

        if ($data !== null) {

            $this->setData($data);
        }

        return $this->respond();
    }

	/**
	 * @param  array|null  $errors
	 * @return array|JsonResponse
	 */
	public function withErrors(?array $errors = null)
    {
        $this->success = false;

        $this->status ??= self::HTTP_UNPROCESSABLE_ENTITY;

        $this->message ??= trans('respond::messages.exceptions.unprocessable_entity');

        if ($errors !== null) {

            $this->errors = $errors;
        }

        return $this->respond();
    }

	/**
	 * @return array|JsonResponse
	 */
	public function withNoContent()
    {
        $this->success = true;

        $this->status ??= self::HTTP_NO_CONTENT;

        $this->message ??= trans('respond::messages.exceptions.no_content');

        $this->errors ??= [[$this->message]];

        return $this->respond();
    }

	/**
	 * @return array|JsonResponse
	 */
	public function withServerError()
    {
        $this->success = false;

        $this->status ??= self::HTTP_INTERNAL_SERVER_ERROR;

        $this->message ??= trans('respond::messages.exceptions.server_error');

        $this->errors ??= [[$this->message]];

        return $this->respond();
    }

	/**
	 * @param  string|null  $attribute
	 * @param  bool  $plural
	 * @return array|JsonResponse
	 */
	public function withNotFound(?string $attribute = null, bool $plural = true)
    {
        $this->success = false;

        $this->status ??= self::HTTP_NOT_FOUND;

        $defaultAttribute = trans('respond::messages.record.singular');

        $error = trans('respond::messages.exceptions.not_found', [
            'attribute' => $attribute ?? $defaultAttribute
        ]);

        $this->errors = [[$error]];

        return $this->respond();
    }

	/**
	 * @return array|JsonResponse
	 */
	public function withNotAuthenticated()
    {
        $this->success = false;

        $this->status ??= self::HTTP_UNAUTHORIZED;

        $this->errors ??= [[trans('respond::messages.exceptions.not_authenticated')]];

        return $this->respond();
    }

	/**
	 * @return array|JsonResponse
	 */
	public function withNotAuthorized()
    {
        $this->success = false;

        $this->status ??= self::HTTP_FORBIDDEN;

        $this->errors ??= [[trans('respond::messages.exceptions.not_authorized')]];

        return $this->respond();
    }
}
