# Installation

{% hint style="info" %}
 There are two different type of routes - _database only routes_ and _oxid object routes_, which bootstraps the oxid framework \("Installation within OXID"\).
{% endhint %}

## Installation within OXID

1.Download git repository

```
cd /YOUR_SHOP_ROOT/source/
git clone git@github.com:OXIDprojects/oxid-rest-api.git rest
```

2. Add rewrite rules to `.htaccess` file  
after line `RewriteRule oxseo.php$ oxseo.php?mod_rewrite_module_is=on [L]`

```
# LUMEN REST start
RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]
RewriteCond %{REQUEST_URI} .*rest.*
RewriteCond %{REQUEST_URI} !rest\.php$
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule .* rest/public/index.php [L,QSA]
# LUMEN REST end
```

3. Install composer

```text
cd /YOUR_SHOP_ROOT/source/rest/
composer install
```

## Installation outside OXID

If you don´t need oxid objects it´s not necessary to install the api outside the oxid source directory. In this case you also don´t need do add the rewrite rules in your shop `.htaccess` file. 

## Routes

{% page-ref page="routes/articles.md" %}



