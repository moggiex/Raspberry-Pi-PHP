<?php 
class Raspberry_GPIO {

	// Variables
	public $mode  	= true; // switches between -g for BCM pins or normal pins
	public $data 	= 17;	// for shift registers
	public $clock 	= 22;	// for shift registers
	public $latch 	= 27;	// for shift registers
	public $clear	= 12;	// for shift registers
	public $sleep	= 0.5;

	private $pin_modes = array(
      "in",
      "out",
      "pwm",
      "up",
      "down",
      "tri",
      );

   private $interupt_triggering = array(
      "rising",
      "falling",
      "both",
      "none",
      );

   private $pif_modes = array(
      "up",
      "tri",
      );

   // B+ Pins http://www.raspberrypi-spy.co.uk/wp-content/uploads/2012/06/Raspberry-Pi-GPIO-Layout-Model-B-Plus-rotated-2700x900.png
   // This really needs further work as the pins are confusing between models (and I'm new to Pi's)
   public $pins = array(
      1 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "POWER",
         "name" => "3V3"
         ),
      2 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "POWER",
         "name" => "5V"
         ),
      3 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SDA1 I2C",
         "name" => "GPIO2"
         ),
      4 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "POWER",
         "name" => "5V"
         ),
      5 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SDCL1 I2C",
         "name" => "GPIO2",
         "gpio_id" => 2
         ),
      6 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      7 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO4",
         "gpio_id" => 4
         ),
      8 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "UART0_TXD",
         "name" => "GPIO14"
         ),
      9 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      10 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "UART0_RXD",
         "name" => "GPIO15",
         "gpio_id" => 15
         ),
      11 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO17",
         "gpio_id" => 17
         ),
      12 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "PCM_CLK",
         "name" => "GPIO18",
         "gpio_id" => 28
         ),
      13 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO27",
         "gpio_id" => 27
         ),
      14 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      15 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO22",
         "gpio_id" => 22
         ),
      16 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO23",
         "gpio_id" => 23
         ),
      17 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "POWER",
         "name" => "3V3"
         ),
      18 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO24",
         "gpio_id" => 24
         ),
      19 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SPIO_MOSI",
         "name" => "GPIO10",
         "gpio_id" => 10
         ),
      20 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      21 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SPIO_MOSI",
         "name" => "GPIO9",
         "gpio_id" => 9
         ),
      22 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO2",
         "name" => "GPIO25",
         "gpio_id" => 25
         ),
      23 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SPI0_SCLK",
         "name" => "GPIO11",
         "gpio_id" => 11
         ),
      24 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SPI0_CE0_N",
         "name" => "GPIO8",
         "gpio_id" => 8
         ),
      25 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      26 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "SPI0_CE1_N",
         "name" => "GPIO7",
         "gpio_id" => 7
         ),
      27 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "ID_SD",
         "name" => "12C ID EEPROM"
         ),
      28 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "ID_SC",
         "name" => "12C ID EEPROM"
         ),
      29 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO5",
         "gpio_id" => 5
         ),
      30 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      31 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO6",
         "gpio_id" => 6
         ),
      32 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO12",
         "gpio_id" => 12
         ),
      33 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO13",
         "gpio_id" => 13
         ),
      34 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      35 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO19",
         "gpio_id" => 19
         ),
      36 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO16",
         "gpio_id" => 16
         ),
      37 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO26",
         "gpio_id" => 26
         ),
      38 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO20",
         "gpio_id" => 20
         ),
      39 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GROUND",
         "name" => "GROUND"
         ),
      40 => array(
         "enabled" => 0,
         "status" => null,
         "role" => "GPIO",
         "name" => "GPIO21",
         "gpio_id" => 21
         ),
      );

   function __construct() {
       //print "In BaseClass constructor\n";
   }

   // update option to set the new status of a switch via ajax (return value and also updates the gpio pin)
   public function setup_pins() {
      //global $pins;
      //print_r($this->pins);
      $count = 0;
      foreach ($this->pins as $key => $pin) {
         if( $pin['role'] == "GPIO" && isset( $pin['gpio_id'] ) ) {
            // set the pins as out
            $string = "/usr/local/bin/gpio" . $this->return_mode() . "mode  " . $pin['gpio_id'] . " out";
            $gpio_on = shell_exec($string);
            $this->pins[$key]["enabled"] = 1;
            //echo $this->pins[$key]["enabled"] . PHP_EOL;

            // read their status
            $this->pins[$key]["status"] = $this->read_pin($pin['gpio_id']);
            //echo $this->pins[$key]["status"] . PHP_EOL;

            $count++;
         }
      }
      //echo $count . " usable pins" . PHP_EOL;

      return $this->pins;
   }

   private function return_mode() {
   	if($this->mode) {
   		return " -g ";
   	} else {
   		return " ";
   	}
   }

   public function change_pin_mode($mode) {
   	if($mode == true) {
   		$this->mode = true;	// with -g
   	} else {
   		$this->mode = false; // without
   	}
   }

	public function sr_push_array($arr) {
		//array_unshift($arr,0);
		//$arr[] = 0;
		array_reverse($arr, true);	// reverse the array as we expect the leading bits to come first, not last!
		//$this->sr_clear();
		foreach ($arr as $key => $value) {
			$this->set_pin($this->data, 0);
			$this->set_pin($this->data, $value);
			//echo $value . "-" .$this->read_pin($this->data). PHP_EOL;
			if($this->read_pin($this->data) != $value) {
				echo "ALERT!!!";
			}
			//print_r($this->readall());
			$this->sr_clock();
			//echo $key . PHP_EOL;
			//echo "[" . $key. "] " .  $this->data . " " . $this->clock . " $value" . PHP_EOL;
		}
		
		// Now latch them into the shift register
		$this->sr_latch();
	}

	public function sr_latch() {
		$this->set_pin($this->latch, 1);
		sleep($this->sleep);
		$this->set_pin($this->latch, 0);
	}

	public function sr_clock() {
		$this->set_pin($this->clock, 1);
		sleep($this->sleep);
		$this->set_pin($this->clock, 0);
	}

	public function sr_clear() {
		$this->set_pin($this->clear, 0);
		$this->sr_latch();
		$this->set_pin($this->clear, 1);
	}


   // https://projects.drogon.net/raspberry-pi/wiringpi/the-gpio-utility/
   public function version() {
      $string = "/usr/local/bin/gpio -v";
      $gpio = shell_exec($string);
      return trim($gpio);
   }

   public function set_pin($pin, $state=0) {
      $string = "/usr/local/bin/gpio" . $this->return_mode() . "write " . $pin . " " . $state;
      $gpio = shell_exec($string);
      //echo $string . PHP_EOL;

      // update the current pins array
      $this->pins[$pin]["status"] = $state;

      return;
   }

   public function read_pin($pin) {
      $string = "/usr/local/bin/gpio" . $this->return_mode() . "read  " . $pin;
      $gpio 	= shell_exec($string);
      return trim($gpio);
   }

   public function pin_mode($pin, $mode) {

      if(in_array($mode, $this->pin_modes)) {
         $string  = "/usr/local/bin/gpio" . $this->return_mode() . "mode $pin $mode";
         $gpio    = shell_exec($string);
         //echo $string . PHP_EOL;
      } else {
         return "Invalid mode provided. Valid values are " . implode(" ",$this->pin_modes);
      }
   }

   public function pwm($pin, $updown) {
      $string  = "/usr/local/bin/gpio" . $this->return_mode() . "pwm $pin $mode";
      $gpio    = shell_exec($string);
      return;
   }

   public function readall() {
      $string  = "/usr/local/bin/gpio readall";
      $gpio    = shell_exec($string);
      return trim($gpio);
   }

   public function load_spi($buffer) {
      $string  = "/usr/local/bin/gpio load spi $buffer";
      $gpio    = shell_exec($string);
      return;
   }

   public function load_baud($baud_rate) {
      $string  = "/usr/local/bin/gpio load i2c $baud_rate";
      $gpio    = shell_exec($string);
      return;
   }

   public function export($pin, $inout) {
      $string  = "/usr/local/bin/gpio -g export $pin $inout";
      $gpio    = shell_exec($string);
      return;
   }

   public function unexport($pin) {
      $string  = "/usr/local/bin/gpio" . $this->return_mode() . "unexport $pin";
      $gpio    = shell_exec($string);
      return;
   }

   public function unexportall() {
      $string  = "/usr/local/bin/gpio unexportall";
      $gpio    = shell_exec($string);
      return;
   }

   public function exports() {
      $string  = "/usr/local/bin/gpio exports";
      $gpio    = shell_exec($string);
      return trim($gpio);
   }

   public function edge($pin, $interupt_triggering) {
      if(in_array($mode, $this->interupt_triggering)) {
         $string  = "/usr/local/bin/gpio" . $this->return_mode() . "edge $pin $interupt_triggering";
         $gpio    = shell_exec($string);
      return;
      } else {
         return "Invalid interrupt triggering provided. Valid values are " . implode(" ",$this->interupt_triggering);
      }
   }

   // PiFacecommands added for completeness 
   public function pif_write($pin, $state) {
      $string  = "/usr/local/bin/gpio -p write $pin $state";
      $gpio    = shell_exec($string);
      return;
   }

   public function pif_read($pin) {
      $string  = "/usr/local/bin/gpio -p read  $pin";
      $gpio    = shell_exec($string);
      return trim($gpio);
   }

   public function pif_mode($pin, $pif_modes) {
      if(in_array($mode, $this->pif_modes)) {
         $string  = "/usr/local/bin/gpio -p mode $pin $pif_modes";
         $gpio    = shell_exec($string);
      return;
      } else {
         return "Invalid PiFace value provided. Valid values are " . implode(" ",$this->pif_modes);
      }
   }

} // /class
