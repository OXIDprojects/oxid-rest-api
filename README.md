# oxid-rest-api
powered by OXID Community Hackathon 2018

This REST API prototype uses the PHP micro framework [Lumen](https://lumen.laravel.com/).

<<<<<<< HEAD
Get all articles

`http://rest.oxid.localhost:9000/v1/articles`

Get article by oxid

`http://rest.oxid.localhost:9000/v1/articles/05833e961f65616e55a2208c2ed7c6b8`

Get article by column and value

`http://rest.oxid.localhost:9000/v1/articles/oxartnum/400-01`
=======
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

Example plain database routes for articles are e.g.:

```bash
# get all articles
http://your-shop.org/rest/v1/articles/
# get one article object via OXID framework
http://your-shop.org/rest/v1/articles/05833e961f65616e55a2208c2ed7c6b8
```

An example object route is:

```bash
# get one article object via OXID framework
http://your-shop.org/rest/v1/object/articles/05833e961f65616e55a2208c2ed7c6b8
```

Get article by column and value from the database:
`http://your-shop.org/rest/v1/articles/oxartnum/400-01`
>>>>>>> b142aa28edab20b5c65fc0f8b5857c52f0eea08d
