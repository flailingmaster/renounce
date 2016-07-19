sed -i 's/fastcgi_read_timeout 300;/fastcgi_read_timeout 300;\
        fastcgi_param HTTP_PROXY "";/' /etc/nginx/sites-enabled/homestead.app
/etc/init.d/nginx restart
