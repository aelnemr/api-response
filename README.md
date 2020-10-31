# CoreJsonResponse
CoreJsonResponse JSON response trait. 
This trait makes it easy for any controller to return a JSON response 
with the appropriate HTTP status code.

# Install via composer :fire:

```$xslt
composer require aelnemr/api-response
```

# Usage
All that you need is to `use` the `CoreJsonResponse` trait inside your controller.

**Example:**

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AElnemr\RestFullResponse\CoreJsonResponse;

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

### Success Methods :v:
| Method | Status code | Description |
|---|---|---|
|ok|200|Successful get, patch (return a JSON object)|
|okWithPagination|200|Successful get, patch (return a JSON object)|
|created|201|Successful post (return a JSON object)|

### Error Status :shit:

| Method | Status code | Description |
|---|---|---|
|unauthenticated|401|Error Not authenticated|
|forbidden|403|Error Not authorized (Authenticated, but no permissions)|
|notFound|404|Error Not Found|
|invalidRequest|422|Error Validation|

### Extra methods :man:

| Method | Status code | Description |
|---|---|---|
|accepted|202|Successful post, delete, path - async|
|badRequest|400|Error The request could not be understood by the server due to malformed syntax|
|paymentRequired|402|Error Payment required|
|conflict|409|Error Logical error|
