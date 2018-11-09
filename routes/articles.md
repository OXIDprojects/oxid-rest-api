# Articles

{% api-method method="get" host="https://YOUT\_SHOP\_URL" path="/rest/v1/articles" %}
{% api-method-summary %}
all articles 
{% endapi-method-summary %}

{% api-method-description %}
Get all articles.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-query-parameters %}
{% api-method-parameter name="filter" type="string" required=false %}
filter\[\]=oxactive\|=\|1&filter\[\]=oxtitle\|like\|kite  
{% endapi-method-parameter %}
{% endapi-method-query-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}

{% endapi-method-response-example-description %}

```javascript
{
    "OXID": "05848170643ab0deb9914566391c0c63",
    "OXSHOPID": 1,
    "OXPARENTID": "",
    "OXACTIVE": 1,
    "OXHIDDEN": 0,
    "OXACTIVEFROM": "0000-00-00 00:00:00",
    "OXACTIVETO": "0000-00-00 00:00:00",
    "OXARTNUM": "1402",
    "OXEAN": "",
    "OXDISTEAN": "",
    "OXMPN": "",
    "OXTITLE": "Trapez ION MADTRIXX",
    "OXSHORTDESC": "Neues Freestyle Trapez mit einer schlank geschnittenen Outline",
    "OXPRICE": 159,
    ...
},
{
    "OXID": "0584e8b766a4de2177f9ed11d1587f55",
    "OXSHOPID": 1,
    "OXPARENTID": "",
    "OXACTIVE": 1,
    "OXHIDDEN": 0,
    "OXACTIVEFROM": "0000-00-00 00:00:00",
    "OXACTIVETO": "0000-00-00 00:00:00",
    "OXARTNUM": "1501",
    "OXEAN": "",
    "OXDISTEAN": "",
    "OXMPN": "",
    "OXTITLE": "Klebeband DACRON KITEFIX",
    "OXSHORTDESC": "Ideal für kleine Reparaturen am Kite",
    "OXPRICE": 7.99,
    ...
}
```
{% endapi-method-response-example %}

{% api-method-response-example httpCode=404 %}
{% api-method-response-example-description %}

{% endapi-method-response-example-description %}

```javascript
No artcicles found
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}

{% api-method method="get" host="https://YOUT\_SHOP\_URL" path="/rest/v1/articles/{id}" %}
{% api-method-summary %}
one article
{% endapi-method-summary %}

{% api-method-description %}
Get one article by oxid.
{% endapi-method-description %}

{% api-method-spec %}
{% api-method-request %}
{% api-method-path-parameters %}
{% api-method-parameter name="id" type="string" required=true %}
oxarticles.oxid
{% endapi-method-parameter %}
{% endapi-method-path-parameters %}
{% endapi-method-request %}

{% api-method-response %}
{% api-method-response-example httpCode=200 %}
{% api-method-response-example-description %}

{% endapi-method-response-example-description %}

```javascript
{
    "OXID": "05848170643ab0deb9914566391c0c63",
    "OXSHOPID": 1,
    "OXPARENTID": "",
    "OXACTIVE": 1,
    "OXHIDDEN": 0,
    "OXACTIVEFROM": "0000-00-00 00:00:00",
    "OXACTIVETO": "0000-00-00 00:00:00",
    "OXARTNUM": "1402",
    "OXEAN": "",
    "OXDISTEAN": "",
    "OXMPN": "",
    "OXTITLE": "Trapez ION MADTRIXX",
    "OXSHORTDESC": "Neues Freestyle Trapez mit einer schlank geschnittenen Outline",
    "OXPRICE": 159,
    ...
}
```
{% endapi-method-response-example %}

{% api-method-response-example httpCode=404 %}
{% api-method-response-example-description %}

{% endapi-method-response-example-description %}

```javascript
Article with {id} not found
```
{% endapi-method-response-example %}
{% endapi-method-response %}
{% endapi-method-spec %}
{% endapi-method %}

{% hint style="info" %}
Use `/rest/v1/object/articles` to get the whole oxid object \(see [Installation](../installation.md#installation-within-oxid)\). 
{% endhint %}

{% page-ref page="filters.md" %}



