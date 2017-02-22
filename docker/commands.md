#Build
##mysql
	docker build -t lmejias3/mysql ./mysql
##apache-php
	docker build -t lmejias3/apache-php ./apache-php/
##net
	docker network create --subnet=[net ip] --gateway=[gateway ip] [net name]
	
#Run
##mysql
	docker run --net [net name] --ip [mysql ip] -e MYSQL_ROOT_PASSWORD=[mysql root password] -p [mysql port]:3306 -v [local mysql folder]:/var/lib/mysql --name [mysql container name] -d lmejias3/mysql
##apache-php
	docker run --net [net name] --ip [apache ip] -e MYSQL_PORT=[mysql port] -e MYSQL_HOST=[mysql ip] -p [http port]:80 -p [https port]:443 -v [local storage folder]:/var/www/bookstore/public/books --name [apache container name] -d lmejias3/apache-php
##creating the database
    docker exec -e APACHE_HOSTS=[apache containers ips] [mysql container name] /home/bookstore/initdb.sh