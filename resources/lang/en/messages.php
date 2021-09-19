<?php

return [
    'record' => [
        'singular' => 'record',
        'plural' => 'records',
    ],
	'success' => [
		'ok' => 'The transaction was completed successfully.',
		'created' => 'The record was created successfully.',
		'accepted' => 'The transaction was accepted.',
	],
    'exceptions' => [
        'not_authenticated' => 'These credentials do not match our records.',
        'not_authorized' => 'Access forbidden!',
        'not_found' => 'No :attribute was found!',
        'unprocessable_entity' => 'This action cannot be processed!',
        'server_error' => 'Internal Server Error',
        'no_content' => 'No content',
        'method_not_found' => 'Method :method is not defined!',
    ],
];
