<?php class WordDetect {

	// profanity list, updated 12/25/2014
	private $words = array('anal',
						   'anus',
						   'arse',
						   'ass',
						   'ballsack',
						   'balls',
						   'bastard',
						   'bitch',
						   'biatch',
						   'blowjob',
						   'blow job',
						   'bollock',
						   'bollok',
						   'boner',
						   'boob',
						   'buttplug',
						   'clitoris',
						   'cock',
						   'coon',
						   'crap',
						   'cunt',
						   'damn',
						   'dick',
						   'dildo',
						   'dyke',
						   'fag',
						   'feck',
						   'fellate',
						   'fellatio',
						   'felching',
						   'fuck',
						   'fucker',
						   'fucking',
						   'fucked',
						   'fucktard',
						   'fudgepacker',
						   'fudge packer',
						   'flange',
						   'Goddamn',
						   'God damn',
						   'hell',
						   'homo',
						   'jerk',
						   'jizz',
						   'knobend',
						   'knob end',
						   'labia',
						   'lmao',
						   'lmfao',
						   'muff',
						   'nigger',
						   'nigga',
						   'penis',
						   'piss',
						   'prick',
						   'pube',
						   'pussy',
						   'queer',
						   'scrotum',
						   'shit',
						   'sh1t',
						   'slut',
						   'smegma',
						   'spunk',
						  'tit',
						  'tosser',
						  'titties',
						  'titty',
						  'turd',
						  'twat',
						  'vagina',
						  'wank',
						  'whore',
						  'wtf'
						  );

	public function __construct() {
		//check what encoding is being sent (json, plain)
		if (isset($_GET['json'])) {
			$this->jsonWord();
		}
		else if (isset($_GET['plain'])) {
			$this->plainText();
		}
		else if (isset($_GET['check'])) {
			$this->hasProfanity();
		}
		else {
			echo "error";
		}
	}

	// json encoded function, will return a json object
	public function jsonWord() {
		if ($_GET['json'] == '') { // if the get['json'] request is blank then send back an error
			$throwError['error'] = "Nothing to evaluate";
			echo json_encode($throwError);
		}
		else
		{
			if (!isset($_GET['options'])) { // if the get['options'] request is not set then make the options underscores
				$_GET['options'] = '_____';
			}
			$data['output'] = $this->options($_GET['json'], $_GET['options']); // call the options function and return the data
			echo json_encode($data);
		}
	}

	// plain text encoded function, will return a plain text object
	public function plainText()
	{
		if ($_GET['plain'] == '') { // if the get['plain'] request is blank then send back an error
			$throwError = "<pre>Nothing to evaluate</pre>";

			echo $throwError;
		}
		else
		{
			if (!isset($_GET['options'])) { // if the get['options'] request is not set then make the options underscores
				$_GET['options'] = '_____';
			}
			echo '<pre>' . $this->options($_GET['plain'], $_GET['options']) . '</pre>'; // call the options function and return the data
		}
	}

	public function hasProfanity()
	{
		$text = $_GET['check'];
		$split = explode(' ', $text); //Take the string of text and create an array
		$checkedWords = array();
		foreach ($split as $word) // Loop through each word in the $split array
		{
			$fix_word = strtolower($word); // lowercase each word to check if it matches the profanity list
			if (in_array($fix_word, $this->words)) {
				$checker['output'] = true;
				array_push($checkedWords, 'true');
				echo json_encode($checker);
				break;
			}
			else
			{
				array_push($checkedWords, $fix_word);
			}
		}
		if (!in_array('true', $checkedWords)) {
			$checker['output'] = false;
			echo json_encode($checker);
		}
	}

	// options function which changes profanity into underscores by default, with options for user to pass in their own sensorship
	private function options($encoding, $options)
	{
		if (!isset($options)) { // if the get['options'] request is not set, automatically make it underscores
			$options = '_____';
			$result = $this->checkwords($encoding, $options); // send the text to the check words function with what options they want to sensor 
			return $result;  // return results
		}
		else
		{
			$result = $this->checkwords($encoding, $options); // if user set the get['options'] variable, send text with custom options to the checkwords function
			return $result;	// return results
		}
	}

	// CHECKWORDS IS WHERE MOST OF THE PROCESSING HAPPENS, SET TO PRIVATE AS IT'S ONLY USED WITHIN THE CLASS
	private function checkwords($text, $options = '_____')
	{
		$split = explode(' ', $text); //Take the string of text and create an array
		$corrected = array(); // Empty array used to collect finalized words in order
		foreach ($split as $word) // Loop through each word in the $split array
		{
			$fix_word = strtolower($word); // lowercase each word to check if it matches the profanity list
			if (in_array($fix_word, $this->words)) // check each word against the profanity list
			{
				$fixed_word = preg_replace('([\w]+)', $options, $fix_word); // if word matches profanity list replacec it with what is in $options
				array_push($corrected, $fixed_word); // add replaced word to the $corrected array	
			}
			else
			{
				array_push($corrected, $fix_word); // if word isn't part of the profanity list, just add it to the $corrected array
			}
		}
		$fixed_sentence = implode(' ', $corrected); // take the sentences from $corrected array and create a single string
		return $fixed_sentence; // return results
	}
}
$wordDetect = new WordDetect(); // instantiate the class so it can be used
?>