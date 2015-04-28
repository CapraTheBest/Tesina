#!/bin/bash

sudo guvcview -d /dev/video3 --config=webcam.gpfl --format=jpeg --cap_time=60 -d asus-pc.local
