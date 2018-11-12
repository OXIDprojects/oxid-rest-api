# Installation

## Installation methods

It´s possible to use this api only with the oxid database \(without the framework and therefore without the oxid objects and oxid hooks. Also it´s possible to use this with bootstraped oxid framework \(slow!\).

### Installation inside OXID \(using oxid objects\)

1. Switch to your oxid `source` directory and install project

```text
composer create-project oxid-community/oxid-rest-api rest
```

2. Add rewrite rules to `.htaccess` file after line  
_RewriteRule oxseo.php$ oxseo.php?mod\_rewrite\_module\_is=on \[L\]_

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

3. Create `rest_users` table and test user

```text
CREATE TABLE `rest_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api-token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api-rights` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rw',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `rest_users` (`id`, `name`, `api-token`, `api-rights`, `created_at`, `updated_at`)
VALUES
	(1,'Test User','t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs','rw',NULL,NULL);
```

4. Update database credentials in `.env` file

{% hint style="success" %}
Finished! Testing ... [http://localhost/rest/v1/object/articles?apiToken=t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs](http://localhost/rest/v1/object/articles?apiToken=t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs)
{% endhint %}



### Installation outside oxid \(database only\)

1. Switch to your vhost root directory and install project

```text
composer create-project oxid-community/oxid-rest-api rest
```

2. Update database credentials in `.env` file

3. Migrate and seed database

```text
php artisan migrate
php artisan db:seed
```

{% hint style="success" %}
Finished! Testing ... [http://localhost/rest/v1/articles?apiToken=t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs](http://localhost/rest/v1/articles?apiToken=t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs)
{% endhint %}



