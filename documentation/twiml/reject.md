TwiML `<Reject>`
======================

The `<Reject>` verb rejects an incoming call to your Freewili number without possiably billing your gateway. This is very useful for blocking unwanted calls.

If the first verb in a TwiML document is `<Reject>`, Freewili will not pick up the call. The call ends with a status of 'busy' or 'no-answer', depending on the verb's 'reason' attribute. Any verbs after `<Reject>` are unreachable and ignored.

Note that using `<Reject>` as the first verb in your response is the only way to prevent Freewili from answering a call. Any other response will result in an answered call and your account will be billed.

Verb Attributes
---------------
The `<Reject>` verb supports the following attributes that modify its behavior:

Attribute Name      Allowed Values      Default Value
--------------      --------------      -------------
reason              rejected, busy      rejected

### reason ###
The reason attribute takes the values "rejected" and "busy." This tells Freewili what message to play when rejecting a call. Selecting "busy" will play a busy signal to the caller, while selecting "rejected" will play a standard not-in-service response. If this attribute's value isn't set, the default is "rejected."

Nesting Rules
-------------
Not Supported.

Nested Rules
------------
Not Supported.

Examples
---------

### Example: _Reject a call playing a standard not-in-service message_ ###

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Reject />
</Response>
~~~

### Example: _Reject a call playing a busy signal__ ###

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Reject reason="busy" />
</Response>
~~~

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.