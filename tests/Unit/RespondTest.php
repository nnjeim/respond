<?php

namespace Nnjeim\Respond\Tests\Unit;

use Nnjeim\Respond\RespondException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Nnjeim\Respond\Tests\TestCase;
use Nnjeim\Respond\Respond;
use Illuminate\Support\Facades\Config;

class RespondTest extends TestCase
{
	use WithFaker;

	/** @test */
	function can_respond_with_success()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setData($this->fakeData())->withSuccess();

		self::assertTrue($respond['response']['success'] === true);
		self::assertNotEmpty($respond['response']['data']);
		self::assertTrue($respond['status'] === Response::HTTP_OK);
	}

	/** @test */
	function can_respond_with_created()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setData($this->fakeData())->withCreated();

		self::assertTrue($respond['response']['success'] === true);
		self::assertNotEmpty($respond['response']['data']);
		self::assertTrue($respond['status'] === Response::HTTP_CREATED);
	}

	/** @test */
	function can_respond_with_accepted()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setData($this->fakeData())->withAccepted();

		self::assertTrue($respond['response']['success'] === true);
		self::assertNotEmpty($respond['response']['data']);
		self::assertTrue($respond['status'] === Response::HTTP_ACCEPTED);
	}

	/** @test */
	function can_respond_with_errors()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setErrors($this->fakeErrors())->withErrors();

		self::assertTrue($respond['response']['success'] === false);
		self::assertNotEmpty($respond['response']['errors']);
		self::assertTrue($respond['status'] === Response::HTTP_UNPROCESSABLE_ENTITY);
	}

	/** @test */
	function can_respond_with_no_content()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setMessage($this->faker->sentence())->withNoContent();

		self::assertTrue($respond['response']['success'] === true);
		self::assertTrue($respond['status'] === Response::HTTP_NO_CONTENT);
	}

	/** @test */
	function can_respond_with_server_error()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setErrors($this->fakeErrors())->withServerError();

		self::assertTrue($respond['response']['success'] === false);
		self::assertNotEmpty($respond['response']['errors']);
		self::assertTrue($respond['status'] === Response::HTTP_INTERNAL_SERVER_ERROR);
	}

	/** @test */
	function can_respond_with_not_found()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setErrors($this->fakeErrors())->withNotFound();

		self::assertTrue($respond['response']['success'] === false);
		self::assertNotEmpty($respond['response']['errors']);
		self::assertTrue($respond['status'] === Response::HTTP_NOT_FOUND);
	}

	/** @test */
	function can_respond_with_not_authenticated()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setErrors($this->fakeErrors())->withNotAuthenticated();

		self::assertTrue($respond['response']['success'] === false);
		self::assertNotEmpty($respond['response']['errors']);
		self::assertTrue($respond['status'] === Response::HTTP_UNAUTHORIZED);
	}

	/** @test */
	function can_respond_with_not_authorized()
	{
		$this->setToJsonToFalse();
		$respond = Respond::setErrors($this->fakeErrors())->withNotAuthorized();

		self::assertTrue($respond['response']['success'] === false);
		self::assertNotEmpty($respond['response']['errors']);
		self::assertTrue($respond['status'] === Response::HTTP_FORBIDDEN);
	}

	/** @test */
	function respond_can_set_status_code()
	{
		$statusCode = mt_rand(200, 300);

		$respond = Respond::setStatusCode($statusCode)->withSuccess();

		self::assertTrue($respond->getStatusCode() === $statusCode);
	}

	/** @test */
	function respond_can_set_data()
	{
		$respond = Respond::setData($this->fakeData())->withSuccess();

		self::assertNotEmpty($respond->getData()->data);
	}

	/** @test */
	function respond_can_set_message()
	{
		$message = $this->faker->sentence();

		$respond = Respond::setMessage($message)->withSuccess();

		self::assertTrue($respond->getData()->message === $message);
	}

	/** @test */
	function respond_can_set_errors()
	{
		$errors = $this->fakeErrors();

		$respond = Respond::setErrors($errors)->withErrors();

		self::assertNotEmpty($respond->getData()->errors);
	}

	/** @test */
	function respond_can_set_meta()
	{
		$respond = Respond::setData($this->fakeData())
			->setMeta([
				'meta' => $this->faker->word(),
			])
			->withSuccess();

		self::assertNotEmpty($respond->getData()->meta);
	}

	/** @test */
	function respond_can_respond_in_json()
	{
		$respond = Respond::toJson()->setData($this->fakeData())->withSuccess();

		self::assertInstanceOf(JsonResponse::class, $respond);
	}

	/** @test */
	function respond_can_throw_exception()
	{
		$this->expectException(RespondException::class);

		Respond::setData($this->fakeData())->withUnknowMethod();
	}

	/**
	 * set response to array.
	 */
	private function setToJsonToFalse(): void
	{
		Config::set('respond.toJson', false);
	}

	/**
	 * Fake data array.
	 * @return array
	 */
	private function fakeData(): array
	{
		return [
			'id' => mt_rand(1, 1000),
			'name' => $this->faker->name(),
			'email' => $this->faker->email(),
			'address' => $this->faker->address(),
		];
	}

	/**
	 * Fake error array.
	 * @return array[]
	 */
	private function fakeErrors(): array
	{
		return [
			[$this->faker->sentence()], [$this->faker->sentence()],
		];
	}
}
