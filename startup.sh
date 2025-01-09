#!/bin/bash

# Copy custom nginx.conf to Nginx directory
cp /home/site/wwwroot/nginx.conf /etc/nginx/sites-available/default

# Start Nginx with custom config
service nginx reload
