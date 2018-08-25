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

Plugin supoorts many fields:

* Text fields
* Checkbox
* Radio
* Date Picker
* Post Object, Page Link
* User

Full usage samples are included in [Supported ACF Fields](https://github.com/athlan/acf-permalink/wiki#supported-acf-fields) wiki page.

## Installation

1. Search for **ACF Permalinks** or follow the link
https://wordpress.org/plugins/acf-permalinks/

2. Install "Custom Fields Permalink 2" plugin.
https://wordpress.org/plugins/custom-fields-permalink-redux/

Of course you need to have Advanced Custom Fields plugin installed.
https://wordpress.org/plugins/advanced-custom-fields/

## Changelog

Release notes: https://github.com/athlan/acf-permalink/releases
