<?php
/*
  This demostrates the shift reigster functions using an array
*/

// Include the class
include('Raspberry_GPIO.php');

// New object
$GPIO = new Raspberry_GPIO;

// Use the Pi pin numbers
$GPIO->change_pin_mode(1);

// Set the pin numbers for the 4 inputs
$data 	= 19;
$clock 	= 22;
$latch 	= 27;
$clear 	= 12;

// And set these in the class
$GPIO->data 	= $data;
$GPIO->clock 	= $clock;
$GPIO->latch 	= $latch;
$GPIO->clear	= $clear;

// Tell the Pi that these pins should be "out"'s
$GPIO->pin_mode($data, "out");
$GPIO->pin_mode($clock, "out");
$GPIO->pin_mode($latch, "out");
$GPIO->pin_mode($clear, "out");

// Force the clear pin high (assuming you're using a 74HC595 shift register)
$GPIO->set_pin($clear, 1);

// Clear the register
$GPIO->sr_clear();

// Make an array
$arr = array(1,1,1,0,0,0,0,0);

// Push the array to the register
$GPIO->sr_push_array($arr);

// And you get the idea from here :)
$arr = array(1,0,0,0,0,0,0,0);
$GPIO->sr_push_array($arr);
$arr = array(0,1,0,0,0,0,0,0);
$GPIO->sr_push_array($arr);
$arr = array(0,0,1,0,0,0,0,0);
$GPIO->sr_push_array($arr);

// And another example that loops
$arr = array(0,0,0,0,0,0,0,0);
 for ($i=0; $i < count($arr); $i++) { 
 	//$state = ($i % 2 == 0 ? 1 : 0);
 	$arr[$i] = 1;
 	$GPIO->sr_push_array($arr);
 }
}
// Clear the register
$GPIO->sr_clear();

