<?php

return [
    'record' => [
        'singular' => 'enregistrement',
        'plural' => 'enregistrements',
    ],
	'success' => [
		'ok' => 'La transaction a été effectuée avec succès.',
		'created' => 'L\'enregistrement a été créé avec succès.',
		'accepted' => 'La transaction a été acceptée.',
	],
    'exceptions' => [
        'not_authenticated' => 'Ces informations d\'identification ne correspondent pas à nos enregistrements.',
        'not_authorized' => 'Accès interdit!',
        'not_found' => 'Aucun :attribute a été trouvé!',
        'unprocessable_entity' => 'Cette action ne peut pas être traitée!',
        'server_error' => 'Erreur Interne du Serveur',
        'no_content' => 'Pas de contenu',
	    'method_not_found' => 'La méthode :method n\'est pas definie!',
    ],
];
