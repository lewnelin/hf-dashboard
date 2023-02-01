# hf-dashboard

Widged to show a chart with the number of received hits from lead pages

## Requirements

This plugin requires Craft CMS 4.3.6.1 or later, and PHP 8.0.2 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “hf-dashboard”. Then press “Install”.

#### With Composer

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
 /hfdashboard/dashboard/register-hit
```

The expected json format is
```bash
 {
    
 }
```



