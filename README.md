# OXID REST API
powered by OXID Community Hackathon 2018.

This REST API prototype uses the PHP micro framework [Lumen](https://lumen.laravel.com/).

## Installation

1. Download repo from github:

```bash
cd /YOUR_SHOP_ROOT/source/
git clone git@github.com:OXIDprojects/oxid-rest-api.git rest
```

2. Add code

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

to `source/.htaccess` file, right below

```bash
    RewriteRule oxseo\.php$ oxseo.php?mod_rewrite_module_is=on [L]
```

to redirect all requests to "/rest/" to the Lumen REST API.

3. Run composer install

```bash
cd /YOUR_SHOP_ROOT/source/rest/
composer install
```

## Usage

There are _two different type of routes_ - database only routes and "OXID object" routes, which bootstraps the OXID framework.

If `/object/` is used in url, you will get the whole oxid object.

### Routes

**Articles**

```bash
# get all articles (db only)
https://YOUR_SHOP_ROOT/rest/v1/articles/

# get one article (db only)
https://YOUR_SHOP_ROOT/rest/v1/article/05833e961f65616e55a2208c2ed7c6b8

# get all articles (oxarticles object)
https://YOUR_SHOP_ROOT/rest/v1/object/articles/

# get one article (oxarticles object)
https://YOUR_SHOP_ROOT/rest/v1/object/article/05833e961f65616e55a2208c2ed7c6b8
```
### Filter

Example: Get all articles whith `oxactive = 1` and `oxtitle LIKE '%kite%'`

```bash
# get all articles
https://v/rest/v1/articles?filter[]=oxshopid|=|1&filter[]=oxtitle|like|kite
```

Every filter consists three parts:

1. key (eg. oxarticles.oxshopid)
2. action
4. value

Allowed filter actions:
```bash
'=',
'!=',
'<',
'<=',
'>',
'>=',
'like'
```

## Using API without oxid objects

If you don´t need oxid objects, you haven´t to install this api within your shop folder / edit .htaccess file. But in this case you have to set up your database credentials in `.env` file.
