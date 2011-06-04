%documentation.overview

General Overview
================

BaseUrl
-------
`http://api.freewili.com/2010-04-01` This is essentially the same URL as the Twilio(R) API 

HTTP vs HTTPS
-------------
For the time being our API is in http. We are working on ways to secure this
with HTTPS. As such we do not recommend you use Freewili(TM) for production
services. Freewili is perfectly capable of being an awesome development
environment for the time being.

Why REST?
---------
Don't ask us, as Twilio(R). They chose this super-cool (and correct mind you)
way to interact and work with remote data. We fully endorse it and you can find
out more about it at [twilio.com/rest]


Requesting Data
===============

You can expect the following response types from the Freewili REST API.

GET
-------------
This Request Header type is used when you are just looking to get data back from
Freewili.


### Possible GET Responses ###

* `200 OK` Your all good. The response body contains the data requested.
* `302 FOUND` Gotta go somewhere else. GET the requested data by going to the
URI in the Location response header.
* `304 NOT MODIFIED` Your cache is good here. The data you should have cached is
still up to date.
* `401 UNAUTHORIZED` Give Me your password please. You need to go through the
HTTP BasicAuthorization dance for access.
* `404 NOT FOUND` Whatchyou talking about Willis? Eh, we don't know what data
you were looking for.
* `500 SERVER ERROR` Something is bad on our side. Please try again.

POST and/or PUT
---------------
This Request Header type is used when you are adding data to Freewili, or 
requesting Freewili to take some action, such as starting a phone call.


### Possible POST/PUT Responses ###

* `201 OK` Your all good. The response body contains the data requested.
* `302 FOUND` Gotta go somewhere else. GET the requested data by going to the
URI in the Location response header.
* `304 NOT MODIFIED` Your cache is good here. The data you should have cached is
still up to date.
`400 BAD REQUEST` Something is bad on your side. The data your provided somehow 
is not valid. Check the response body for more details.
* `401 UNAUTHORIZED` Give Me your password please. You need to go through the
HTTP BasicAuthorization dance for access.
* `404 NOT FOUND` Whatchyou talking about Willis? Eh, we don't know what data
you were looking for.
* `500 SERVER ERROR` Something is bad on our side. Please try again.

DELETE
-----------------
This Request Header type is used to remove data from Freewili. Remember not all
API calls accept this request type.


### Possible DELETE Responses ###

`204 OK` Your all good. The data was deleted.
* `401 UNAUTHORIZED` Give Me your password please. You need to go through the
HTTP BasicAuthorization dance for access.
* `404 NOT FOUND` Whatchyou talking about Willis? Eh, we don't know what data
you were looking for.
* `500 SERVER ERROR` Something is bad on our side. Please try again.

HTTP Request Type Overloading
-----------------------------
If you have a client that does not support sending official, true, HTTP Request
methods, then you can include an include a query string with the parameter
`_method`. The valid values for `_method` are PUT and DELETE

### Example ###
~~~
DELETE /2010-04-01/Accounts/fw30947.../PhoneNumbers/fi12345567789AFE4433
~~~

would become

~~~
GET /2010-04-01/Accounts/fw30947.../PhoneNumbers/fi12345567789AFE4433?_method=DELETE
~~~

Rate Limiting
=============

REST API Rate Limiting
----------------------
The default rate limit for establishing phone calls to the Freewili REST API is 2 requests per second.

The REST API looks at both the requesting user and the IP of the request to provide rate limiting.