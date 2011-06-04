%twiml.Pause

TwiML <Pause>
=====================

The `<Pause>` verb waits silently for a specific number of seconds. If `<Pause>` is the first verb in a TwiML document, Freewili will wait the specified number of seconds before picking up the call.

Verb Attributes
---------------

The `<Pause>` verb supports the following attributes that modify its behavior:

Attribute Name      Allowed Values      Default Value
--------------      --------------      -------------
length              integer > 0         1 second

### length ###
The 'length' attribute specifies how many seconds Freewili will wait silently before continuing on.

Nesting Rules
-------------
Not Supported.

Nested Rules
------------
* `<Gather>`

Examples
--------

### Example: _Simple pause_ ###
This example demonstrates using `<Pause>` to wait between two `<Say>` verbs.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8" ?>
<Response>
    <Say>I will pause 10 seconds starting now!</Say>
    <Pause length="10"/>
    <Say>I just paused 10 seconds</Say>
</Response>
~~~

### Example: _Delayed pickup_ ###
This example demonstrates using `<Pause>` to delay Freewili for 5 seconds before accepting a call.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8" ?>
<Response>
    <Pause length="5"/>
    <Say>Hi there.</Say>
</Response>
~~~

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.