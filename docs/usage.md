# Usage

Using the API is designed to be as easy as possible for developers.

## Human Connect popup
See the [official documentation](https://docs.humanapi.co/docs/connect-setup) on how to set this up for new and
existing users.

## Finalising the auth flow
Following the [official documentation](https://docs.humanapi.co/docs/connect-setup) on setting up your Connect
popup will result in `POST` data being sent to your server endpoint defined in the Connect options of the previous step.
Typically the `POST` data will look something like this:

```php
array(3) {
    'humanId' =>
    string(24) "52867cbede3155565f000a0d"
    'clientId' =>
    string(40) "2e9574ecd415c99346879d07689ec1c732c11036"
    'sessionToken' =>
    string(32) "8836c122c0483eb193ac2dd121136931"
}
```
To finalise the auth flow process we just need to create an auth object, and provide this `POST` data and your app's
'client secret' key found in the settings of your application in the HumanAPI developer portal.

```php
use Choccybiccy\HumanApi\Auth;

$clientSecret = "ee1551fb509598d0b656811633310889dc306aa3";

$auth = new Auth($_POST, $clientSecret);
$data = $auth->finish();
```
The response from the finish() method will look something like this:
```php
array(3) {
    'humanId' =>
    string(24) "52867cbede3155565f000a0d"
    'accessToken' =>
    string(40) "95891f14f4bcpa23261987effc7cfac7fedf7330"
    'publicToken' =>
    string(32) "2767d6oea95f4c3db8e8f3d0a1238302"
}
```
You should consider storing `humanId`, `accessToken` and `publicToken` against your user for later use.

## Human
Creating an instance of human requires the user's access token.
```php
use Choccybiccy\HumanApi\Human;

$human = new Human("myAccessToken");
```

From there you can begin querying the HumanAPI endpoints.

## Endpoints
Creating an endpoint instance only requires the endpoint name.
```php
use Choccybiccy\HumanApi\Human;

$human = new Human("myAccessToken");

$endpoint = $human->get("Activities");
```

### Querying endpoints
Endpoints support 3 different kinds of data retrieval.

```php
$endpoint->getList(); // Returns all entries in descending order of creation date

$endpoint->getById($id); // Returns single entry matching the given entry ID

$endpoint->getRecent(); // Returns recent entries in descending order of creation date
```

### Query parameters
It's possible to pass options to each method for pagination and refining.
```php
$params = array(
    "limit" => 5,
    "offset" => 10,
);
$endpoint->getList($params);

$endpoint->getRecent($params);
```
Full list of parameters:

| Parameter        | Description                                                                                    |
|------------------|------------------------------------------------------------------------------------------------|
| `limit`          | The max number of records to return in one query. Default is 20                                |
| `offset`         | The index of the first record to return. Default is 0                                          |
| `created_since`  | Returns records that are created after the specified date. UTC date in format YYYYMMDDThhmmssZ |
| `updated_since`  | Returns records that are udpated after the specified date. UTC date in format YYYYMMDDThhmmssZ |
| `created_before` | Returns records that are created after the specified date. UTC date in format YYYYMMDDThhmmssZ |
| `updated_before` | Returns records that are updated after the specified date. UTC date in format YYYYMMDDThhmmssZ |

### Unsupported methods
Some endpoints support different methods to retrieve data, this is because of the kind of data that the endpoints
contain. For example, while [Activities](endpoints/Activities.md) supports all data retrieval methods,
[Meals](endpoints/Meals.md) only supports the list retrieval method, and doesn't support obtaining specific or recent
records.

Attempting to use a method not supported for an endpoint will raise
an `\Choccybiccy\HumanApi\Endpoint\UnsupportedEndpointMethodException` exception.

### Available endpoints
Here's a complete list of available endpoints that can be queried against, along with the types of data that
can be retrieved.

| Endpoint                                      | getList | getById | getRecent |
|-----------------------------------------------|---------|---------|-----------|
| [Activities](endpoints/Activities.md)       | Yes     | Yes     | Yes       |
| [BloodGlucose](endpoints/BloodGlucose.md)   | Yes     | Yes     | Yes       |
| [BloodyOxygen](endpoints/BloodOxygen.md)    | Yes     | Yes     | Yes       |
| [BloodPressure](endpoints/BloodPressure.md) | Yes     | Yes     | Yes       |
| [BodyFat](endpoints/BodyFat.md)             | Yes     | Yes     | Yes       |
| [BodyMassIndex](endpoints/BodyMassIndex.md) | Yes     | Yes     | Yes       |
| [Genetics](endpoints/Genetics.md)           | Yes     | No      | No        |
| [HeartRate](endpoints/HeartRate.md)         | Yes     | Yes     | Yes       |
| [Height](endpoints/Height.md)               | Yes     | Yes     | Yes       |
| [Locations](endpoints/Locations.md)         | Yes     | Yes     | No        |
| [Meals](endpoints/Meals.md)                 | Yes     | Yes     | No        |
| [Profile](endpoints/Profile.md)             | Yes     | No      | No        |
| [Sleeps](endpoints/Sleeps.md)               | Yes     | Yes     | Yes       |
| [Sources](endpoints/Sources.md)             | Yes     | No      | No        |
| [Weight](endpoints/Weight.md)               | Yes     | Yes     | Yes       |

