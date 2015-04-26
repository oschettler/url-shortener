# A simple redirector

Welcome to the bare bones URL shortener. This software has one function. Installed on a short domain, e.g. `cis.pm`, it reads the request URI, e.g. `olav`, maps it to a target and redirects the request there. Try it: [cis.pm/olav](http://cis.pm/olav) 

To manipulate the mappings, the URL shortener sports a simple admin interface. To authenticate, the admin interface requires you to have a Chefkoch account with `admin` role. 

![Login screen](https://raw.githubusercontent.com/oschettler/url-shortener/master/public/img/login.png)

You can use this account to log in and edit existing links or create new ones.

![Admin screen](https://raw.githubusercontent.com/oschettler/url-shortener/master/public/img/admin.png)

## Installation

You need an SQlite database in `storage/database.sqlite`. Create it with

````shell
sqlite3 storage/database.sqlite < links.sql
chown www-data storage/database.sqlite
````

## Colophon

The backend uses the [Lumen PHP micro framework](http://lumen.laravel.com/). The responsive admin interface is styled with [Skeleton](http://getskeleton.com/) and uses a simple REST interface. A middleware authenticates against the Chefkoch API. The admin frontend uses [jQuery](http://jquery.com/) and [RiotJS](https://muut.com/riotjs/) to provide a login screen and a list with mappings. The list itself is content editable to provide for in-place updates.
