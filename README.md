# CoreJsonResponse
CoreJsonResponse JSON response trait. 
This trait makes it easy for any controller to return a JSON response 
with the appropriate HTTP status code.

# Usage
All that you need is to `use` the `CoreJsonResponse` trait inside your controller.

**Example:**

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\CoreJsonResponse;

class CountryController extends Controller
{
    use CoreJsonResponse;

    public function index()
    {
        $data = \App\User::get();
        return $this->ok($data);
    }
}
```

## Available methods

### Success Methods
| Method | Status code | Description |
|---|---|---|
|ok|200|Successful get, patch (return a JSON object)|
|created|201|Successful post (return a JSON object)|

### Error Status

| Method | Status code | Description |
|---|---|---|
|unauthorized|401|Not authenticated|
|forbidden|403|Authenticated, but no permissions|
|notFound|404|Not Found|
|invalidRequest|422|Validation|

### Extra methods

| Method | Status code | Description |
|---|---|---|
|accepted|202|Successful post, delete, path - async|
|badRequest|400|The request could not be understood by the server due to malformed syntax|
|paymentRequired|402|Payment required|
