%twiml.Hangup

TwiML \<Hangup>
==============

The `<Hangup>` verb ends a call. If used as the first verb in a Freewili response it does not prevent Freewili from answering the call and possibly billing your gateway provider. The only way to not answer a call and prevent any billing is to use the `<Reject>` verb.

Verb Attributes
---------------
The `<Hangup>` verb has no attributes.

Nesting Rules
-------------
Not Supported.

Nested Rules
------------
Not Supported.

Examples
--------

### Example ###
The following code tells Freewili to answer the call and hang up immediately.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Hangup/>
</Response>
~~~

Hints and Advanced Uses
-----------------------
When receiving a Freewili request to an 'action' URL within `<Gather>`, `<Record>` or `<Dial>`, you can return a response containing the `<Hangup>` verb to end the current call.

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.