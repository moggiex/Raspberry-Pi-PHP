# Rasberry-Pi-PHP
A PHP library that can be used with the Raspberry Pi to remote control the GPIO pins using PHP (built to remote control a home using a web browser & a pi).

I'm guessing just like me, you prefer PHP as your programming language and while Python is great, it's not what we're used to coding (especially when you throw in SQLite as a database & jQuery + bootstrap for the UI). So I built this library to help others with their web based applications who want to take the web into the "real-world" using a Pi.

The main class was built up over a couple of days to do what I needed it to do & this project should be classed as a "work in progress". Feel free to make suggestions or add as desired.

# Basic Usage

```php
// set up an object
$GPIO = new Raspberry_GPIO;
// Use the Pi pin numbers
$GPIO->change_pin_mode(1);
// set pin 22 as an out
$GPIO->pin_mode(22, "out");
// turn a pin on 
$GPIO->set_pin(22, 1);
// sleep for a second
sleep(1);
// And off again
$GPIO->set_pin(22, 0);
// read a pins state
echo $GPIO->read_pin(22);
```

# Advanced Usage
I added in Shift Register support using arrays. 

The idea behind this was to be able to control more than the limited number of outputs from a Raspberry Pi and not flicker lights/relays when loading in new data. The array can be as big as you need it to be, handy if you're stringing more than one shift register (eg 74H595's) together to go beyond just 7 outputs.

```php
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
$arr = array(1,1,1,0,0,0,0);
// Push the array to the register(s)
$GPIO->sr_push_array($arr);
```

See the example php files for more examples

# Dependances

- This library is used to provide the gpio commands http://git.drogon.net/wiringPi
- And of course you need at least PHP & probably Apache (or other webserver) too

# Set up (basic)
To be able to use this library you'll need the following installed on your pi:
```
sudo apt-get upgrade
sudo apt-get update
sudo apt-get install apache2 php5 php5-dev
sudo apt-get install git-core
git clone git://git.drogon.net/wiringPi
cd wiringPi
./build
cd /var/www/
git clone https://github.com/moggiex/Raspberry-Pi-PHP
```
# Optional Set up

Add a FTP Server
See here http://www.techrapid.co.uk/raspberry-pi/setup-ftp-server-raspberry-pi-vsftpd/ for setup details
```
sudo apt-get install vsftpd
sudo nano /etc/vsftpd.conf
sudo service vsftpd restart
```
And a lightweight database using Sqlite3 to store the states via a database (Sqlite3 has basically the same commands as MySQL)
See here http://raspberrywebserver.com/sql-databases/set-up-an-sqlite-database-on-a-raspberry-pi.html
```
sudo apt-get install sqlite3
```
