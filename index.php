<?php
/**
* @author Anthony Gaudio
* @category ANM293 - Advanced PHP
* Project 03
* Set Up Swiftmailer Library
*/
/*
 * Test which type of path separator is being used on the server
 * then define which directon the slash should go, and assign it to
 * global variable called SLASH
 */
 if( PATH_SEPARATOR  == ';' )
    define('SLASH','\\');  
  else
    define('SLASH','/'); 

 /*
  * Define global varialbe called APP_PATH based on the results of the realpath
  * function.  This will return the path of the current file, in this case the
  * index.php file you are viewing.
  */
  define('APP_PATH', realpath(dirname(__FILE__)));
  /*
   * Concatenate a new global variable called SWIFT_PATH with the APP_PATH, the
   * appropriate slash, quoted text (folder name), another slash, and subfolder
   * name.
   */
  define('SWIFT_PATH',APP_PATH . SLASH . 'swiftmailer' . SLASH . 'lib');
 /*
  * Globally set included file path and name by concatenating a path and file
  * structure from previously set global variables.
  */
  set_include_path(realpath(SWIFT_PATH . SLASH)); 
@(include_once('swift_required.php'));
  
  
  
  
  //Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
  ->setUsername('tonyforschool')
  ->setPassword('advancedphp')  ;

  //Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);
  
$message = Swift_Message::newInstance();

$headers = $message->getHeaders();

$headers->addTextHeader('ANM293', 'CNM-270');

$message->setSubject('Tony Gaudio, SWIFT Mailer 4.0.6');

//Set a From: address including a name
$message->setFrom(array('tonyforschool@gmail.com' => 'Tony Gaudio'));

$message->setTo(array(
  'wireman131@chartermi.net' => 'Anthony Gaudio'));

$message->setReturnPath('tonyforschool@gmail.com');

$message->setBody('I rock at PHP', 'text/html');

$result = $mailer->send($message);

printf("Sent %d messages\n", $result);

/* Note that often that only the boolean equivalent of the
   return value is of concern (zero indicates FALSE)
   
if ($mailer->send($message))
{
  echo "Sent\n";
}
else
{
  echo "Failed\n";
}

*/

     

?>