%api.Transcriptions

%description

NodeName                 Description
-----------              ---------------
Sid                      A 34 character string that uniquely identifies this resource.
DateCreated              The date that this resource was created, given in RFC 2822 format.
DateUpdated              The date that this resource was last updated, given in RFC 2822 format.
AccountSid               The unique id of the Account responsible for this transcription.
Status                   A string representing the status of the transcription: in-progress, completed or failed.
RecordingSid             The unique id of the Recording this Transcription was made of.
Duration                 The duration of the transcribed audio, in seconds.
TranscriptionText        The text content of the transcription.
Price                    The charge for this transcript in USD. Populated after the transcript is completed.
                         Note, this value may not be immediately available.
Uri                      The URI for this resource, relative to https://api.twilio.com


%GET

Returns a set of Transcription data sorted by 'DateUpdated', with most recent transcripts first.

### Example ###

~~~
GET /2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Transcriptions
~~~

Returns:

~~~{ .xml }
<FreewiliResponse>
    <Transcriptions>
        <Transcription>
            <Sid>fr8c61027b709ffb038236612dc5af8723</Sid>
            <DateCreated>Mon, 26 Jul 2010 00:09:58 +0000</DateCreated>
            <DateUpdated>Mon, 26 Jul 2010 00:10:25 +0000</DateUpdated>
            <AccountSid>fw5ef872f6da5a21de157d80997a64bd33</AccountSid>
            <Status>completed</Status>
            <Type>fast</Type>
            <RecordingSid>frca11f06dc31b5515a2dfb1f5134361f2</RecordingSid>
            <Duration>6</Duration>
            <TranscriptionText>Tommy? Tommy is that you? I told you never to call me again.</TranscriptionText>
            <ApiVersion>2010-04-01</ApiVersion>
            <Price>-0.05000</Price>
            <Uri>/2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Transcriptions/fr8c61027b709ffb038236612dc5af8723</Uri>
        </Transcription>
    </Transcriptions>
</FreewiliResponse>
~~~

%GET.AccountSid

Returns a single Transcription.

### Example ###

~~~
GET /2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Transcriptions/frca11f06dc31b5515a2dfb1f5134361f2
~~~

Returns:

~~~{ .xml }
<FreewiliResponse>
  <Transcription>
    <Sid>fr8c61027b709ffb038236612dc5af8723</Sid>
    <AccountSid>fw5ef872f6da5a21de157d80997a64bd33</AccountSid>
    <DateCreated>Mon, 26 Jul 2010 00:09:58 +0000</DateCreated>
    <DateUpdated>Mon, 26 Jul 2010 00:10:25 +0000</DateUpdated>
    <Status>completed</Status>
    <Type>fast</Type>
    <RecordingSid>frca11f06dc31b5515a2dfb1f5134361f2</RecordingSid>
    <Duration>6</Duration>
    <TranscriptionText>Tommy? Tommy is that you? I told you never to call me again.</TranscriptionText>
    <ApiVersion>2008-08-01</ApiVersion>
    <Price>-0.05000</Price>
    <Uri>/2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Transcriptions/fr8c61027b709ffb038236612dc5af8723</Uri>
  </Transcription>
</FreewiliResponse>
~~~

%POST.AccountSid
Not Supported

%PUT.AccountSid
Not Supported

%DELETE.AccountSid
Not Supported (This should be supported soon.)