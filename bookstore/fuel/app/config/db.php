<?php
/**
 * Copyright 2017 Luis Miguel Mejía Suárez (BalmungSan)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

return array (
    'active' => 'dev',

	'dev' => array(
	    'type'           => 'mysqli',
	    'connection'     => array(
	        'hostname'       => getenv('MYSQL_HOST'),
	        'port'           => getenv('MYSQL_PORT'),
	        'database'       => 'bookstore',
	        'username'       => 'bookstore',
	        'password'       => 'bookstore',
	        'persistent'     => true,
	        'compress'       => true,
	    ),
	    'identifier'     => '`',
	    'table_prefix'   => '',
	    //'charset'        => 'utf8',
	    'enable_cache'   => true,
	    'profiling'      => false,
	    'readonly'       => false,
	),
);
?>