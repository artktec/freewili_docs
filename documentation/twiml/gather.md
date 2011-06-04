%twiml.Gather

TwiML <Gather>
=====================

The `<Gather>` verb collects digits that a caller enters into his or her telephone keypad. When the caller is done entering data, Freewili submits that data to the provided 'action' URL in an HTTP GET or POST request, just like a web browser submits data from an HTML form.

If no input is received before timeout, `<Gather>` falls through to the next verb in the TwiML document.

You may optionally nest `<Say>` and `<Play>` verbs within a `<Gather>` verb while waiting for input. This allows you to read menu options to the caller while letting her enter a menu selection at any time. After the first digit is received the audio will stop playing.

Verb Attributes
---------------
The `<Gather>` verb supports the following attributes that modify its behavior:

Attribute Name     | Allowed Values     | Default Value
------------------ | ------------------ | -------------
action             | relative or        | current document URL
                   | absolute URL       |       
method             | GET, POST          | POST
timeout            | positive integer   | 5 seconds
finishOnKey        | any digit, \#, \*  |   \#
numDigits          | integer >= 1       | unlimited

### action ###
The 'action' attribute takes an absolute or relative URL as a value. When the caller has finished entering digits Freewili will make a GET or POST request to this URL including the parameters below. If no 'action' is provided, Freewili will by default make a POST request to the current document's URL.

After making this request, Freewili will continue the current call using the TwiML received in your response. Keep in mind that by default Freewili will re-request the current document's URL, which can lead to unwanted looping behavior if you're not careful. Any TwiML verbs occuring after a `<Gather>` are unreachable, unless the caller enters no digits.

If the 'timeout' is reached before the caller enters any digits, or if the caller enters the 'finishOnKey' value before entering any other digits, Freewili will not make a request to the 'action' URL but instead continue processing the current TwiML document with the verb immediately following the `<Gather>`.

#### Request Parameters ####

Freewili will pass the following parameters in addition to the standard TwiML Voice request parameters with its request to the 'action' URL:
Parameter          | Description
------------------ | -----------
Digits             | The digits the caller pressed, excluding the finishOnKey digit if used.

### method ###
The 'method' attribute takes the value 'GET' or 'POST'. This tells Freewili whether to request the 'action' URL via HTTP GET or POST. This attribute is modeled after the HTML form 'method' attribute. 'POST' is the default value.

### timeout ###
The 'timeout' attribute sets the limit in seconds that Freewili will wait for the caller to press another digit before moving on and making a request to the 'action' URL. For example, if 'timeout' is '10', Freewili will wait ten seconds for the caller to press another key before submitting the previously entered digits to the 'action' URL. Freewili waits until completing the execution of all nested verbs before beginning the timeout period.

### finishOnKey ###
The 'finishOnKey' attribute lets you choose one value that submits the received data when entered. For example, if you set 'finishOnKey' to '\#' and the user enters '1234\#', Freewili will immediately stop waiting for more input when the '\#' is received and will submit "Digits=1234" to the 'action' URL. Note that the 'finishOnKey' value is not sent. The allowed values are the digits 0-9, '\#' , '\*' and the empty string (set 'finishOnKey' to ''). If the empty string is used, `<Gather>` captures all input and no key will end the <Gather> when pressed. In this case Freewili will submit the entered digits to the 'action' URL only after the timeout has been reached. The default 'finishOnKey' value is '\#'. The value can only be a single character.

### numDigits ###
The 'numDigits' attribute lets you set the number of digits you are expecting, and submits the data to the 'action' URL once the caller enters that number of digits. For example, one might set 'numDigits' to '5' and ask the caller to enter a 5 digit zip code. When the caller enters the fifth digit of '94117', Freewili will immediately submit the data to the 'action' URL.

Nesting Rules
-------------
You can nest the following verbs within `<Gather>`:
*  `<Say>`
*  `<Play>`
*  `<Pause>`

Nested Rules
------------
Not Supported.

Examples
---------

### Example: _Simple Gather_ ###
This is the simplest case for a `<Gather>`. When Freewili executes this TwiML the application will pause for up to five seconds, waiting for the caller to enter digits on her keypad.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/simple_gather.xml -->
<Response>
    <Gather/>
</Response> 
~~~

If the caller enters digits followed by a '\#' symbol, Freewili submits those Digits in a POST request back to the current URL: http://example.com/simple_gather.xml

If the caller enters digits followed by five seconds of silence, Freewili submits those Digits in a POST request back to the current URL: http://example.com/simple_gather.xml

If the caller doesn't enter any digits and five seconds passes, Freewili does not make a request to any URL, but instead moves on to the next TwiML verb.

Since there are no more verbs, Freewili hangs up.

### Example: _Action/method and nested `<Say>` or `<Play>` verb_ ###
In this more complex example we add the 'action' and 'method' attributes. After the caller enters digits on the keypad, Freewili sends them in a request to the 'action' URL. We also add a nested `<Say>` verb. This means that input can be gathered at any time during `<Say>`.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/complex_gather.xml -->
<Response>
    <Gather action="/process_gather.php" method="GET">
        <Say>
            Please enter your account number, 
            followed by the pound sign
        </Say>
    </Gather>
    <Say>We didn't receive any input. Goodbye!</Say>
</Response>
~~~

~~~{ .php }
<?php
// page located at http://example.com/process_gather.php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<Response><Say>You entered " . $_REQUEST['Digits'] . "</Say></Response>";
?>
~~~

If the caller enters a digit during the speaking of the text, the `<Say>` verb will stop speaking and wait for digits, '\#' sign, or a timeout.

If `<Gather>` tag times out without input, the <Say> verb will complete and the `<Gather>` verb will exit without submitting. Freewili will then process the next verb in the document, which in this case is a `<Say>` verb which informs the caller that no input was received.

If the caller enters 12345 and then hits \# or allows five seconds to pass, Freewili will submit the digits as a GET request to http://yourserver/process_gather.php?Digits=12345.


Hints and Advanced Uses
-----------------------
When there are nested `<Say>` and `<Play>` verbs, the timeout begins after either the audio completes, or the first key is pressed.

When a `<Gather>` times out without user input, it will not submit to its action url, but will instead fall through to the next verb. If you wish to have the application submit on a timeout, use the `<Redirect>` verb:

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/gather_hints.xml -->
<Response>
    <Gather action="/process_gather.php" method="GET">
        <Say>Enter something, or not</Say>
    </Gather>
    <Redirect method="GET">
        /process_gather.php?Digits=TIMEOUT
    </Redirect>
</Response>
~~~

When `<Gather>` times out, Freewili moves on to the next verb, in this case `<Redirect>`. The `<Redirect>` verb instructs Freewili to make a new GET request to "/process_gather.php?Digits=TIMEOUT".

Troubleshooting
---------------
**Problem:** `<Gather>` isn't receiving caller input when using a VoIP phone.

**Solution:** Some VoIP phones have trouble sending DTMF digits. This is usually because these phones use compressed, bandwidth conserving audio protocols that interfere with the transmission of the digit's signal. Consult your phone's documentation on DTMF problems.

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.