%api.Conferences

%description

NodeName     | Description
------------ | ---------------
Sid	         | A 34 character string that uniquely identifies this conference.
FriendlyName | A user provided string that identifies this conference room.
Status	     | A string representing the status of the conference. May be init,
             | in-progress, or completed.
DateCreated	 | The date that this conference was created, given as GMT in 
             | RFC 2822 format.
DateUpdated	 | The date that this conference was last updated, given as GMT in 
             | RFC 2822 format.
AccountSid	 | The unique id of the Account responsible for creating 
             | this conference.
Uri	         | The URI for this resource, relative to 
             | https://api.freewili.com.


%GET

Retrieve a list of all the Conferences which are currently in session belonging to the master account.

### Query Filters ###
You can filter the results of the listing based off of 

Parameter	 | Description
------------ | ---------------
Status	     | Only show conferences currently in with this status. May be init, in-progress, or completed.
FriendlyName | List conferences who's FriendlyName is the exact match of this string.
DateCreated  | Only show conferences that started on this date, given as YYYY-MM-DD. 
             | You can also specify inequality, such as DateCreated<=YYYY-MM-DD for conferences that 
             | started at or before midnight on a date, and DateCreated>=YYYY-MM-DD for 
             | conferences that started at or after midnight on a date.
DateUpdated  | Only show conferences that were last updated on this date, given as YYYY-MM-DD.
             | You can also specify inequality, such as DateUpdated<=YYYY-MM-DD for conferences
             | that were last updated at or before midnight on a date, and DateUpdated>=YYYY-MM-DD

### Example ###

~~~
GET /2010-04-01/Accounts/AC5ef87.../Conferences
~~~

The returned data.

~~~{ .xml }
<FreewiliResponse>
    <Conferences>
        <Conference>
            <Sid>CFbbe46ff1274e283f7e3ac1df0072ab39</Sid>
            <AccountSid>AC5ef872f6da5a21de157d80997a64bd33</AccountSid>
            <FriendlyName>Party Line</FriendlyName>
            <Status>completed</Status>
            <DateCreated>Wed, 18 Aug 2010 20:20:06 +0000</DateCreated>
            <ApiVersion>2010-04-01</ApiVersion>
            <DateUpdated>Wed, 18 Aug 2010 20:24:32 +0000</DateUpdated>
            <Uri>/2010-04-01/Accounts/AC5ef872f6da5a21de157d80997a64bd33/Conferences/CFbbe46ff1274e283f7e3ac1df0072ab39</Uri>
            <SubresourceUris>
                <Participants>/2010-04-01/Accounts/AC5ef872f6da5a21de157d80997a64bd33/Conferences/CFbbe46ff1274e283f7e3ac1df0072ab39/Participants</Participants>
            </SubresourceUris>
        </Conference>
        ...
    </Conferences>
</FreewiliResponse>
~~~

%GET.AccountSid

Returns the data for a specific conference identified by by {ConferenceSid}

~~~
<FreewiliResponse>
    <Conference>
        <Sid>fcbbe46ff1274e283f7e3ac1df0072ab39</Sid>
        <AccountSid>fw5ef872f6da5a21de157d80997a64bd33</AccountSid>
        <FriendlyName>Party Line</FriendlyName>
        <Status>completed</Status>
        <DateCreated>Wed, 18 Aug 2010 20:20:06 +0000</DateCreated>
        <ApiVersion>2010-04-01</ApiVersion>
        <DateUpdated>Wed, 18 Aug 2010 20:24:32 +0000</DateUpdated>
        <Uri>/2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Conferences/fcbbe46ff1274e283f7e3ac1df0072ab39</Uri>
        <SubresourceUris>
            <Participants>/2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Conferences/fcbbe46ff1274e283f7e3ac1df0072ab39/Participants</Participants>
        </SubresourceUris>
    </Conference>
</FreewiliResponse>
~~~

%POST.AccountSid
Not Supported

%PUT.AccountSid
Not Supported

%DELETE.AccountSid
Not Supported