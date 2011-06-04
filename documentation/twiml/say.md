%twiml.Say

TwiML <Say>
==================

The `<Say>` verb converts text to speech that is read back to the caller. `<Say>` is useful for development or saying dynamic text that is difficult to pre-record.

Verb Attributes
---------------
The `<Say>` verb supports the following attributes that modify its behavior:

Attribute Name	     Allowed Values	     Default Value
----------------     --------------      --------------
voice                man, woman          man
language             en, es, fr, de      en
loop                 integer >= 0        1

### voice ###
The 'voice' attribute allows you to choose a male or female voice to read text back. The default value is 'man'.

### language ###
The 'language' attribute allows you pick a voice with a specific language's accent and pronunciations. Freewili currently supports languages 'en' (English), 'es' (Spanish), 'fr' (French), and 'de' (German). The default is 'en'.

### loop ###
The 'loop' attribute specifies how many times you'd like the text repeated. The default is once. Specifying '0' will cause the the `<Say>` verb to loop until the call is hung up.

Nouns

Noun                Description
-------             ------------
`<plain text>`        The text Freewili will read to the caller. Limited to 4KB.

Nesting Rules
--------------
The verbs that can be nested under `<say>`. None. Not Supported

Nested Rules
-------------
The verbs that `<say>` can be nested under. 

* `<Gather>`

### Example: _Hello World_ ###

When a call is directed to the following TwiML document, the caller will hear "hello world" spoken once in a male voice.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8" ?>
<Response>
     <Say>Hello World</Say>
</Response>
~~~

### Example: _Hello, Hello_ ###

This TwiML document tells Freewili to say "hello" twice in a row with a female voice.

~~~{ .xml }
<?xml version="1.0" encoding="UTF-8" ?>
<Response>
     <Say voice="woman" loop="2">Hello</Say>
</Response>
~~~

Hints and Advanced Uses
------------------------
There is a 4KB limit on the text that `<Say>` can process.

When translating text to speech, the `<Say>` verb will make assumptions about how to pronounce numbers, dates, times, amounts of money and other abbreviations. Test these situations well.

When saying numbers, '12345' will be spoken as "twelve thousand three hundred forty five." Whereas '1 2 3 4 5' will be spoken as "one two three four five."

Punctuation such as commas and periods will be interpreted as natural pauses by the speech engine.

`<Say>` is useful for saying dynamic text that would be difficult to pre-record. In cases where the contents of `<Say>` are static, you might consider recording a live person saying the phrase and using the `<Play>` verb instead.

If you want to insert a long pause try using the `<Pause>` verb. `<Pause>` should be placed outside `<Say>` tags, not nested inside them.

> TwiML is a trademark of Twilio. Twilio is a registered trademark of Twilio Inc. All rights reserved. All rights Respected.