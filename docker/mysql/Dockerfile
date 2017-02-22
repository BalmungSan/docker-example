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
FROM mysql

#Updating the image
RUN apt-get -y update && apt-get -y upgrade

#Adding bookstore's mysql files
ADD bookstore.sql /home/bookstore/bookstore.sql
ADD data.sql /home/bookstore/data.sql
ADD initdb.sh /home/bookstore/initdb.sh
RUN chmod 644 /home/bookstore/bookstore.sql
RUN chmod 644 /home/bookstore/data.sql
RUN chmod 755 /home/bookstore/initdb.sh