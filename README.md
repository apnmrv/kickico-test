# KICKICO.COM: Практическое задание

Need to implement the Laravel composer package to receive JSON encoded data stored in a predefined format.

## Acceptance criteria:

* The client should be defined as a service in a bundle config;
* The client should use the PSR-7 implementation of Guzzle as the transport layer;
* Properly defined exceptions should be thrown on CURL errors, malformed JSON response, and error JSON response, also errors should be logged;
* All package dependencies should be resolved with DiC.
* Code should be covered by tests;

* Optional:
	- Requests should be processed through message queues

JSON success response format:
```json
{
  "data": {
    "suggestions": [
      {
        "region": "Москва",
        "value": "г Москва, ул Лубянка Б., д 12",
        "coordinates": {
          "geo_lat": "55.7618518",
          "geo_lon": "37.6284306"
        }
      },
      ...
    ]
  },
  "success": true
}
```

JSON error response format:
```json
{
  "data": [
    {
      "code": 1020,
      "message": "Access forbidden"
    },
    ...
  ],
  "success": false
}
```
