%twiml.Redirect

TwiML Voice: <Redirect>
=======================

The `<Redirect>` verb transfers control of a call to the TwiML at a different URL. All verbs after `<Redirect>` are unreachable and ignored.

Verb Attributes
---------------
The `<Redirect>` verb supports the following attributes that modify its behavior:

Attribute Name  | Allowed Values | Default Value
--------------- | -------------- | -------------
method          | GET, POST      | POST

### method ###
The 'method' attribute takes the value 'GET' or 'POST'. This tells Freewili whether to request the `<Redirect>` URL via HTTP GET or POST. 'POST' is the default.

Nouns
-----
The "noun" of a TwiML verb is the stuff nested within the verb that's not a verb itself; it's the stuff the verb acts upon. These are the nouns for `<Redirect>`:

Noun       | TwiML Interpretation
---------- | --------------------
plain text | An absolute or relative URL for a different TwiML document.

Nesting Rules
--------------
Not Supported.

Nested Rules
-------------
Not Supported.

Examples
---------

### Example: _Absolute URL Redirect_ ###
In this example, we have a `<Redirect>` verb after a `<Dial>` verb with no URL. When the `<Dial>` verb finishes, the `<Redirect>` executes. `<Redirect>` makes a request to http://www.foo.com/nextInstructions and transfers the call flow to the TwiML received in response to that request.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Dial>415-123-4567</Dial>
    <Redirect>http://www.foo.com/nextInstructions</Redirect>
</Response>
~~~

### Example: _Relative URL Redirect_ ###
Redirects call flow control to the TwiML at a URL relative to the current URL.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Redirect>../nextInstructions</Redirect>
</Response>
~~~

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.