git clone https://github.com/razin-ivan98/camagru.git

docker-machine start
env $(docker-machine env)

docker rm camagru_php
docker rm camagru_phpmyadmin
docker rm camagru_mysql

docker run --name camagru_php -d -v ./:/app -p 8080:80 webdevops/php-apache-dev
docker run --name camagru_phpmyadmin -d --link camagru_mysql:db -p 8081:80 phpmyadmin/phpmyadmin
docker run --name camagru_mysql -d -v camagru_db:/var/lib/mysql --restart on-failure:5 -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=base mysql:5 --default-authentication-plugin=mysql_native_password

