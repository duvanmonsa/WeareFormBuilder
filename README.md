# WeareFormBuilderBundle

WeareFormBuilderBundle has the logic to create and store dinamic forms in database.
this Bundle is no ready yet but is funtional, i will work on traslations.
Features
------------

1.  manage forms with its customs fields
2. use SonataAdminBundle so it has implemente admins
3. there is a block implemente to use with Cms

# Install

## Step 1: Download WeareFormBuilder using composer

Add WeareFormBuilder in your composer.json:

{
    "require": {
        "weare/form-builder": "~1.0@dev"
    }
}

## Step 2: Enable the bundle

Enable the bundle in the kernel:

<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Weare\FormBuilderBundle\FormBuilderBundle(),
    );
}

## Step 3: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your database schema because you have added the new entities, 
Run the following command.

$ php app/console doctrine:schema:update --force

# Next Steps

I will continue working with the project if anyone has problem contact me. 