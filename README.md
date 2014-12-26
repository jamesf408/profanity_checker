<h1>Profanity Checker v1.0</h1>
=================

Check profanity in a given string.  Will return a json object, a plain text object, or a boolean if a string contains profanity within the profanity list in the ProfanityChecker class.

<h2>Use</h2>
____________

<strong>JSON object:</strong>
<code>yourwebsite.com/profanitychecker.php?<strong>json</strong>=Some text badword</code>

json results: 
<code>{"output":"some text _____"}</code>

If profanity is found it will replace the word with "_____" as a default.  This can be changed adding an additional variable to the link.
<code>yourwebsite.com/profanitychecker.php?<strong>json</strong>=Some text badword&options=******</code>
This will replace the default characters with "******".

json results: 
<code>{"output":"some text ******"}</code>

____________


<strong>Plain Text object:</strong>
<code>yourwebsite.com/profanitychecker.php?<strong>plain</strong>=Some text badword</code>

plain text result:
<pre>some text ______</pre>

With optional character replacement.
<code>yourwebsite.com/profanitychecker.php?<strong>plain</strong>=Some text badword&options=******</code>



