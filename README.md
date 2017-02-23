# docker-example
LAMP Application Deployment Example

The application consists of an online platform that allows the sale of new or used books among users.

# Author:
 * Luis Miguel Mejía Suárez

Universidad EAFIT - 2017 (Tópicos Especiales en Telemática)

# Deployment
To deploy the app using docker simply go to the docker folder in this repo and type the following commands.

	$ docker build -t [mysql image name] ./mysql
	$ docker build -t [apache-php image name] ./apache-php/
	$ docker run -e MYSQL_ROOT_PASSWORD=[mysql root password] -v [local mysql folder]:/var/lib/mysql --name [mysql container name] -d [mysql image name]
	
	//wait a momment for the mysql container to start (about 30 seconds at least)
	
	$ docker exec -it [mysql container name] /home/bookstore/initdb.sh
	$ export MYSQL_IP=`docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' [mysql container name]`
	$ docker run -e MYSQL_HOST=$MYSQL_IP -e MYSQL_PORT=3306 -p [http port]:80 -v [local storage folder]:/var/www/bookstore/public/books --name [apache container name] -d [apache-php image name]

### where
* __mysql image name:__ Is the name assigned to the mysql image _e.g. user1-mysql_
* __apache-php image name:__ Is the name assigned to the apache-php image _e.g. user1-apache-php_
* __mysql root password:__ Is the password associated to the root user in the mysql container. _e.g. 1234_
* __local mysql foler:__ Is the local path to store the mysql data. _e.g. 1 (linux). /home/user1/docker/mysql e.g. 2 (windows) /c/Users/user1/docker/mysql_
* __mysql container name:__ Is the name associated with the running mysql container _e.g. bookstore-mysql_
* __mysql ip:__ Is the ip address assigned to the mysql container. must be a valid ip address of the subnet. _e.g. 203.0.113.100_
* __http port:__ Is the port to access to the apache server. _e.g. 8080_
* __local storage foler:__ Is the local path to store the books previews (PDFs). _e.g. 1 (linux). /home/user1/docker/books e.g. 2 (windows) /c/Users/user1/docker/books_
* __apache container name:__ Is the name associated with the running apache-php container _e.g. bookstore-apache-php_

### example
	docker build -t user1-mysql ./mysql
	docker build -t user1-apache ./apache-php/
	docker run -e MYSQL_ROOT_PASSWORD=1234 -v /home/lmejias3/data/mysql2:/var/lib/mysql --name mysql-test -d user1-mysql
	
	//wait a momment for the mysql container to start (about 30 seconds at least)
	
	docker exec -it mysql-test /home/bookstore/initdb.sh
	export MYSQL_IP=`docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mysql-test`
	docker run -e MYSQL_HOST=$MYSQL_IP -e MYSQL_PORT=3306 -p 8080:80 -v /home/lmejias3/data/books2:/var/www/bookstore/public/books --name apache-php-test -d user1-apache

Now you can access the application by a web browser using the ip of the machine where docker is running and the http assigned port

_e.g. (http://10.131.137.242:8080)_

# Notes
* This project uses the FuelPHP Framework (http://fuelphp.com/)
* This project runs on docker (https://www.docker.com/)
* This project is a modification of BookStore (https://github.com/BalmungSan/bookstore)
