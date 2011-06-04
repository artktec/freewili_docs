%twiml.Conference

TwiML \<Conference>
==================

The `<Dial>` verb's `<Conference>` noun allows you to connect to a conference room. Much like how the `<Number>` noun allows you to connect to another phone number, the `<Conference>` noun allows you to connect to a named conference room and talk with the other callers who have also connected to that room.

The name of the room is up to you and is namespaced to your account. This means that any caller who joins 'room1234' via your account will end up in the same conference room, but callers connecting through different accounts would not. The maximum number of participants in a single Freewili conference room is 10.

By default, Freewili conference rooms enable a number of useful features used by business conference bridges:
     * Conferences do not start until at least two participants join.
     * While waiting, customizable background music is played.
     * When participants join and leave, notification sounds are played to inform the other participants.

You can configure or disable each of these features based on your particular needs.

Noun Attributes
---------------

The `<Conference>` noun supports the following attributes that modify its behavior:

Attribute Name         | Allowed Values     | Default Value
---------------------- | --------------     | -------------
muted                  | true, false        | false
beep                   | true, false        | true
startConferenceOnEnter | true, false        | true
endConferenceOnExit    | true, false        | false
waitUrl                | TwiML url, empty   | default Twilio hold music 
                       | string             |
waitMethod             | GET or POST        | POST
maxParticipants        | positive integer   | 10 
                       |  <= 10             |

### muted ###
The 'muted' attribute lets you specify whether a participant can speak on the conference. If this attribute is set to 'true', the participant will only be able to listen to people on the conference. This attribute defaults to 'false'.

### beep ###
The 'beep' attribute lets you specify whether a notification beep is played to the conference when a participant joins or leaves the conference. This defaults to 'true'.

### startConferenceOnEnter ###
This attribute tells a conference to start when this participant joins the conference, if it is not already started. This is true by default. If this is false and the participant joins a conference that has not started, they are muted and hear background music until a participant joins where startConferenceOnEnter is true. This is useful for implementing moderated conferences.

### endConferenceOnExit ###
If a participant has this attribute set to 'true', then when that participant leaves, the conference ends and all other participants drop out. This defaults to 'false'. This is useful for implementing moderated conferences that bridge two calls and allow either call leg to continue executing TwiML if the other hangs up.

### waitUrl ###
The 'waitUrl' attribute lets you specify a URL for music that plays before the conference has started. The URL may be an MP3, a WAV or a TwiML document that uses `<Play>` or `<Say>` for content. This defaults to a selection of Creative Commons licensed background music, but you can replace it with your own music and messages. If the 'waitUrl' responds with TwiML, Freewili will only process `<Play>`, `<Say>`, and `<Redirect>` verbs. `<Record>`, `<Dial>`, and `<Gather>` verbs are not allowed. If you do not wish anything to play while waiting for the conference to start, specify the empty string (set 'waitUrl' to '').

If no 'waitUrl' is specified, Freewili will use Twilio's public AWS S3 Bucket for audio files. The default 'waitUrl' is:

http://twimlets.com/holdmusic?Bucket=com.twilio.music.classical

This URL points at S3 bucket com.twilio.music.classical, containing a selection of nice Creative Commons classical music. Here's a list of S3 buckets we've assembed with other genres of music for you to choose from:

Bucket                       | Twimlet URL
---------------------------- | -----------
com.twilio.music.classical   | http://twimlets.com/holdmusic?Bucket=com.twilio.music.classical
com.twilio.music.ambient     | http://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient
com.twilio.music.electronica | http://twimlets.com/holdmusic?Bucket=com.twilio.music.electronica
com.twilio.music.guitars     | http://twimlets.com/holdmusic?Bucket=com.twilio.music.guitars
com.twilio.music.rock        | http://twimlets.com/holdmusic?Bucket=com.twilio.music.rock
com.twilio.music.soft-rock   | http://twimlets.com/holdmusic?Bucket=com.twilio.music.soft-rock

