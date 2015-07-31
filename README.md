# Propel Provider Behavior

A Propel ORM Behavior that provides you with Providers for Query/Model/Peer Objects.

## Requirements

- Propel > 1.6.0

## Install

Add the dependency to this behavior to your projects `composer.json` file

    "require": {
        "emiliomg/propel-provider-behavior": "~1.0"
    },

Then, add the following configuration to your `build.properties`:

    propel.behavior.providerBase.behavior: vendor.emiliomg.propel-provider-behavior.src.ProviderBaseBehavior.ProviderBaseBehavior
    propel.behavior.providerFassade.behavior: vendor.emiliomg.propel-provider-behavior.src.ProviderFassadeBehavior.ProviderFassadeBehavior
    propel.behavior.default = providerBase, providerFassade

The `propel.behavior.default` makes sure every one of your models uses this behavior.

Important: When using `Symfony 2`, the last line `propel.behavior.default` differs, since the config is .yml file. It looks like this:
    
    propel.behavior.default: providerBase, providerFassade

Then, rebuild your models. The provider classes will be generated (Base and Fassade).

## Configuration

There is no configuration.
