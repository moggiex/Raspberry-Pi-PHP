# pi-PHP
A PHP library that can be used with the Raspberry pi to remote control the GPIO pins using PHP (built to remote control a home using a web browser & a pi).

I'm guessing just like you, you prefer PHP as your programming language and while Python is great, it's not what we're used to coding. So I built this library to help others with their web based applications who want to take the web into the "real-world" using a Pi.

# Dependances

This library is used to provide the gpio commands is below:
http://git.drogon.net/wiringPi

# Commands

```php
// set up an object
$GPIO = new Raspberry_GPIO;
// sets up the pins so they can be used as out's
$pins = $GPIO->setup_pins();
// turn a pin on 
$GPIO->set_pin(22, 1);
// And off again
$GPIO->set_pin(22, 0);
// read a pin
echo $GPIO->read_pin(22);

```
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
git clone https://github.com/moggiex/pi-PHP
```
# Set up (advanced, includes sqlite3, vsftpd)

FTP Server
See here http://www.techrapid.co.uk/raspberry-pi/setup-ftp-server-raspberry-pi-vsftpd/ for setup details
```
sudo apt-get install vsftpd
sudo nano /etc/vsftpd.conf
sudo service vsftpd restart
```
Sqlite3 
See here http://raspberrywebserver.com/sql-databases/set-up-an-sqlite-database-on-a-raspberry-pi.html
```
sudo apt-get install sqlite3
```
