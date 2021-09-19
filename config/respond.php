<?php

use Symfony\Component\HttpFoundation\Response;

return [
	'toJson' => true,
	'responses' => [
		'success' => [
			'success' => true,
			'message' => 'messages.success.ok',
			'status' => Response::HTTP_OK,
		],
		'created' => [
			'success' => true,
			'message' => 'messages.success.created',
			'status' => Response::HTTP_CREATED,
		],
		'accepted' => [
			'success' => true,
			'message' => 'messages.success.accepted',
			'status' => Response::HTTP_ACCEPTED,
		],
		'errors' => [
			'success' => false,
			'message' => 'messages.exceptions.unprocessable_entity',
			'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
		],
		'nocontent' => [
			'success' => true,
			'message' => 'messages.exceptions.no_content',
			'status' => Response::HTTP_NO_CONTENT,
		],
		'servererror' => [
			'success' => false,
			'message' => 'messages.exceptions.server_error',
			'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
		],
		'notfound' => [
			'success' => false,
			'message' => 'messages.exceptions.not_found',
			'status' => Response::HTTP_NOT_FOUND,
		],
		'notauthenticated' => [
			'success' => false,
			'message' => 'messages.exceptions.not_authenticated',
			'status' => Response::HTTP_UNAUTHORIZED,
		],
		'notauthorized' => [
			'success' => false,
			'message' => 'messages.exceptions.not_authorized',
			'status' => Response::HTTP_FORBIDDEN,
		],
	],
];
