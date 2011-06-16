%api.IncomingPhoneNumbers

%description

NodeName             | Description
-------------------- | ---------------
Sid	                 | A 34 character string that uniquely identifies this
                     | resource.
DateCreated	         | The date that this resource was created, given as
                     | GMT RFC 2822 format.
DateUpdated	         | The date that this resource was last updated, given
                     | as GMT RFC 2822 format.
FriendlyName         | A human readable descriptive text for this resource,
                     | up to 64 characters long. By default, the FriendlyName
                     | is a nicely formatted version of the phone number.
AccountSid	         | The unique id of the Account responsible for this phone
                     | number.
PhoneNumber	         | The incoming phone number. e.g., +16175551212
                     | (E.164 format)
ApiVersion	         | Calls to this phone number will start a new TwiML
                     | session with this API version.
VoiceCallerIdLookup	 | Look up the caller's caller-ID name from the CNAM
                     | database (additional charges apply). Either true or
                     | false.
VoiceUrl	         | The URL Freewili will request when this phone number
                     | receives a call.
VoiceMethod	         | The HTTP method Freewili will use when requesting the
                     | above Url. Either GET or POST.
VoiceFallbackUrl	 | The URL that Freewili will request if an error occurs
                     | retrieving or executing the TwiML requested by Url.
VoiceFallbackMethod  | The HTTP method Freewili will use when requesting the
                     | VoiceFallbackUrl. Either GET or POST.
StatusCallback	     | The URL that Freewili will request to pass status
                     | parameters (such as call ended) to your application.
StatusCallbackMethod | The HTTP method Freewili will use to make requests to the
Uri	                 | The URI for this resource, relative to
                     | https://api.freewili.com.


%GET

Returns a list of IncomingPhoneNumber resource representations, each
representing a phone number given to your account. 

### Query Filters ###
You can filter the results of this listing by using the following
parameters as a query

Parameter    | Description
------------ | --------------
PhoneNumber  | Only show the incoming phone number resources that match
             | this pattern. You can specify partial numbers and use '*'
             | as a wildcard for any 
FriendlyName | Only return the Account resources with friendly names that
             | exactly match this name.

### Example ###
~~~
/2010-04-01/Accounts/{AccountSid}/IncomingPhoneNumbers
~~~

Returns

~~~{ .xml }
<FreewiliResponse>
    <IncomingPhoneNumbers>
        <IncomingPhoneNumber>
            <Sid>fi3f94c94562ac88dccf16f8859a1a8b25</Sid>
            <AccountSid>fwdc5f1e11047ebd6fe7a55f120be3a900</AccountSid>
            <FriendlyName>There will be Calls</FriendlyName>
            <PhoneNumber>+14152374451</PhoneNumber>
            <VoiceUrl>http://demo.twilio.com/long</VoiceUrl>
            <VoiceMethod>GET</VoiceMethod>
            <VoiceFallbackUrl/>
            <VoiceFallbackMethod/>
            <VoiceCallerIdLookup>false</VoiceCallerIdLookup>
            <DateCreated>Thu, 13 Nov 2008 07:56:24 +0000</DateCreated>
            <DateUpdated>Thu, 13 Nov 2008 08:45:58 +0000</DateUpdated>
            <Capabilities>
                <Voice>true</Voice>
            </Capabilities>
            <StatusCallback/>
            <StatusCallbackMethod/>
            <ApiVersion>2010-04-01</ApiVersion>
            <Uri>/2010-04-01/Accounts/fwdc5f1e11047ebd6fe7a55f120be3a900/IncomingPhoneNumbers/fi3f94c94562ac88dccf16f8859a1a8b25</Uri>
        </IncomingPhoneNumber>
    </IncomingPhoneNumbers>
</FreewiliResponse>

%GET.AccountSid

%POST.AccountSid

Tries to update the incoming phone number's properties, and returns the updated
resource representation if successful. The returned response is identical to
that returned above when making a GET request.

