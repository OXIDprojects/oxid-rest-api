# oxid-rest-api
powered by OXID Community Hackathon 2018

This REST API prototype uses the PHP micro framework [Lumen](https://lumen.laravel.com/).

## Installation

Copy the repository files into your OXID source folder:

- source
    - rest

You can also clone it from Github with:

```bash
cd source/
git clone git@github.com:OXIDprojects/oxid-rest-api.git rest
```


Add this to your __"source/.htaccess"__ file, right below

```bash
    RewriteRule oxseo\.php$ oxseo.php?mod_rewrite_module_is=on [L]
```

```bash
    # LUMEN REST start
    RewriteCond %{HTTP:Authorization} ^(.*)
    RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]
    RewriteCond %{REQUEST_URI} .*rest.*
    RewriteCond %{REQUEST_URI} !rest\.php$
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule .* rest/public/index.php [L,QSA]
    # LUMEN REST end
```

to redirect all requests to "/rest/" to the Lumen REST API.

## Usage

There are _two different type of routes_ - database only routes and "OXID object" routes, which bootstrap the OXID framework.

A plain database route for articles is e.g.:

```bash
http://your-shop.org/rest/v1/articles/
```

An example object route is:

```bash
http://your-shop.org/rest/v1/object/articles/05833e961f65616e55a2208c2ed7c6b8
```
