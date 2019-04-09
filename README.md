# Overview

{% hint style="info" %}
**Documentation:** [https://docs.oxid-projects.com/oxid-rest-api/](https://docs.oxid-projects.com/oxid-rest-api/)  
**Repository:** [https://github.com/OXIDprojects/oxid-rest-api](https://github.com/OXIDprojects/oxid-rest-api)
{% endhint %}

## About

This community project was started on the [OXID Hackathon 2018](https://openspacer.org/12-oxid-community/223-oxid-hackathon-nuernberg-2018/).  
It´s based on the PHP micro framework [Lumen](https://lumen.laravel.com/).

## Status quo

This project is wip \(work in progress\). The API is functionally working and the first route [_articles_](routes-1/routes/articles.md#get-all-articles) exists.

{% page-ref page="contribution.md" %}

{% page-ref page="changelog.md" %}


## SwaggerLume Installation

- Run `php artisan swagger-lume:publish-config` to publish configs (`config/swagger-lume.php`)
- Make configuration changes if needed
- Run `php artisan swagger-lume:publish` to publish everything

## Configuration

- Run `php artisan swagger-lume:publish-config` to publish configs (`config/swagger-lume.php`)
- Run `php artisan swagger-lume:publish-views` to publish views (`resources/views/vendor/swagger-lume`)
- Run `php artisan swagger-lume:publish` to publish everything
- Run `php artisan swagger-lume:generate` to generate docs

## Credits
* Tobias Merkl \| [@tabsl](https://twitter.com/tabsl) \| [proudcommerce.com](https://www.proudcommerce.com)
* Stefan Moises \| [@upsettweety](https://twitter.com/upsettweety) \| [rent-a-hero.de](http://www.rent-a-hero.de)