### waitMethod ###
This attribute indicates which HTTP method to use when requesting 'waitUrl'. It defaults to 'POST'. Be sure to use 'GET' if you are directly requesting static audio files such as WAV or MP3 files so that Freewili properly caches the files.

### maxParticipants ###
This attribute indicates the maximum number of participants you want to allow within a named conference room. The default maximum number of participants is 40. The value must be a positive integer less than or equal to 40.

Nesting Rules
-------------
Not Supported.

Nested Rules
------------
Not Supported.

Examples
--------

### Example: _A Simple Conference_ ###
By default, the first caller to execute this TwiML would join conference room 1234 and listen to the default waiting music. When the next caller executed this TwiML, they would join the same conference room and the conference would start. The default background music ends, the notification beep is played and all parties can communicate.

~~~{ .xml }
<Response>
  <Dial>
    <Conference>1234</Conference>
  </Dial>
</Response>
~~~

### Example: _A Moderated Conference_ ###
First, you can drop a number of people into the conference, specifying that the conference shouldn't yet start:

~~~{ .xml }
<Response>
  <Dial>
    <Conference startConferenceOnEnter="false">1234</Conference>
  </Dial>
</Response>
~~~

Each person will hear hold music while they wait. When the "moderator" or conference organizer calls in, you can specify that the conference should begin:

~~~{ .xml }
<Response>
  <Dial>
    <Conference startConferenceOnEnter="true" endConferenceOnExit="true">
      1234
    </Conference>
  </Dial>
</Response>
~~~

Also note that since the moderator has "endConferenceOnExit='true'" set, then when the moderator hangs up, the conference will end and each participant's `<Dial>` will complete.

### Example: _Join a Conference Muted_ ###
This code allows forces participants to join the conference room muted. They can hear what unmuted participants are saying but no one can hear them. The muted attribute can be enabled or disabled in realtime via the REST API.

~~~{ .xml }
<Response>
  <Dial>
    <Conference muted="true">SimpleRoom</Conference>
  </Dial>
</Response>
~~~

### Example: _Bridging Calls_ ###
Sometimes you just want to bridge to calls together without any of the bells and whistles. With this minimal conferencing attribute setup, no background music or beeps are played, participants can speak right away as they join, and the conference ends right away if either participant hangs up. This is useful for cases like bridging two existing calls, much like you would with a Dial.

~~~{ .xml }
<Response>
  <Dial>
    <Conference beep="false" waitUrl="" startConferenceOnJoin="true" endConferenceOnExit="true">
      NoMusicNoBeepRoom
    </Conference>
  </Dial>
</Response>
~~~

### Example: _Call on Hold_ ###

~~~{.xml }
<Response>
  <Dial>
    <Conference beep="false">
      Customer Waiting Room
    </Conference>
  </Dial>
</Response>
~~~

This code puts the first caller into a waiting room, where they'll hear music. It's as if they're on hold, waiting for an agent or operator to help them.
Then, when the operator or agent is ready to talk to them... their call would execute:

~~~{ .xml }
<Response>
  <Dial>
    <Conference beep="false" endConferenceOnExit="true">
      Customer Waiting Room
    </Conference>
  </Dial>
</Response>
~~~

This code would join the operator with the person who was holding. Because the conference starts when they enter, the wonderful hold music the first person was hearing will stop, and the two people will begin talking. Because "beep='false'", the caller won't hear a ding when the agent answers, which is probably appropriate for this use case. When the operator hangs up, then 'endConferenceOnExit' will cause the conference to end.


### Example: _Combining with Dial attributes_ ###
Because Conference is an element of Dial, you can still use all the Dial attributes in combination with Conference (with the exception of callerId and timeout, which have no effect). You can set a timeLimit, after which you'll be removed from the conference. You can turn on hangupOnStar, which lets you leave a conference by pressing the * key. You can specify an action, so that after you leave the conference room Freewili will submit to the action and your web server can respond with new TwiML and continue your call.

~~~{ .xml }
<Response>
  <Dial action="handleLeaveConference.php" method="POST" hangupOnStar="true" timeLimit="30">
    <Conference>LoveWillis</Conference>
  </Dial>
</Response>
~~~

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.