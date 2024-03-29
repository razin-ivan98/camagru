clear

git clone https://github.com/razin-ivan98/camagru.git

docker-machine stop
docker-machine rm default

rm -rf ~/goinfre/.docker
rm -rf ~/.docker

mkdir ~/goinfre/.docker
ln -s ~/goinfre/.docker ~/.docker

docker-machine create -d virtualbox default

eval $(docker-machine env)

docker run --name camagru_php -d -v $(pwd)/camagru:/app -p 8080:80 webdevops/php-apache-dev
docker run --name camagru_mysql -d -v camagru_db:/var/lib/mysql --restart on-failure:5 -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=base mysql:5 --default-authentication-plugin=mysql_native_password
docker run --name camagru_phpmyadmin -d --link camagru_mysql:db -p 8081:80 phpmyadmin/phpmyadmin

print "docker-machine:"
docker-machine ls | grep -E "tcp" | awk -F' ' '{print $5}' | awk -Ftcp:// '{print $2}' | awk -F: '{print $1}'
print "mysql:"
docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' camagru_mysql
