%api.Notifications

%description

NodeName                 Description
-----------              ---------------
Sid                      A 34 character string that uniquely identifies this resource.
DateCreated              The date that this resource was created, given in RFC 2822 format.
DateUpdated              The date that this resource was last updated, given in RFC 2822 format.
AccountSid               The unique id of the Account responsible for this notification.
CallSid                  CallSid is the unique id of the call during which the notification was generated. 
                         Empty if the notification was generated by the REST API without regard to a specific phone call.
ApiVersion               The version of the Freewili in use when this notification was generated.
Log                      An integer log level corresponding to the type of notification: 0 is ERROR, 1 is WARNING.
ErrorCode                A unique error code for the error condition. You can lookup errors, 
                         with possible causes and solutions, in our Error Dictionary.
MoreInfo                 A URL for more information about the error condition. The URL is a page in our Error Dictionary.
MessageText              The text of the notification.
MessageDate              The date the notification was actually generated, given in RFC 2822 format. 
                         Due to buffering, this may be slightly different than the DateCreated date.
RequestUrl               The URL of the resource that generated the notification. 
                         If the notification was generated during a phone call: 
                         This is the URL of the resource on YOUR SERVER that caused the notification. 
                         If the notification was generated by your use of the REST API:
                         This is the URL of the REST resource you were attempting to request on Freewili's servers.
RequestMethod            The HTTP method in use for the request that generated the notification. 
                         If the notification was generated during a phone call: 
                         The HTTP Method use to request the resource on your server. 
                         If the notification was generated by your use of the REST API: 
                         This is the HTTP method used in your request to the REST resource on Freewili's servers.
RequestVariables	     The Freewili-generated HTTP GET or POST variables sent to your server. 
                         Alternatively, if the notification was generated by the REST API, 
                         this field will include any HTTP POST or PUT variables you sent to the REST API.
ResponseHeaders	         The HTTP headers returned by your server.
ResponseBody	         The HTTP body returned by your server.
Uri	                     The URI for this resource, relative to https://api.freewili.com



%GET

Returns a list of notifications generated for an account. The list is sorted by DateUpdated, with most recent notifications first.

### Query Filters ###
You can filter the results of your notifcations listing by using the following
parameters as a query

Parameter	     Description
------------     ---------------
Log              Only show notifications for this log, using the integer log
                 values shown above.
MessageDate      Only show notifications for this date. Should be formatted as
                 YYYY-MM-DD. You can also specify inequality, such as 
                 MessageDate<=YYYY-MM-DD for messages logged at or before 
                 midnight on a date, and MessageDate>=YYYY-MM-DD for messages
                 logged at or after midnight on a date. When performing a date
                 range query with day-granularity make sure the right endpoint
                 is midnight of the next day (e.g. to construct a range query 
                 for all calls on YYYY-MM-DD use 
                 MessageDate>=YYYY-MM-DD&MessageDate<YYYY-MM-(DD+1)


### Example ###

~~~
GET /2010-04-01/Accounts/ACda6f1.../Notifications
~~~

Returns 

~~~{ .xml }
<FreewiliResponse>
    <Notifications>
        <Notification>
            <Sid>fn5a7a84730f529f0a76b3e30c01315d1a</Sid>
            <AccountSid>fwda6f1e11047ebd6fe7a55f120be3a900</AccountSid>
            <CallSid>fca8857b0dcc71b4909aced594f7f87453</CallSid>
            <Log>0</Log>
            <ErrorCode>11205</ErrorCode>
            <MoreInfo>http://www.freewili.com/docs/errors/11205</MoreInfo>
            <MessageText>EmailNotification=false&LogLevel=ERROR&sourceComponent=13400&Msg=HTTP+Connection+Failure+-+Read+timed+out&ErrorCode=11205&msg=HTTP+Connection+Failure+-+Read+timed+out&url=4min19secs.mp3</MessageText>
            <MessageDate>Tue, 09 Feb 2010 01:23:53 +0000</MessageDate>
            <RequestMethod>POST</RequestMethod>
            <RequestUrl>http://where.freewili.com/is-welcome</RequestUrl>
            <DateCreated>Tue, 09 Feb 2010 01:23:53 +0000</DateCreated>
            <ApiVersion>2008-08-01</ApiVersion>
            <DateUpdated>Tue, 09 Feb 2010 01:23:53 +0000</DateUpdated>
            <Uri>/2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Notifications/fn5a7a84730f529f0a76b3e30c01315d1a</Uri>
        </Notification>
    </Notifications>
</FreewiliResponse>
~~~

%GET.AccountSid

This call gives back an individual notification entry.

### Example ###
~~~
GET /2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Notifications/fn5a7a84730f529f0a76b3e30c01315d1a
~~~

~~~{ .xml }
<TwilioResponse>
    <Notification>
        <Sid>fn5a7a84730f529f0a76b3e30c01315d1a</Sid>
        <AccountSid>fwda6f1e11047ebd6fe7a55f120be3a900</AccountSid>
        <CallSid>fca8857b0dcc71b4909aced594f7f87453</CallSid>
        <Log>0</Log>
        <ErrorCode>11205</ErrorCode>
        <MoreInfo>http://www.freewili.com/docs/errors/11205</MoreInfo>
        <MessageText>
            EmailNotification=false&LogLevel=ERROR&sourceComponent=13400&Msg=HTTP+Connection+Failure+-+Read+timed+out&ErrorCode=11205&msg=HTTP+Connection+Failure+-+Read+timed+out&url=4min19secs.mp3
        </MessageText>
        <MessageDate>Tue, 09 Feb 2010 01:23:53 +0000</MessageDate>
        <ResponseBody>
            <?xml version="1.0" encoding="UTF-8"?>&#10;<Response>&#10;&#9;<Play>4min19secs.mp3</Play>&#10;</Response>&#10;
        </ResponseBody>
        <RequestMethod>POST</RequestMethod>
        <RequestUrl>http://where.freewili.com/is-welcome</RequestUrl>
        <RequestVariables>
            AccountSid=fwda6f1e11047ebd6fe7a55f120be3a900&CallStatus=in-progress&Called=4152374451&CallerCountry=US&CalledZip=94937&CallerCity=&Caller=4150000000&CalledCity=INVERNESS&CalledCountry=US&DialStatus=answered&CallerState=California&CallSid=fca8857b0dcc71b4909aced594f7f87453&CalledState=CA&CallerZip=
        </RequestVariables>
        <ResponseHeaders>
            Date=Tue%2C+09+Feb+2010+01%3A23%3A38+GMT&Vary=Accept-Encoding&Content-Length=91&Content-Type=text%2Fxml&Accept-Ranges=bytes&Server=Apache%2F2.2.3+%28CentOS%29&X-Powered-By=PHP%2F5.1.6
        </ResponseHeaders>
        <DateCreated>Tue, 09 Feb 2010 01:23:53 +0000</DateCreated>
        <ApiVersion>2008-08-01</ApiVersion>
        <DateUpdated>Tue, 09 Feb 2010 01:23:53 +0000</DateUpdated>
        <Uri>
            /2010-04-01/Accounts/fwda6f1e11047ebd6fe7a55f120be3a900/Notifications/fn5a7a84730f529f0a76b3e30c01315d1a
        </Uri>
    </Notification>
</TwilioResponse>
~~~

%POST.AccountSid
Not Supported

%PUT.AccountSid
Not Supported

%DELETE.AccountSid
Not Supported