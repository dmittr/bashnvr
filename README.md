# bashnvr

Simple NVR Solution

Tested on Centos-7. Copy files to your /opt folder, rename sample conf file and update it to your needs. Roll your own presets.conf. Copy service file to your systemd and start it.

##Under the hood

Long story short - ffmpeg start to record 60s files from rtsp (or mjpeg, or whatever else) stream. Each file will be converted to 60 images and they all will be compared. If there will be enough differece - original file will be saved. And you have to add www folder to your web-server configuration by yourself.


##Install

```
yum install git ffmpeg ImageMagick
cd /opt/
git clone https://github.com/dmittr/bashnvr.git bashnvr
cp /opt/bashnvr/bashnvr.service /etc/systemd/system/bashnvr.service
systemctl daemon-reload
systemctl enable bashnvr.service
cp /opt/bashnvr/bashnvr.conf{.sample,}
htpasswd -c /opt/bashnvr/.htpasswd my-user-name
```

After start check logs 

```
tail -f /dev/shm/bashnvr/bashnvr/main.log
```

Todo:

* kind of statistics for external monitoring systems
* pretty web-interface
* Apache config file, maybe
* ...
* profit


Done:

* Motion detection
* GIFs for preview
* Process nice and renice on the fly
* Mail to admin on multiple failures
* Video archive file rotation - e.g. your will never got 'No space left on device'