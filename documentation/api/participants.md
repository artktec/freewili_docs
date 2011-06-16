%api.Participants

%description

NodeName               | Description
---------------------- | ---------------
CallSid	               | A 34 character string that uniquely identifies the call
                       | that is connected to this conference
ConferenceSid          | A 34 character string that identifies the conference
                       | this participant is in
DateCreated	           | The date that this resource was created, given
                       | in  RFC 2822 format.
DateUpdated	           | The date that this resource was last updated, given
                       | in RFC 2822 format.
AccountSid	           | The unique id of the Account that created this 
                       | conference
Muted	               | True if this participant is currently muted. 
                       | false otherwise.
StartConferenceOnEnter | Was the startConferenceOnEnter attribute set on this
                       | participant (true or false)?
EndConferenceOnExit    | Was the endConferenceOnExit attribute set on this
                       | participant (true or false)?
Uri	                   | The URI for this resource, relative to 
                       | https://api.freewili.com.


%GET

Returns the list of participants in the conference identified by {ConferenceSid}.

### Query Filters ###
You can filter the results of the participants listing by using the following
parameters as a query

Parameter	 | Description
------------ | ---------------
Muted	     | Only show participants that are muted or unmuted. Either true or
             | false

### Example ###

~~~
GET /2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Conferences/fcbbe46ff1274e283f7e3ac1df0072ab39/Participants
~~~

Returns :

~~~{ .xml }
<FreewiliResponse>
    <Participants>
        <Participant>
            <ConferenceSid>fobbe46ff1274e283f7e3ac1df0072ab39</ConferenceSid>
            <AccountSid>fw5ef872f6da5a21de157d80997a64bd33</AccountSid>
            <CallSid>fc386025c9bf5d6052a1d1ea42b4d16662</CallSid>
            <Muted>false</Muted>
            <EndConferenceOnExit>true</EndConferenceOnExit>
            <StartConferenceOnEnter>true</StartConferenceOnEnter>
            <DateCreated>Wed, 18 Aug 2010 20:20:10 +0000</DateCreated>
            <DateUpdated>Wed, 18 Aug 2010 20:20:10 +0000</DateUpdated>
            <Uri>/2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Conferences/fobbe46ff1274e283f7e3ac1df0072ab39/Participants/fc386025c9bf5d6052a1d1ea42b4d16662</Uri>
        </Participant>
    </Participants>
</FreewiliResponse>
~~~

%GET.AccountSid

Returns a representation of this participant:

### Example ###

~~~
GET /2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Conferences/fobbe46ff1274e283f7e3ac1df0072ab39/Participants/fc386025c9bf5d6052a1d1ea42b4d16662
~~~

Returns :

~~~{ .xml }
<FreewiliResponse>
    <Participant>
        <CallSid>fc386025c9bf5d6052a1d1ea42b4d16662</CallSid>
        <ConferenceSid>fobbe46ff1274e283f7e3ac1df0072ab39</ConferenceSid>
        <AccountSid>fw5ef872f6da5a21de157d80997a64bd33</AccountSid>
        <Muted>false</Muted>
        <EndConferenceOnExit>true</EndConferenceOnExit>
        <StartConferenceOnEnter>true</StartConferenceOnEnter>
        <DateCreated>Wed, 18 Aug 2010 20:20:10 +0000</DateCreated>
        <DateUpdated>Wed, 18 Aug 2010 20:20:10 +0000</DateUpdated>
        <Uri>/2010-04-01/Accounts/AC5ef872f6da5a21de157d80997a64bd33/Conferences/CFbbe46ff1274e283f7e3ac1df0072ab39/Participants/CA386025c9bf5d6052a1d1ea42b4d16662</Uri>
    </Participant>
</FreewiliResponse>
~~~

%POST.AccountSid

Updates the status of a participant.

### Update-able Parameters ###
You can filter the results of the participants listing by using the following
parameters as a query

Parameter	     Description
------------     ---------------
Muted	         Specifying true will mute the participant, while false will
                 un-mute.


%PUT.AccountSid
Not Supported

%DELETE.AccountSid

Kick this participant from the conference. Returns HTTP 204 (No Content), with no body, if the participant was successfully booted from the conference.

### Example ###

~~~
DELETE /2010-04-01/Accounts/fw5ef872f6da5a21de157d80997a64bd33/Conferences/fobbe46ff1274e283f7e3ac1df0072ab39/Participants/fc386025c9bf5d6052a1d1ea42b4d16662
~~~
