<?php 
/*
  For this example connect a LED and 330 Ohm resitor to pin 27 on your Pi
*/

// include the class file
include('Raspberry_GPIO.php');

// New object
$GPIO = new Raspberry_GPIO;

// set to use Pi pin numbers
$GPIO->change_pin_mode(1);

// tell pin 27 to be an out pin
$GPIO->pin_mode(27, 'out');

// set pin 21 to be 1 (high)
$GPIO->set_pin(27, 1);

// sleep for 1 second
sleep(1);

// And turn pin 27 off again
$GPIO->set_pin(27, 0);
