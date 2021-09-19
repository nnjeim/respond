<?php

namespace Nnjeim\Respond;

use Illuminate\Http\JsonResponse;

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
	 * @return array|JsonResponse
	 */
	public function respond()
	{
		$this->formatResponse();

		['response' => $response, 'status' => $status] = $this->attributes;

		return ($this->json === null) ? compact('response', 'status') : response()->json($response, $status);
	}

	private function formatResponse(): void
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
