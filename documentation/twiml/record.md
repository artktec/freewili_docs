%twiml.Record

TwiML `<Record>`
=====================

The `<Record>` verb records the caller's voice and returns to you the URL of a file containing the audio recording. You can optionally generate text transcriptions of recorded calls by setting the 'transcribe' attribute of the `<Record>` verb to 'true'.

Verb Attributes
----------------
The `<Record>` verb supports the following attributes that modify its behavior:

Attribute Name      Allowed Values      Default Value
--------------      --------------      -------------
action              relative or         current document URL
                    absolute URL
method              GET, POST           POST
timeout             positive integer    5
finishOnKey         any digit, #, *     1234567890*#
maxLength           integer greater     3600 (1 hour) 
                    than 1
transcribe          true, false         false
transcribeCallback  relative or         none
                    absolute URL
playBeep            true, false         true

### action ###
The 'action' attribute takes an absolute or relative URL as a value. When recording is finished Freewili will make a GET or POST request to this URL including the parameters below. If no 'action' is provided, `<Record>` will default to requesting the current document's URL.

After making this request, Freewili will continue the current call using the TwiML received in your response. Keep in mind that by default Freewili will re-request the current document's URL, which can lead to unwanted looping behavior if you're not careful. Any TwiML verbs occuring after a `<Record>` are unreachable.

There is one exception: if Freewili receives an empty recording, it will not make a request to the 'action' URL. The current call flow will continue with the next verb in the current TwiML document.

#### Request Parameters ####
Freewili will pass the following parameters in addition to the standard TwiML Voice request parameters with its request to the 'action' URL:
Parameter           Description
---------           -----------
RecordingUrl        the URL of the recorded audio
RecordingDuration   the time duration of the recorded audio
Digits              the key (if any) pressed to end the recording or 'hangup' if the caller hung up

### method ###
The 'method' attribute takes the value 'GET' or 'POST'. This tells Freewili whether to request the 'action' URL via HTTP GET or POST. This attribute is modeled after the HTML form 'method' attribute. 'POST' is the default value.

### timeout ###
The 'timeout' attribute tells Freewili to end the recording after a number of seconds of silence has passed. The default is 5 seconds.

### finishOnKey ###
The 'finishOnKey' attribute lets you choose a set of digits that end the recording when entered. For example, if you set 'finishOnKey' to '#' and the caller presses '#', Freewili will immediately stop recording and submit 'RecordingUrl', 'RecordingDuration', and the '#' as parameters in a request to the 'action' URL. The allowed values are the digits 0-9, '#' and '*'. The default is '1234567890*#' (i.e. any key will end the recording). Unlike `<Gather>`, you may specify more than one character as a 'finishOnKey' value.

### maxLength ###
The 'maxLength' attribute lets you set the maximum length for the recording in seconds. If you set 'maxLength' to '30', the recording will automatically end after 30 seconds of recorded time has elapsed. This defaults to 3600 seconds (one hour) for a normal recording and 120 seconds (two minutes) for a transcribed recording.

### transcribe ###
The 'transcribe' attribute tells Freewili that you would like a text representation of the audio of the recording. Freewili will pass this recording to our speech-to-text engine and attempt to convert the audio to human readable text. The 'transcribe' option is off by default. If you do not wish to perform transcription, simply do not include the transcribe attribute.

Note: transcription is a pay feature. If you include a 'transcribe' or 'transcribeCallback' attribute on your `` verb your account will be charged. See the pricing page for our transcription prices. 

Additionally, transcription is currently limited to recordings with a duration of two minutes or less. If you enable transcription and set 'maxLength' > 120 seconds, Freewili will write a warning to your debug log rather than transcribing the recording.

### transcribeCallback ###
The 'transcribeCallback' attribute is used in conjunction with the 'transcribe' attribute. It allows you to specify a URL to which Freewili will make an asynchronous POST request when the transcription is complete. This is not a request for TwiML and the response will not change call flow, but the request will contain the standard TwiML request parameters as well as 'TranscriptionStatus', 'TranscriptionText', 'TranscriptionUrl' and 'RecordingUrl'. If 'transcribeCallback' is not specified, the completed transcription will be stored for you to retrieve later (see the REST API Transcriptions section), but Freewili will not asynchronously notify your application.
Request Parameters
Freewili will pass the following parameters in addition to the standard TwiML Voice request parameters with its request to the 'transcribeCallback' URL:

Parameter           Description
---------           -----------
TranscriptionText   Contains the text of the transcription.
TranscriptionStatus The status of the transcription attempt: either 'completed' or 'failed'.
TranscriptionUrl    The URL for the transcription's REST API resource.
RecordingUrl        The URL for the transcription's source recording resource.

### playBeep ###
The 'playBeep' attribute allows you to toggle between playing a sound before the start of a recording. If you set the value to 'false', no beep sound will be played.

Nesting Rules
-------------
Not Supported

Nested Rules
------------
Not Supported

Examples
--------

### Example: _Simple Record_ ###
Freewili will execute the `<Record>` verb causing the caller to hear a beep and the recording to start. If the caller is silent for more than 5 seconds, hits the '#' key, or the recording maxlength time is hit, Freewili will make an HTTP POST request to the default 'action' (the current document URL) with the parameters 'RecordingUrl' and 'RecordingDuration'.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/simple_record.xml -->
<Response>  
    <Record/>  
</Response>
~~~

### Example: _Record a voicemail_ ###
This is example shows a simple voicemail prompt. The caller is asked to leave a message at the beep. The `<Record>` verb beeps and begins recording up to 20 seconds of audio.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/voicemail_record.xml -->
<Response>
    <Say>
        Please leave a message at the beep. 
        Press the star key when finished. 
    </Say>
    <Record
        action="http://foo.edu/handleRecording.php"
        method="GET"
        maxLength="20"
        finishOnKey="*"
        />
    <Say>I did not receive a recording</Say>
</Response>
~~~

If the caller does not speak at all, the `<Record>` verb exits after 5 seconds of silence, falling through to the next verb in the document. In this case, it would fall through to the `<Say>` verb.

If the caller speaks for less that 20 seconds and is then silent for 5 seconds, Freewili makes a GET request to the 'action' URL. The `<Say>` verb is never reached.

If the caller speaks for the full 20 seconds, Freewili makes a GET request to the 'action' URL. The `<Say>` verb is never reached.

### Example: _Transcribe a recording_ ###
Freewili will record the caller. When the recording is complete, Freewili will transcribe the recording and make an HTTP POST request to the 'transcribeCallback' URL with a parameter containing a transcription of the recording.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8"?>
<!-- page located at http://example.com/record_and_transcribe.xml -->
<Response>
    <Record transcribe="true" transcribeCallback="/handle_transcribe.php"/>
</Response>
~~~
 
Hints and Advanced Uses
------------------------
Freewili will trim leading and trailing silence from your audio files. This may cause the duration of the files to be slightly smaller than the time a caller spends recording them.

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.