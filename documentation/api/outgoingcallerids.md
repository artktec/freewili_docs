%api.OutgoingCallerIds

%description

An OutgoingCallerId instance resource represents a single outgoing caller ID that is validated with Freewili for use when making outgoing calls via the REST API and within the TwiML <Dial> verb. The OutgoingCallerIds list resource represents the set of an account's validated outgoing caller ID phone numbers.

NodeName       Description
-----------    ---------------
Sid	           A 34 character string that uniquely identifies this resource.
DateCreated	   The date that this resource was created, given in
               RFC 2822 format.
DateUpdated	   The date that this resource was last updated, given in
               RFC 2822 format.
FriendlyName   A human readable descriptive text for this resource, up to 64
               characters long. By default, the FriendlyName is a nicely
               formatted version of the phone number.
AccountSid	   The unique id of the Account responsible for this Caller Id.
PhoneNumber	   The incoming phone number. Formatted with a '+' and country code
               e.g., +16175551212 (E.164 format).
Uri	           The URI for this resource, relative to 
               https://api.freewili.com.


%GET

Returns a list of OutgoingCallerId resource representations, each representing a Caller ID number valid for an account.

### Query Filters ###
You can filter the results of the outgoing callerids listing by using the following
parameters as a query

Parameter	     Description
------------     ---------------
PhoneNumber      Only show the caller id resource that exactly matches
                 this phone number.
FriendlyName     Only show the caller id resource that exactly matches 
                 this name.

### Examples ###
~~~
GET /2010-04-01/Accounts/fw228ba7a5fe4238be081ea6f3c44186f3/OutgoingCallerIds
~~~

Returns:

~~~{ .xml }
<FreewiliResponse>
    <OutgoingCallerIds>
        <OutgoingCallerId>
            <Sid>foe905d7e6b410746a0fb08c57e5a186f3</Sid>
            <AccountSid>fw228ba7a5fe4238be081ea6f3c44186f3</AccountSid>
            <FriendlyName>(510) 555-5555</FriendlyName>
            <PhoneNumber>+15105555555</PhoneNumber>
            <DateCreated>Tue, 27 Jul 2010 20:21:11 +0000</DateCreated>
            <DateUpdated>Tue, 27 Jul 2010 20:21:11 +0000</DateUpdated>
            <Uri>/2010-04-01/Accounts/fw228ba7a5fe4238be081ea6f3c44186f3/OutgoingCallerIds/foe905d7e6b410746a0fb08c57e5a186f3</Uri>
        </OutgoingCallerId>
    </OutgoingCallerIds>
</FreewiliResponse>
~~~

%GET.AccountSid

### Examples ###
~~~
GET /2010-04-01/Accounts/fw228ba7a5fe4238be081ea6f3c44186f3/OutgoingCallerIds/foe905d7e6b410746a0fb08c57e5a186f3
~~~

Returns:

~~~{ .xml }
<FreewiliResponse>
    <OutgoingCallerId>
        <Sid>foe905d7e6b410746a0fb08c57e5a186f3</Sid>
        <AccountSid>fw228ba7a5fe4238be081ea6f3c44186f3</AccountSid>
        <FriendlyName>(510) 555-5555</FriendlyName>
        <PhoneNumber>+15105555555</PhoneNumber>
        <DateCreated>Tue, 27 Jul 2010 20:21:11 +0000</DateCreated>
        <DateUpdated>Tue, 27 Jul 2010 20:21:11 +0000</DateUpdated>
        <Uri>/2010-04-01/Accounts/fw228ba7a5fe4238be081ea6f3c44186f3/OutgoingCallerIds/foe905d7e6b410746a0fb08c57e5a186f3</Uri>
    </OutgoingCallerId>
</FreewiliResponse>
~~~

%POST.AccountSid

Adds a new CallerID to your account. After making this request, Freewili will return to you a validation code and Freewili will dial the phone number given to perform validation. The code returned must be entered via the phone before the CallerID will be added to your account. The following will be returned:

NodeName            Description
-----------         ---------------
AccountSid          The unique id of the Account to which the Validation Request
                    belongs.
PhoneNumber         The incoming phone number being validated, formatted with a
                    '+' and country code e.g., +16175551212 (E.164 format).
FriendlyName        The friendly name you provided, if any.
ValidationCode      The 6 digit validation code that must be entered via the 
                    phone to validate this phone number for Caller ID.

The following parameters are accepted to start your validation call:          

### Query Parameters ###
You can update the results of this listing by using the following
parameters as a query

**Required**

Parameter                Description
------------             --------------
PhoneNumber              The phone number to verify. Should be formatted with
                         a '+' and country code e.g., +16175551212 
                         (E.164 format). Freewili will also accept 
                         
**Optional**

Parameter                Description
------------             --------------
FriendlyName             A human readable description for the new caller ID with
                         maximum length 64 characters. Defaults to a nicely 
                         formatted version of the number.
CallDelay                The number of seconds, between 0 and 60, to delay 
                         before initiating the validation call. Defaults to 0.
Extension                Digits to dial after connecting the validation call.


### Example ###
~~~
POST /2010-04-01/Accounts/fw228ba7a5fe4238be081ea6f3c44186f3/OutgoingCallerIds?FriendlyName=My+Home+Phone+Number&PhoneNumber=+14158675309
~~~
<FreewiliResponse>
    <ValidationRequest> 
        <AccountSid>fw228ba7a5fe4238be081ea6f3c44186f3</AccountSid>
        <PhoneNumber>+14158675309</PhoneNumber>
        <FriendlyName>My Home Phone Number</FriendlyName>
        <ValidationCode>123456</ValidationCode>
    </ValidationRequest> 
</FreewiliResponse>
~~~{ .xml }

~~~
%PUT.AccountSid
Not Supported

%DELETE.AccountSid
Not Supported