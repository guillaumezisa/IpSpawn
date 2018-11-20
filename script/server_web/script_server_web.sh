apt install nginx -y
apt install php-fpm -y

sed -i -r 's/.*index index.html index.htm index.nginx-debian.html;*/index index.html index.htm index.php index.nginx-debian.html;/g' /etc/nginx/sites-available/default
sed -i -r 's/.*#location ~ \.php$ {*/location ~ \.php$ {/g' /etc/nginx/sites-available/default
sed -i -r 's/.*#include snippets/fastcgi-php.conf;*/include snippets/fastcgi-php.conf;/g' /etc/nginx/sites-available/default
sed -i -r 's/.*#fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;*/fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;}/g' /etc/nginx/sites-available/default
