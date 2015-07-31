# Propel Provider Behavior

A Propel ORM Behavior that provides you with Providers for Query/Model/Peer Objects.

## Requirements

- Propel > 1.6.0

## Install

Add the dependency to this behavior to your projects `composer.json` file

    "require": {
        "emiliomg/PropelProviderBehavior": "~1.0"
    },

Then, add the following configuration to your `build.properties` or `propel.ini` file:

    propel.behavior.providerBase.behavior: vendor.emiliomg.PropelProviderBehavior.src.ProviderBaseBehavior.ProviderBaseBehavior
    propel.behavior.providerFassade.behavior: vendor.emiliomg.PropelProviderBehavior.src.ProviderFassadeBehavior.ProviderFassadeBehavior
    propel.behavior.default: providerBase, providerFassade

The `propel.behavior.default` makes sure every one of your models uses this behavior.

Then, rebuild your models. The provider classes will be generated (Base and Fassade).

## Configuration

There is no configuration.
