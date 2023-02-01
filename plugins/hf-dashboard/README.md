# Health First Hit Dashboard

Widged to show a chart with the number of received hits from lead pages

## Requirements

This plugin requires
 * Craft CMS 4.3.6.1 or later
 * PHP 8.0.2 or later

## Installation

You can install this plugin with Composer.<br>
Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require healthfirst/hf-dashboard

# tell Craft to install the plugin
./craft plugin/install hf-dashboard
```

## Registering the Hits

Send a Post to the path
```bash
 /register-hit
```

The expected json format is
```bash
 {
    "ip", //String
    "site", //String
    "laguage", //String
    "url", //String
    "formInfo" //Json Object
 }
```

###The expected return
Will be a json with the success true or false depending on the result

#### Success
```bash
 {
    "success": true
 }
```

####In case of error
```bash
 {
    "success": false,
    "error": ["Error messages"]
 }
```

