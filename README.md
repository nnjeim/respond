
<p><img src="https://eu.ui-avatars.com/api/?name=Najm+Njeim?size=100" width="100"/></p>

## Respond Factory

A Laravel response helper methods.

## Installation

You can install the package via composer:
```
composer require nnjeim/respond
```

## Configuration
```
php artisan vendor:publish --provider="Nnjeim\Respond\RespondServiceProvider"

## Usage

##### Respond Facade
``` 
use Nnjeim\Fetch\Fetch;
use Nnjeim\Respond\Respond;

['response' => $response, 'status' => $status] = Fetch::setBaseUri('https://someapi.com/')->get('countries');

	if ($status === 200 && $response->success) {

		return Respond::toJson()
			->setMessage('countries')
			->setData($response->data)
			->withSuccess();
	}

	abort(400);
```
##### RespondHelper Instantiation

```
use Nnjeim\Respond\RespondHelper;

private RespondHelper $respond;
private array $data;
private bool $success;

public function __construct(RespondHelper $respond)
{
	$this->respond = $respond;
}
.
.
.
$respond = $this
		->respond
		->toJson()
		->setMessage('countries')
		->setData($data);

if ($this->success)
{
	return $respond->withSuccess()
}

return $respond->withErrors();
```

## Methods

##### Set the status code
```
Sets the response status code  

@return $this       setStatusCode(int $statusCode)
```

##### Set the message
```
Sets the response title message

@return $this       setMessage(string $message)
```

##### Set the meta data
```
Sets the response meta data. The meta data will be merged with the response data array.

@return $this       setMeta(array $meta)
```

##### Set the data
```
Sets the response data array.

@return $this       setData(array $data)
```

##### Set the errors
```
Sets the response errors.

@return $this       setErrors(array $errors)
```

##### respond in Json format
```
returns an instance of Illuminate\Http\JsonResponse  

this method overwrites the config `toJson` set value.

@return $this       toJson()
```

##### Respond with success
```
On success response. The default response status code is 200.   

@return array|JsonResponse       withSuccess()
```

##### Respond with created
```
On created response. The default response status code is 201.   

@return array|JsonResponse       withCreated()
```

##### Respond with accepted
```
On accepted response. The default response status code is 202.   

@return array|JsonResponse       withAccepted()
```

##### Respond with no content
```
On success response with no results found. The default status code is 204

@return array|JsonResponse       withNoContent()
```

#####  Respond with errors
```
On error response. The default response status code is 422.   

@return array|JsonResponse       withErrors(?array $errors = null)
```

##### Respond with server error
```
On server error response. The default response status code is 500.   

@return array|JsonResponse       withServerError()       
```

##### Respond with not found
```
Record not found error. The default response status code is 404.

@return array|JsonResponse       withNotFound()
```

##### Respond with not authenticated
```
Not authenticated reponse. The default response status code is 401.

@return array|JsonResponse       withNotAuthenticated()
```

##### Respond with not authorized
```
Not authorized reponse. The default response status code is 403.

@return array|JsonResponse       withNotAuthorized()
```

## Respond

```
@return array|JsonResponse

	[
		'response' => [
			'success' => true,
			'message' => 'message',
			'data' => [],
			'errors' => [],
		],
		'status' => 200,
	];
```
## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
