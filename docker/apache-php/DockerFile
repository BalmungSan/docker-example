# Copyright 2017 Luis Miguel Mejía Suárez (BalmungSan)
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#  http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

#Base image
FROM php:5.6-apache

#Updating the image and installing some utilities
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y wget unzip vim tree git

#Installing mysqli for php
RUN docker-php-ext-install mysqli

#Editing apache2 config
ADD apache2.conf /etc/apache2/apache2.conf
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN chmod 644 /etc/apache2/apache2.conf
RUN chmod 644 /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

#Adding fuelphp framework
RUN wget http://fuelphp.com/files/download/36
RUN unzip 36 -d /var/www/
RUN mv /var/www/fuelphp-1.8 /var/www/bookstore
RUN rm -rf 36

#Adding bookstore application
RUN git clone https://github.com/BalmungSan/bookstore.git
RUN cp -rf bookstore/bookstore/* /var/www/bookstore
RUN rm -rf bookstore

#Giving ownership of application files to the apache user
RUN chown -R www-data:www-data /var/www/bookstore

#Volme for saving book previews
VOLUME "/var/www/bookstore/public/books/"