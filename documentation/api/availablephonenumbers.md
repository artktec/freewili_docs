%api.AvailablePhoneNumbers

%description
The subresources of the AvailablePhoneNumbers resource let you search for incoming local and toll-free phone numbers that are available for you to purchase. You can search for phone numbers that match a pattern, are in a certain country, are in certain area code (NPA) or exchange (NXX) or are in a specific geography. This is dependent on the company you are using to provide your DID services. If your company has an API and you would like for us to add it please email api.request@freewili.com with the name of the company and url to a description of the API.

Toll Number Response Data
-------------------------

The following is returned when you are looking for a toll number

NodeName       Description
-----------    ---------------
FriendlyName   A nicely-formatted version of the phone number.
PhoneNumber	   The phone number, in E.164 (i.e. "+1") format.
Lata	       The LATA of this phone number.
RateCenter	   The rate center of this phone number.
Latitude	   The latitude coordinate of this phone number.
Longitude      The longitude coordinate of this phone number.
Region	       The two-letter state or province abbreviation of this phone number.
PostalCode	   The postal (zip) code of this phone number.
IsoCountry	   The ISO country code

Toll-Free Number Response Data
------------------------------

The following is returned when you are looking for a toll-free number. Note that there is less data, because there is no postal information.

NodeName       Description
-----------    ---------------
FriendlyName   A nicely-formatted version of the phone number.
PhoneNumber	   The phone number, in E.164 (i.e. "+1") format.
IsoCountry	   The ISO country code


%GET.AccountSid

### Query Filters ###
You can filter the results of toll number listing by using the following
parameters as a query

Parameter	     Description
------------     ---------------
AreaCode         Find phone numbers in the specified Area Code. Only available for North American numbers.
Contains         A pattern to match phone numbers on. Valid characters are '*' and 
                 [0-9a-zA-Z]. The '*' character will match any single digit.
InRegion         Limit results to a particular region (i.e. State/Province). Given a phone number, 
                 search within the same Region as that number.
InPostalCode     Limit results to a particular postal code. Given a phone number, 
                 search within the same postal code as that number.
                 
Because toll-free numbers don't have postal information you can only use the following parameter to filter your query

 Parameter	     Description
------------     ---------------
Contains         A pattern to match phone numbers on. Valid characters are '*' and 
                 [0-9a-zA-Z]. The '*' character will match any single digit.

### Toll Examples ###
~~~
GET /2010-04-01/Accounts/fwde6f1.../AvailablePhoneNumbers/US/Local?InRegion=CA&NearLatLong=37.840699,-122.461853&Distance=50&Contains=555
~~

The returned data

~~~{ .xml }
<FreewiliResponse> 
    <AvailablePhoneNumbers uri="/2010-04-01/Accounts/fwde6f1e11047ebd6fe7a55f120be3a900/AvailablePhoneNumbers/US/Loca?InRegion=CA&NearLatLong=37.840699,-122.461853&Distance=50&Contains=555">
        <AvailablePhoneNumber>
            <FriendlyName>(415) 555-1212</FriendlyName>
            <PhoneNumber>+14155551212</PhoneNumber>
            <Lata>722</Lata>
            <RateCenter>SNFC CNTRL</RateCenter>
            <Latitude>37.7726</Latitude>
            <Longitude>-122.4196</Longitude>
            <Region>CA</Region>
            <PostalCode>94133</PostalCode>
            <IsoCountry>US</IsoCountry>
        </AvailablePhoneNumber>
    </AvailablePhoneNumbers>
</FreewiliResponse>
~~~

#### Advanced Filtering Features ####
You can combine multiple 'In-', 'Near-', or 'Contains' parameters to perform complex searches. For example, using the following query string would search for available numbers in California containing the digits 345 within 50 miles of a point near Carson City, Nevada:
InRegion=CA&NearLatLong=39.162544,-119.766083&Distance=50&Contains=345

You can also use actual phone numbers as templates if you don't know a specific LATA, rate center, or other 'In-' parameter value. For example, if you use 'InLata=+15016055555' we will lookup the Lata for 1 (501) 605-5555 and search for phone numbers using that value. This feature works for 'InRegion', 'InPostalCode', 'InLata' and 'InRateCenter'.


### Toll-Free Examples ###
~~~
GET /2010-04-01/Accounts/ACde6f1.../AvailablePhoneNumbers/US/TollFree
~~~

The returned data

~~~{ .xml }
<FreewiliResponse>
    <AvailablePhoneNumbers uri="/2010-04-01/Accounts/ACde6f1e11047ebd6fe7a55f120be3a900/AvailablePhoneNumbers/US/TollFree">
        <AvailablePhoneNumber>
            <FriendlyName>(866) 583-8815</FriendlyName>
            <PhoneNumber>+18665838815</PhoneNumber>
            <IsoCountry>US</IsoCountry>
        </AvailablePhoneNumber>
        <AvailablePhoneNumber>
            <FriendlyName>(866) 583-0795</FriendlyName>
            <PhoneNumber>+18665830795</PhoneNumber>
            <IsoCountry>US</IsoCountry>
        </AvailablePhoneNumber>
        ...
    </AvailablePhoneNumbers>
</FreewiliResponse>
~~~

%POST.AccountSid
Not Supported

%PUT.AccountSid
Not Supported

%DELETE.AccountSid
Not Supported