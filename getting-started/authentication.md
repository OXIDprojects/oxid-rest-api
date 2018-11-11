---
description: API authentication
---

# Authentication

Using the API needs and authentication with an API token.

## Methods

 There are two ways to transmit an token:

#### Request header

> Request header **`Api-Token`** is required

#### GET parameter

> GET parameter **`apiToken`** is required

## Token administration

Tokens are stored in the database table rest\_users.

| Column | Value |
| :--- | :--- |
| name | User name / Token info _optional_ |
| api-token | Token **required** |
| api-rights | rw/r **required** |

{% hint style="info" %}
While installation user with token `t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs` is created.
{% endhint %}

## Permissions

It´s possible to set **read/write** \(default\) and only **read** permissions.

| Status | Permission |
| :--- | :--- |
| rw | GET, PUT, POST, DELETE |
| w | GET |


