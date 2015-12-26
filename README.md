This uses FlipClock

I use this to power my site for live events:  http://live.dr-chuck.com/
  
It sets a countdown timer and then refreshes the page dynamically and when the time arrives sends those
watching to a designated page.  It does some tricks to skew the users refresh times so servers won't crash too badly even if there are a few thousand people watching the countdown timer.  If you think about it a bit, you don't want perfectly synchronized refresh cycles or this will look like a Denial of Service :)
  
You need to edit the file `setup.php`
  
I have not made the program completely reconfigurable - feel free to send me a PR if you improve it or make it more generic.
  
(I apologize for the quality of the code as I wrote this in a great hurry)

This is licensed under MIT or CC0 - you don't even need to keep my name in this code if you adapt it.
  
