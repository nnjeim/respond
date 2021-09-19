<?php

namespace Nnjeim\Respond;

use Nnjeim\Respond\RespondException;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Exception;

abstract class RespondBuilder
{
	protected array $attributes = [];

	/**
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->attributes[$key] ?? null;
	}

	/**
	 * @param $key
	 * @param $value
	 */
	public function __set($key, $value)
	{
		$this->attributes[$key] = $value;
	}

	/**
	 * @param $method
	 * @param  null  $args
	 * @return array|JsonResponse
	 * @throws Exception
	 */
	public function __call($method, $args = null)
	{
		if (Str::contains($method, 'with')) {

			return $this->withResponder($method, ...$args);
		}

		throw RespondException::methodNotFoundException($method);
	}

	/**
	 * @param  string  $method
	 * @param  null  $args
	 * @return array|JsonResponse
	 * @throws Exception
	 */
	public function withResponder(string $method, $args = null) {

		$key = strtolower(Str::after($method, 'with'));

		$responses = config('respond.responses');

		if (! array_key_exists($key, $responses)) {
			throw RespondException::methodNotFoundException($method);
		}

		['success' => $success, 'message' => $message, 'status' => $status]
			= $responses[$key]
			+ ['message' => null];

		/*-- set success --*/
		$this->success = $success;
		/*-- set message --*/
		if (isset($message)) {
			$this->message ??= trans("respond::$message");
		}
		/*-- set status --*/
		$this->status ??= $status;

		return $this->respond();
	}

	/**
	 * @return array|JsonResponse
	 */
	public function respond()
	{
		$this->formResponse();

		['response' => $response, 'status' => $status] = $this->attributes;

		return ($this->json === null && !config('respond.toJson'))
			? compact('response', 'status')
			: response()->json($response, $status);
	}

	private function formResponse(): void
	{
		$response = [
			'success' => false,
			'data' => [],
			'errors' => [],
		];

		if ($this->success !== null) {
			$response = array_merge($response, [
				'success' => $this->success,
			]);
		}

		if ($this->message !== null) {
			$response = array_merge([
				'message' => $this->message,
			], $response);
		}

		if ($this->data !== null) {
			$response = array_merge($response, [
				'data' => $this->data
			]);
		}

		if ($this->errors !== null) {
			$response = array_merge($response, [
				'errors' => $this->errors
			]);
		}

		if ($this->meta !== null) {
			$response = array_merge($response, $this->meta);
		}

		$this->response = $response;
	}
}
