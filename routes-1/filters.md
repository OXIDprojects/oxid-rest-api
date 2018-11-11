---
description: API filters
---

# Filters

It´s possible to filter `article` requests.

{% hint style="info" %}
**Example:** Get all articles whith `oxactive = 1` and oxtitle like '%kite%'

`https://YOUR_SHOP_URL/rest/v1/articles?filter[]=oxshopid|=|1&filter[]=oxtitle|like|kite`
{% endhint %}

## Filter format

```text
oxactive|=|1
```

1. key \(eg. oxarticles.oxactive\)
2. action
3. value

## Filter actions

```text
'='
'!='
'<'
'<='
'>'
'>='
'like'
```



