<h1>Profanity Checker v1.0</h1>
<p>Live example: <a href="http://www.jamesafarris.info/projects/php/profanitychecker/profanitychecker.php" target="_blank">Profanity Checker Sample Link</a></p>
<p>User-Friendly form based example: <a href="http://www.jamesafarris.info/projects/php/profanitychecker/checkprofanity.php">Profanity checker user friendly link</a></p>
=================

Check profanity in a given string.  Will return a json object, a plain text object, or a boolean if a string contains profanity within the profanity list in the ProfanityChecker class.

<h2>Use</h2>
____________

<h3>JSON object:</h3>
<code>yourwebsite.com/profanitychecker.php?<strong>json</strong>=Some text badword</code>

json results: <br>
<code>{"output":"some text _____"}</code>

If profanity is found it will replace the word with "_____" as a default.  This can be changed adding an additional variable to the link.
<code>yourwebsite.com/profanitychecker.php?<strong>json</strong>=Some text badword&options=******</code>
This will replace the default characters with "******".

json results: <br>
<code>{"output":"some text ***"}</code>

____________


<h3>Plain Text object:</h3>
<code>yourwebsite.com/profanitychecker.php?<strong>plain</strong>=Some text badword</code>

plain text result:<br>
<pre>some text ______</pre>

With optional character replacement.<br>
<code>yourwebsite.com/profanitychecker.php?<strong>plain</strong>=Some text badword&options=***</code>

plain text with options result: <br>
<pre>some text ***</pre>


____________


<h3>Has Profanity (True, False)</h3>
<code>yourwebsite.com/profanitychecker.php?<strong>check</strong>=Some text badword</code>

check json results: <br>
<code>{"hasProfanity":true}</code>

____________

<h2>TO DO</h2>
<ul>
	<li>Fix method to add punctuation once stripped in a string</li>
	<li>Update profanity list</li>
	<li>Possibly create database file of profanity list</li>
	<li>Remove profanity list from ProfanityChecker class</li>
</ul>