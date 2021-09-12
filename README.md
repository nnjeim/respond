
<p><img src="https://eu.ui-avatars.com/api/?name=Najm+Njeim?size=150" width="150"/></p>

## Respond Factory

A Laravel response helper methods.

## Installation

You can install the package via composer:
```
Add to composer.json

 "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/nnjeim/respond.git"
        }
    ]

composer require nnjeim/respond
```

## Usage

##### Respond Facade
``` 
use Nnjeim\Fetch\Fetch;
use Nnjeim\Respond\Respond;

['response' => $response, 'status' => $status] = Fetch::setBaseUri('https://nnjeim.com/api')->get('countries');

    if ($status === 200 && $response->success) {

        return Respond::setMessage('countries')
            ->toJson()
            ->withSuccess($response->data);
    }

    abort(400);
```
##### RespondHelper Instantiation

```
use Nnjeim\Respond\RespondHelper;

private $respond;

public function __construct(RespondHelper $respond) {

    $this->respond = $respond;
}
.
.
.
$response = $this->respond
        ->setMessage('countries')
        ->toJson();

if ($response->success) {
    return $response->withSuccess($response->data)
}

return $response->withErrors();
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

@return $this       toJson()
```

##### Respond with success
```
On success response. The default response status code is 200.   

@return $this       withSuccess(?array $data = null)
```

##### Respond with no content
```
On success response with no results found. The default status code is 204

@return $this       withNoContent()
```

#####  Respond with errors
```
On error response. The default response status code is 422.   

@return $this       withErrors(?array $errors = null)
```

##### Respond with server error
```
On server error response. The default response status code is 500.   

@return $this       withServerError()       
```

##### Respond with not found
```
Record not found error. The default response status code is 404.

@return array       withNotFound(?string $attribute = null, bool $plural = true)
```

##### Respond with not authenticated
```
Not authorized reponse. The default response status code is 401.

@return array       withNotAuthenticated($message = null)
```

##### Respond with not authorized
```
Not authorized reponse. The default response status code is 403.

@return array       withNotAuthorized($message = null)
```

## Respond

```
@return array

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
