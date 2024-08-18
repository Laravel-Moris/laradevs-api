### Create User token

```php
use App\Models\User;

$user = User::find(1);

$token = $user->createToken('my-token', [
    'create-developer',
    'read-developer',
    'update-developer',
    'delete-developer',
]);

$token->plainTextToken;
```


### GET Developers
`GET https://laradevs.test/api/v1/developers`

```php
use Illuminate\Support\Facades\Http;

$response = Http::withToken('<token here>')->get('https://laradevs.test/api/v1/developers');

$response->json();
```
