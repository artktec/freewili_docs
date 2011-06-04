%twiml.Number

TwiML `<Number>`
=====================

The `<Dial>` verb's `<Number>` noun specifies a phone number to dial. Using the noun's attributes you can specify particular behaviors that Freewili should apply when dialing the number.
You can use multiple `<Number>` nouns within a `<Dial>` verb to simultaneously call all of them at once. The first call to pick up is connected to the current call and the rest are hung up.

Noun Attributes
---------------
The `<Number>` noun supports the following attributes that modify its behavior:

Attribute Name      Allowed Values      Default Value
--------------      --------------      -------------
sendDigits          any digits          none
url                 any url             none

### sendDigits ###
The 'sendDigits' attribute tells Freewili to play DTMF tones when the call is answered. This is useful when dialing a phone number and an extension. Freewili will dial the number, and when the automated system picks up, send the DTMF tones to connect to the extension.

### url ###
The 'url' attribute allows you to specify a url for a TwiML document that will run on the called party's end, after she answers, but before the parties are connected. You can use this TwiML to privately play or say information to the called party, or provide a chance to decline the phone call using `<Gather>` and `<Hangup>`. The current caller will continue to hear ringing while the TwiML document executes on the other end. TwiML documents executed in this manner are not allowed to contain the `<Dial>` verb.

Nesting Rules
-------------
Not Supported.

Nested Rules
------------
Not Supported.

Examples
---------

### Example: _Using sendDigits_ ###
In this case, we want to dial the 1928 extension at 415-123-4567. We use a `<Number>` noun to describe the phone number and give it the attribute sendDigits. We want to wait before sending the extension, so we add a few leading 'w' characters. Each 'w' character tells Freewili to wait 0.5 seconds instead of playing a digit. This lets you adjust the timing of when the digits begin playing to suit the phone system you are dialing.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Dial>
        <Number sendDigits="wwww1928">
            415-123-4567
        </Number>
    </Dial>
</Response>
~~~

### Example: _Simultaneous Dialing_ ###
In this case we use several `<Number>` tags to dial three phone numbers at the same time. The first of these calls to answer will be connected to the current caller, while the rest of the connection attempts are canceled.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<Response>
    <Dial>
        <Number>
            858-987-6543
        </Number>
        <Number>
            415-123-4567
        </Number>
        <Number>
            619-765-4321
        </Number>
    </Dial>
</Response>
~~~

Hints and Advanced Uses
-----------------------

Simultaneous dialing is useful when you have several phones (or several people) that you want to ring when you receive an incoming call. Keep in mind that the first call that connects will cancel all the other attempts. If you dial an office phone system or a cellphone in airplane mode, it may pick up after a single ring, preventing the other phone numbers from ringing long enough for a human to ever answer.

Hence you should take care to use simultaneous dialing in situations where you know the behavior of the called parties.

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.