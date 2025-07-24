API Functions

GetInfo
Parameters: id (integer)
Returns: The dress with the specified id (unique).
Example input:
abcd2/api/getinfo.php?id=1
Example output:
{"response_code":200,"message":"Dress found","data":{"id":1,"name":"Namasthe","description":"Namasthe is a customary, non-contact form of Hindu greeting. Namaste is usually spoken with a slight bow and hands pressed together, palms touching and fingers pointing upwards. Namaste is used as a form of greeting, acknowledging, and welcoming a relative, guest, or stranger. In some contexts, it can be used to express gratitude for assistance offered or given and to thank people for their generosity.\u00c2\u00a0","did_you_know":"The gesture of joining both hands has more than a symbolic meaning. It is said to provide a connection between the right and left hemispheres of the brain thus representing unification.","category":"people","type":"WOMAN","state_name":"all","key_words":"greeting, custom, symbolic, namasthe","image_url":"Slide1.PNG","status":"completed","notes":"Nikhitha"}}

Query
Parameters: (any number of key-value pairs. if multiple values, separate by a comma)
Returns: The list of dress ids which satisfy all of the specified criteria. If a parameter name does not match the database column, a response code 400 is returned.
Notes: The search matching uses SQL LIKE %value%, so a search of "men" will match "women".
Example input:
abcd2/api/query.php?category=festival,regional&type=men
Example output:
{"response_code":200,"message":"3 matching results","data":[13,19,45]}