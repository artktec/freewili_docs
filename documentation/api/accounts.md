%api.Accounts

%description
When you first sign up with Freewili, you have just one account, your Master
account. But you can also create more accounts... subaccounts are useful for
things like segmenting phone numbers and usage data for your customers and
controlling access to data. For more information on subaccounts see Using
Subaccounts.

The Account data is represented by the following properties:

NodeName            Description
-------------       ---------------
Sid	                A 34 character string that uniquely identifies this account.
DateCreated	        The date that this account was created, in GMT in 
                    RFC 2822 format
DateUpdated	        The date that this account was last updated, in GMT in
                    RFC 2822 format.
FriendlyName        A human readable description of this account, up to 64 characters
                    long. By default the FriendlyName is your email address.
Status	            The status of this account. Usually active, but can be suspended
                    if you've been bad, or closed if you've been horrible.
AuthToken	        The authorization token for this account. This token should be
                    kept a secret, so no sharing.
Uri	                The URI for this resource, relative to https://api.freewili.com.
SubresourceUris     The list of subresources under this account.

Accessing all accounts
=========================================

%GET
Retrieve a list of all the Accounts belonging to the master account.

### Query Filters ###
You can filter the results of this listing by using the following
parameters as a query

Parameter           Description
------------        --------------
FriendlyName        Only return the Account resources with friendly names that
                    exactly match this name.
Status	            Only return Account resources with the given status. Can be closed,
                    suspended or active

### Example ###
~~~
GET /2010-04-01/Accounts
~~

The returned data.

~~~{ .xml }
<FreewiliResponse>
  <Accounts page="0" numpages="1" pagesize="50" total="1" start="0" end="1" uri="/2010-04-01/Accounts" firstpageuri="/2010-04-01/Accounts?Page=0&amp;PageSize=50" previouspageuri="" nextpageuri="" lastpageuri="/2010-04-01/Accounts?Page=0&amp;PageSize=50">
    <Account>
      <Sid>AC39b8702b46fbbbf3f2956a63ee851a01</Sid>
      <FriendlyName>Chieftain</FriendlyName>
      <Status>active</Status>
      <AuthToken>redacted</AuthToken>
      <DateCreated>Tue, 12 Jan 2010 04:41:09 +0000</DateCreated>
      <DateUpdated>Tue, 25 Jan 2011 07:24:36 +0000</DateUpdated>
      <Type>Full</Type>
      <Uri>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01</Uri>
      <SubresourceUris>
        <AvailablePhoneNumbers>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/AvailablePhoneNumbers</AvailablePhoneNumbers>
        <Calls>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/Calls</Calls>
        <Conferences>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/Conferences</Conferences>
        <IncomingPhoneNumbers>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/IncomingPhoneNumbers</IncomingPhoneNumbers>
        <Notifications>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/Notifications</Notifications>
        <OutgoingCallerIds>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/OutgoingCallerIds</OutgoingCallerIds>
        <Recordings>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/Recordings</Recordings>
        <Sandbox>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/Sandbox</Sandbox>
        <SMSMessages>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/SMS/Messages</SMSMessages>
        <Transcriptions>/2010-04-01/Accounts/AC39b8702b46fbbbf3f2956a63ee851a01/Transcriptions</Transcriptions>
      </SubresourceUris>
    </Account>
  </Accounts>
</FreewiliResponse>
~~~

%GET.Sid
Using HTTP GET you can get data from any account you have authorization for,
using the account number in the path.

### Example ###
~~~
GET /2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d
~~~

The data in the response.

~~~{ .xml }
<FreewiliResponse>
  <Account>
    <Sid>fwba8bc05eacf94afdae398e642c9cc32d</Sid>
    <FriendlyName>Do you like my friendly name?</FriendlyName>
    <Status>active</Status>
    <DateCreated>Wed, 04 Aug 2010 21:37:41 +0000</DateCreated>
    <DateUpdated>Fri, 06 Aug 2010 01:15:02 +0000</DateUpdated>
    <AuthToken>redacted</AuthToken>
    <Uri>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d</Uri>
    <SubresourceUris>
      <AvailablePhoneNumbers>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/AvailablePhoneNumbers</AvailablePhoneNumbers>
      <Calls>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Calls</Calls>
      <Conferences>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Conferences</Conferences>
      <IncomingPhoneNumbers>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/IncomingPhoneNumbers</IncomingPhoneNumbers>
      <Notifications>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Notifications</Notifications>
      <OutgoingCallerIds>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/OutgoingCallerIds</OutgoingCallerIds>
      <Recordings>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Recordings</Recordings>
      <Sandbox>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Sandbox</Sandbox>
      <SMSMessages>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/SMS/Messages</SMSMessages>
      <Transcriptions>/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Transcriptions</Transcriptions>
    </SubresourceUris>
  </Account>
</FreewiliResponse>
~~~
%example.json
~~~
{
  "FreewiliResponse": {
    "Account": {
      "Sid" : "fwba8bc05eacf94afdae398e642c9cc32d",
      "FriendlyName" : "Do you like my friendly name?",
      "Status" : "active",
      "DateCreated" : "Wed, 04 Aug 2010 21:37:41 +0000",
      "DateUpdated" : "Fri, 06 Aug 2010 01:15:02 +0000",
      "AuthToken" : "c05eacff94afdae398e6ba8bc05eacf94afdae398e642c9cc3",
      "Uri" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d",
      "SubresourceUris" : {
        "AvailablePhoneNumbers" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/AvailablePhoneNumbers</AvailablePhoneNumbers",
        "Calls" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Calls",
        "Conferences" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Conferences",
        "IncomingPhoneNumbers" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/IncomingPhoneNumbers",
        "Notifications" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Notifications",
        "OutgoingCallerIds" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/OutgoingCallerIds",
        "Recordings" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Recordings",
        "Sandbox" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Sandbox",
        "SMSMessages" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/SMS/Messages",
        "Transcriptions" : "/2010-04-01/Accounts/fwba8bc05eacf94afdae398e642c9cc32d/Transcriptions"
      }
    }
  }
}
~~~

%POST.Sid

%description

%properties