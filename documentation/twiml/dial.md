%twiml.Dial

TwiML <Dial>
===================

The `<Dial>` verb connects the current caller to an another phone. If the called party picks up, the two parties are connected and can communicate until one hangs up. If the called party does not pick up, if a busy signal is received, or if the number doesn't exist, the dial verb will finish.
When the dialed call ends, Freewili makes a GET or POST request to the 'action' URL if provided. Call flow will continue using the TwiML received in response to that request.

Verb Attributes
---------------
The `<Dial>` verb supports the following attributes that modify its behavior:

Attribute           Allowed Values	     Default Value
action              relative or          no default action for Dial
                    absolute URL
method              GET, POST            POST
timeout             positive integer     30 seconds
hangupOnStar        true, false          false
timeLimit           positive integer     14400 seconds (4 hours) 
                    (seconds)
callerId            valid phone number   Caller's callerId

### action ###
The 'action' attribute takes a URL as an argument. When the dialed call ends, Freewili will make a GET or POST request to this URL including the parameters below.

If you provide an 'action' URL, Freewili will continue the current call after the dialed party has hung up, using the TwiML received in your response to the 'action' URL request. Any TwiML verbs occuring after a `<Dial>` which specifies an 'action' attribute are unreachable.

If no 'action' is provided, `<Dial>` will finish and Freewili will move on to the next TwiML verb in the document. If there is no next verb, Freewili will end the phone call. Note that this is different from the behavior of `<Record>` and `<Gather>`. `<Dial>` does not make a request to the current document's URL by default if no 'action' URL is provided. Instead the call flow falls through to the next TwiML verb.

#### Request Parameters ####

Freewili will pass the following parameters in addition to the standard TwiML Voice request parameters with its request to the 'action' URL:

Parameter           Description
---------           -----------
DialCallSid         The call sid of the new call leg.
DialCallStatus      The outcome of the `<Dial>` attempt. See the DialCallStatus section below for details.
DialCallDuration    The duration in seconds of the dialed call.

#### DialCallStatus Values ####

Value               Description
-----               ------------
completed           The called party answered the call and was connected to the caller.
busy                Freewili received a busy signal when trying to connect to the called party.
no-answer           The called party did not pick up before the timeout period passed.
failed              Freewili was unable to route to the given phone number. This is frequently caused by dialing a properly formated but non-existent phone number.
canceled           The call was canceled via the REST API before it was answered.

### method ###
The 'method' attribute takes the value 'GET' or 'POST'. This tells Freewili whether to request the 'action' URL via HTTP GET or POST. This attribute is modeled after the HTML form 'method' attribute. 'POST' is the default value.

### timeout ###
The 'timeout' attribute sets the limit in seconds that `<Dial>` waits for the called party to answer the call. Basically, how long should Freewili let the call ring before giving up and reporting 'no-answer' as the 'DialCallStatus'.

### hangupOnStar ###
The 'hangupOnStar' attribute lets the calling party hang up on the called party by pressing the '\*' key on his phone. When two parties are connected using `<Dial>`, Freewili blocks execution of further verbs until the caller or called party hangs up. This feature allows the calling party to hang up on the called party without having to hang up her phone and ending her TwiML processing session. When the caller presses '*' Freewili will hang up on the called party. If an 'action' URL was provided, Freewili submits 'completed' as the 'DialCallStatus' to the URL and processes the response. If no 'action' was provided Freewili will continue on to the next verb in the current TwiML document.

### timeLimit ###
The 'timeLimit' attribute sets the maximum duration of the `<Dial>` in seconds. For example, by setting a time limit of 120 seconds `<Dial>` will hang up on the called party automatically two minutes into the phone call. By default, there is a four hour time limit set on calls.

### callerId ###
The 'callerId' attribute lets you specify the caller ID that will appear to the called party when Freewili calls. By default, when you put a `<Dial>` in your TwiML response to Freewili's inbound call request, the caller ID that the dialed party sees is the inbound caller's caller ID.

For example, an inbound caller to your Freewili number has the caller ID 1-415-123-4567. You tell Freewili to execute a `<Dial>` verb to 1-858-987-6543 to handle the inbound call. The called party (1-858-987-6543) will see 1-415-123-4567 as the caller ID on the incoming call.

You are allowed to change the phone number that the called party sees to one of the following:
*  either the 'To' or 'From' number provided in Freewili's TwiML request to your app
*  any incoming phone number you have added to Freewili
*  any phone number you have validated with Freewili for use as an outgoing caller ID

Nouns
-----
The "noun" of a TwiML verb is the stuff nested within the verb that's not a verb itself; it's the stuff the verb acts upon. These are the nouns for `<Dial>`:

Noun                Description
----                -----------
plain text          A string representing a valid phone number to call.
`<Number>`	        A nested XML element that describes a phone number with more complex attributes.
`<Conference>`	    A nested XML element that describes a conference allowing two or more parties to talk.

### `<Number>` Noun ###
The `<Number>` noun allows you to `<Dial>` another number while specifying additional behavior pertaining to that number. Simultaneous dialing is also possible using multiple `<Number>` nouns. See the documentation on the `<Number>` noun for a detailed walkthrough of how to use it.

### `<Conference>` Noun ###
The `<Conference>` noun allows you to `<Dial>` into a conference room, rather than `<Dial>` another number. See the documentation on the `<Conference>` noun for a detailed walkthrough of how to use Freewili's conferencing functionality.


Nesting Rules
-------------
Not Supported.

Nested Rules
------------
Not Supported.


Examples
--------

### Example: _Simple dial_ ###
This is the simplest case for Dial. Freewili will dial 415-123-4567. If someone answers, Freewili will connect the caller to the called party. If the caller hangs up, the Freewili session ends. If the line is busy, if there is no answer, or if the called party hangs up, `<Dial>` exits and the `<Say>` verb is executed for the caller before the call flow ends.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/simple_dial.xml -->
<Response>
    <Dial>415-123-4567</Dial>
    <Say>Goodbye</Say>
</Response>
~~~

### Example: _DialCallStatus reporting_ ###

In this example provide an action URL and method.

Now when `<Dial>` ends, Freewili will submit a request to the action URL with the parameter 'DialCallStatus'. If nobody picks up, 'DialCallStatus' will be 'no-answer'. If the line is busy, 'DialCallStatus' will be 'busy'. If the called party picks up, 'DialCallStatus' will be 'completed'. If an invalid phone number was provided, 'DialCallStatus' will be 'failed'.

Your web application can look at the 'DialCallStatus' parameter and decide what to do next.

If an 'action' URL is provided for `<Dial>`, Freewili will always make a request to it regardless of the outcome of `<Dial>`. All verbs remaining in the document are unreachable and ignored.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/dial_callstatus.xml -->
<Response>
    <Dial action="/handleDialCallStatus.php" method="GET">
        415-123-4567
    </Dial>
    <Say>I am unreachable</Say>
</Response>
~~~

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.