### Query Parameters ###
You can update the results of this listing by using the following
parameters as a query

Parameter                Description
------------             --------------
FriendlyName             A human readable description of the new incoming phone
                         number resource, with maximum length 64 characters.
ApiVersion               Calls to this phone number will start a new TwiML
                         session with this API version. Either 2010-04-01 
                         or 2008-08-01.
VoiceUrl                 The URL that Freewili should request when somebody dials 
                         the phone number.
VoiceMethod              The HTTP method that should be used to request the 
                         VoiceUrl. Either GET or POST. Defaults to POST.
VoiceFallbackUrl         A URL that Freewili will request if an error occurs
                         requesting or executing the TwiML defined by VoiceUrl.
VoiceFallbackMethod      The HTTP method that should be used to request the 
                         VoiceFallbackUrl. Either GET or POST. Defaults to POST.
StatusCallback           The URL that Freewili will request to pass status 
                         parameters (such as call ended) to your application.
StatusCallbackMethod     The HTTP method Freewili will use to make requests to the
                         StatusCallback URL. Either GET or POST.
SmsUrl                   The URL that Freewili should request when somebody sends 
                         an SMS to the new phone number.
SmsMethod                The HTTP method that should be used to request the 
                         SmsUrl. Either GET or POST. Defaults to POST.
SmsFallbackUrl           A URL that Freewili will request if an error occurs 
                         requesting or executing the TwiML defined by SmsUrl.
SmsFallbackMethod        The HTTP method that should be used to request the 
                         SmsFallbackUrl. Either GET or POST. Defaults to POST.
VoiceCallerIdLookup      Do a lookup of a caller's name from the CNAM database
                         and post it to your app. Either true or false. Defaults
                         to false.
AccountSid	             The unique 34 character id of the account to which you
                         wish to transfer this phone number. See Exchanging
                         Numbers Between Subaccounts
                         
### Examples ###

Set the VoiceUrl on a phone number to 'http://myapp.com/awesome/boombox'

~~~
POST /2010-04-01/Accounts/ACdc5f1.../IncomingPhoneNumbers/fi2a0747eba6abf96b7e3c3ff0b4530f6e?VoiceUrl=http://myapp.com/awesome/boombox
~~~

Returns

~~~{ .xml }
<FreewiliResponse>
    <IncomingPhoneNumber>
        <Sid>fi2a0747eba6abf96b7e3c3ff0b4530f6e</Sid>
        <AccountSid>fw755325d45d80675a4727a7a54e1b4ce4</AccountSid>
        <FriendlyName>Say Anythought</FriendlyName>
        <PhoneNumber>+15105647903</PhoneNumber>
        <VoiceUrl>http://myapp.com/awesome/boombox</VoiceUrl>
        <VoiceMethod>POST</VoiceMethod>
        <VoiceFallbackUrl/>
        <VoiceFallbackMethod>POST</VoiceFallbackMethod>
        <VoiceCallerIdLookup>false</VoiceCallerIdLookup>
        <DateCreated>Mon, 16 Aug 2010 23:00:23 +0000</DateCreated>
        <DateUpdated>Mon, 16 Aug 2010 23:00:23 +0000</DateUpdated>
        <Capabilities>
            <Voice>true</Voice>
        </Capabilities>
        <StatusCallback/>
        <StatusCallbackMethod/>
        <ApiVersion>2010-04-01</ApiVersion>
        <Uri>/2010-04-01/Accounts/fw755325d45d80675a4727a7a54e1b4ce4/IncomingPhoneNumbers/fi2a0747eba6abf96b7e3c3ff0b4530f6e</Uri>
    </IncomingPhoneNumber>
</FreewiliResponse>
~~~
                       
%DELETE.AccountSid

Release this phone number from your account. Freewili will no longer connect calls to this number. If you make a mistake, contact use POST to reconnect.

If successful, returns an HTTP 204 response with no body.