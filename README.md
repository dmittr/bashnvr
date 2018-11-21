# bashnvr

Simple NVR Solution

Tested on Centos-7. Copy files to your /opt folder, rename sample conf file and update it to your needs. Roll your own presets.conf. Copy service file to your systemd and start it.

##Under the hood

Long story short - ffmpeg start to record 60s files from rtsp (or mjpeg, or whatever else) stream. Each file will be converted to 60 images and they all will be compared. If there will be enough differece - original file will be saved. 


Todo:

* kind of statistics for external monitoring systems
* pretty web-interface
* ...
* profit


Done:

* Motion detection
* GIFs for preview
* Process nice and renice on the fly
* Mail to admin on multiple failures
* Video archive file rotation - e.g. your will never got 'No space left on device'