# ACF Permalinks

Plugin allows to use ACF values in permalink structure by adding %field_fieldname%, for posts, pages and custom post types. This is an extenion for the plugin [Custom Fields Permalink 2](https://wordpress.org/plugins/custom-fields-permalink-redux/).

[![Build Status](https://travis-ci.org/athlan/acf-permalink.svg?branch=master)](https://travis-ci.org/athlan/acf-permalink)
[![codecov](https://codecov.io/gh/athlan/acf-permalink/branch/master/graph/badge.svg)](https://codecov.io/gh/athlan/acf-permalink)

## Description

Plugin allows to use ACF values in permalink structure by adding %field_fieldname%, for posts, pages and custom post types. This is an extenion for the plugin [Custom Fields Permalink 2](https://wordpress.org/plugins/custom-fields-permalink-redux/).

![Screenshot](https://raw.githubusercontent.com/athlan/acf-permalink/master/assets/screenshot-1.png "Screenshot")

Examples:

* `http://example.com/%field_event_date_from%/%postname%/`
* `http://example.com/post-type/%field_event_date_from%/%postname%/` (with <a href="https://wordpress.org/plugins/custom-post-type-permalinks/">Custom Post Type Permalinks</a> plugin)

You can also set different permalink structure depending on custom post type using <a href="https://wordpress.org/plugins/custom-post-type-permalinks/">Custom Post Type Permalinks</a> plugin. You can create own post types by using <a href="https://wordpress.org/plugins/custom-post-type-ui/">Custom Post Type UI</a> plugin.

The plugin works for:

* posts
* pages
* custom post types

Plugin is also avaliable on GitHub:
<a href="https://github.com/athlan/acf-permalink">https://github.com/athlan/acf-permalink</a>

## Supported ACF Fields
Examples below assumes that field name is `Some field`.

### Text fields

|Case|Situation|Result|
|---|----|----|
|**Simple value**|Value: *Some value*<br>Permalink structure: `/%field_some_field%/`|`/some-value/`|

### Checkbox

|Case|Situation|Result|
|---|----|----|
|**Single value selected**|Selected values: *Red*<br>Permalink structure: `/%field_some_field%/`|`/red/`|
|**Multiple values selected**|Selected values: *Red, Light blue*<br>Permalink structure: `/%field_some_field%/`|`/red-light-blue/`|
|**Custom values separator**|Selected values: *Red, Light blue*<br>Permalink structure: `/%field_some_field(separator='-and-')%/`|`/red-and-light-blue/`|
|**Use choices labels**|Selected values: *color1 (label: Red), color2 (label: Light blue)*<br>Permalink structure: `/%field_some_field%/`|`/red-light-blue/`|

### Radio

|Case|Situation|Result|
|---|----|----|
|**Single value selected**|Selected value: *Red*<br>Permalink structure: `/%field_some_field%/`|`/red/`|
|**Use choices labels**|Selected value: *color1 (label: Red)*<br>Permalink structure: `/%field_some_field%/`|`/red/`|

### Date Picker

|Case|Situation|Result|
|---|----|----|
|**Default format**|Selected value: *3/1/2018*<br>Permalink structure: `/%field_some_field%/`|`/2018-03-01/`|
|**Custom date format**|Selected value: *3/1/2018*<br>Permalink structure: `/%field_some_field(format=d-m-y)%/`<br>Date format documentation: [http://php.net/manual/en/function.date.php](http://php.net/manual/en/function.date.php)|`/01-03-2018/`|
|**Year only**|Selected value: *3/1/2018*<br>Permalink structure: `/%field_some_field(year)%/`|`/2018/`|
|**Month only**|Selected value: *3/1/2018*<br>Permalink structure: `/%field_some_field(month)%/`|`/03/`|
|**Day only**|Selected value: *3/1/2018*<br>Permalink structure: `/%field_some_field(day)%/`|`/01/`|

### Post Object, Page Link

|Case|Situation|Result|
|---|----|----|
|**Single value selected**|Selected post: *ID: 5, Post title: Some referenced post title*<br>Permalink structure: `/%field_some_field%/`|`/some-referenced-post-title/`|
|**Multiple values selected**|Selected posts: *ID: 5, 6, Post titles: First page, Second Page*<br>Permalink structure: `/%field_some_field%/`|`/first-page-second-page/`|
|**Custom values separator**|Selected posts: *ID: 5, 6, Post titles: First page, Second Page*<br>Permalink structure: `/%field_some_field(separator='-and-')%/`|`/first-page-and-second-page/`|

**Note**: Always post title is displayed.

### User

Given two users:
1. ID: 5, login: tgiovani, first name: Tom, Last name: Giovani, Display name: Tom Giovani, email: tom.giovani@example.com
2. ID: 6, login: barry, first name: Rosie, Last name: Barry, Display name: Rosie Barry, email: rossie.barry@example.com

|Case|Situation|Result|
|---|----|----|
|**Single value selected**|Selected user: *ID: 5*<br>Permalink structure: `/%field_some_field%/`|`/tgiovani/`|
|**Multiple values selected**|Selected users: *ID: 5, 6*<br>Permalink structure: `/%field_some_field%/`|`/tgiovani-barry/`|
|**Custom values separator**|Selected users: *ID: 5, 6, User names: user5, user6*<br>Permalink structure: `/%field_some_field%/`|`/tgiovani-and-barry/`|
|**Custom format - Display name**|Selected user: *ID: 5*<br>Permalink structure: `/%field_some_field(format=displayname)%/`|`/tom-giovani/`|
|**Custom format - First name**|Selected user: *ID: 5*<br>Permalink structure: `/%field_some_field(format=firstname)%/`|`/tom/`|
|**Custom format - Last name**|Selected user: *ID: 5*<br>Permalink structure: `/%field_some_field(format=lastname)%/`|`/giovani/`|
|**Custom format - First name and Last name**|Selected user: *ID: 5*<br>Permalink structure: `/%field_some_field(format=firstname-lastname)%/`|`/tom-giovani/`|
|**Custom format - Email**|Selected user: *ID: 5*<br>Permalink structure: `/%field_some_field(format=email)%/`|`/tom-giovani-at-example-com/`|

Custom format tokens:
* login
* nicename
* firstname
* lastname
* displayname
* email
  
## Installation

1. Search for **ACF Permalinks** or follow the link
https://wordpress.org/plugins/acf-permalinks/

2. Install "Custom Fields Permalink 2" plugin.
https://wordpress.org/plugins/custom-fields-permalink-redux/

Of course you need to have Advanced Custom Fields plugin installed.
https://wordpress.org/plugins/advanced-custom-fields/

## Changelog

Release notes: https://github.com/athlan/acf-permalink/releases
