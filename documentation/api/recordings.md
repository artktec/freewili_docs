%api.Recordings

%description

NodeName                 Description
-----------              ---------------
Sid	                     A 34 character string that uniquely identifies this resource.
DateCreated	             The date that this resource was created, given in RFC 2822 format.
DateUpdated	             The date that this resource was last updated, given in RFC 2822 format.
AccountSid	             The unique id of the Account responsible for this recording.
CallSid	                 The call during which the recording was made.
Duration                 The length of the recording, in seconds.
ApiVersion               The version of the API in use during the recording.
Uri	                     The URI for this resource, relative to https://api.freewili.com
SubresourceUris          The list of subresources under this account


%GET

Returns a list of Recording data, each node represents a recording generated during the course of a phone call.

### Query Filters ###
You can filter the results of the recordings listing by using the following
parameters as a query

Parameter	     Description
------------     ---------------
CallSid          Show only recordings made during the call given by this sid.
DateCreated      Only show recordings created on the given date. Should be 
                 formatted as YYYY-MM-DD. You can also specify inequality, such
                 as DateCreated<=YYYY-MM-DD for recordings generated at or 
                 before midnight on a date, and DateCreated>=YYYY-MM-DD
                                  
### Example ###

~~~
GET /2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings
~~~

~~~{ .xml }
<FreewiliResponse>
    <Recordings>
        <Recording>
            <Sid>fr557ce644e5ab84fa21cc21112e22c485</Sid>
            <AccountSid>fwda6f1e11047ebd6fe7a55f120be3a900</AccountSid>
            <CallSid>fc8dfedb55c129dd4d6bd1f59af9d11080</CallSid>
            <Duration>1</Duration>
            <DateCreated>Fri, 17 Jul 2009 01:52:49 +0000</DateCreated>
            <ApiVersion>2008-08-01</ApiVersion>
            <DateUpdated>Fri, 17 Jul 2009 01:52:49 +0000</DateUpdated>
            <Uri>/2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485</Uri>
        </Recording>
    </Recordings> 
</FreewiliResponse>
~~~

%GET.AccountSid

Returns one of several representations:

#### Default: WAV ####
Without an extension, or with a ".wav", a binary WAV audio file is returned with mime-type "audio/x-wav".

### Example ###

~~~
GET /2010-04-01/Account/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485
~~~

or 

~~~
GET /2010-04-01/Account/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485.wav
~~~

Returns:

A wav file.

#### Alternative: MP3 #####

Appending ".mp3" to the URI returns a binary MP3 audio file with mime-type type "audio/mpeg".

### Example ###

~~~
GET /2010-04-01/Account/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485.mp3
~~~

Returns:

A mp3 file.

#### Alternative: XML ####

Appending ".xml" to the URI returns a familiar XML representation.

### Example ###

~~~
GET /2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485.xml
~~~

Returns:

~~~{ .xml }
<FreewiliResponse>
  <Recording>
    <Sid>fr557ce644e5ab84fa21cc21112e22c485</Sid>
    <AccountSid>fwda6f1e11047ebd6fe7a55f120be3a900</AccountSid>
    <CallSid>fc8dfedb55c129dd4d6bd1f59af9d11080</CallSid>
    <Duration>1</Duration>
    <DateCreated>Fri, 17 Jul 2009 01:52:49 +0000</DateCreated>
    <ApiVersion>2008-08-01</ApiVersion>
    <DateUpdated>Fri, 17 Jul 2009 01:52:49 +0000</DateUpdated>
    <Uri>/2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485.xml</Uri>
  </Recording>
</FreewiliResponse>
~~~

%POST.AccountSid
Not Supported

%PUT.AccountSid
Not Supported

%DELETE.AccountSid
Deletes a recording from your account. If successful, returns HTTP 204 (No Content) with no body.

### Example ###

~~~
DELETE /2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Recordings/fr557ce644e5ab84fa21cc21112e22c485
~~~