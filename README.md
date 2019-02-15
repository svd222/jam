# INSTALLATION #

$ sudo mkdir -m 0755 /var/www/jam && cd jam

$ git clone https://github.com/svd222/jam.git .

$ composer install

$ php init

open api/config/main-local.php & change `cookieValidationKey` param of `request` component to random string

## NGINX Configuration ##


#### api.jam.local nginx config example (Assume that project is on this path: /var/www/jam) ####

````
server {
	listen 80;

	sendfile        on;
	keepalive_timeout  65;
    	gzip  on;
    	gzip_min_length 1024;
    	gzip_buffers 12 32k;
    	gzip_comp_level 9;
    	gzip_proxied any;
	gzip_types	text/plain application/xml text/css text/js text/xml application/x-javascript text/javascript application/javascript application/json application/xml+rss;
	
	server_name api.jam.local;
	root /var/www/jam/api/web;

	access_log /var/www/jam/api/access.log;
	error_log /var/www/jam/api/error.log;

	charset utf-8;
		
	location / {
            add_header 'Access-Control-Allow-Origin' '*';
	    root /var/www/jam/api/web/;
	    index index.php;
	    try_files $uri $uri/ /index.php?$args;
	}

    	location ~ \.php$ {
		add_header Access-Control-Allow-Origin *;
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		
		root /var/www/jam/api/web/;

		try_files $uri $uri/ =404;
		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
		fastcgi_index index.php;
		include fastcgi_params;
		fastcgi_param                   SCRIPT_FILENAME $document_root$fastcgi_script_name;


	    	fastcgi_param QUERY_STRING    $query_string;
	    	fastcgi_param REQUEST_METHOD  $request_method;
	    	fastcgi_param CONTENT_TYPE    $content_type;
	    	fastcgi_param CONTENT_LENGTH  $content_length;
		fastcgi_param  PATH_INFO $fastcgi_path_info;
    	}

}
````

#### jam.local nginx config example (Assume that project is on this path: /var/www/jam) ####

````
server {
	listen 80;

	sendfile        on;
	keepalive_timeout  65;
    	gzip  on;
    	gzip_min_length 1024;
    	gzip_buffers 12 32k;
    	gzip_comp_level 9;
    	gzip_proxied any;
	gzip_types	text/plain application/xml text/css text/js text/xml application/x-javascript text/javascript application/javascript application/json application/xml+rss;
	
	server_name jam.local;
	root /var/www/jam/frontend/web;

	access_log /var/www/jam/frontend/access.log;
	error_log /var/www/jam/frontend/error.log;

	charset utf-8;

	location / {
	    root /var/www/jam/frontend/web/;
	    index index.php;
	    try_files $uri $uri/ /index.php?$args;
	}

    	location ~ \.php$ {
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		
		root /var/www/jam/frontend/web/;

		try_files $uri $uri/ =404;
		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
		fastcgi_index index.php;
		include fastcgi_params;
		fastcgi_param                   SCRIPT_FILENAME $document_root$fastcgi_script_name;


	    	fastcgi_param QUERY_STRING    $query_string;
	    	fastcgi_param REQUEST_METHOD  $request_method;
	    	fastcgi_param CONTENT_TYPE    $content_type;
	    	fastcgi_param CONTENT_LENGTH  $content_length;
		fastcgi_param  PATH_INFO $fastcgi_path_info;
    	}

}
````
$ sudo ln -s /etc/nginx/sites-available/jam.local /etc/nginx/sites-enabled/jam.local

$ sudo ln -s /etc/nginx/sites-available/api.jam.local /etc/nginx/sites-enabled/api.jam.local

$ sudo service nginx restart

#### /etc/hosts ####

````
127.0.0.1	api.jam.local
127.0.0.1	jam.local
````

## Database ##

Create two mysql databases, i.e. jam & jam.local

````
'components' => [
        ...
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=jam',
            'username' => 'root',
            'password' => 'svd',
            'charset' => 'utf8',
        ],
        ...
]        
````

then Change appropriate config in `common/config/main-local.php` for real DB
 & `common/config/test-local.php` for test DB
 
 ## HOW TO USE ##
 
 main entry point http://jam.local 
 
 ## RUN TESTS ##
 
 cd /var/www/jam/common
 
 $ ../vendor/bin/codecept run unit
