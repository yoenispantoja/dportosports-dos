# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

`mwc-shipping` is a PHP library providing normalized shipping functionality for WooCommerce. It defines common models, contracts, and operations for handling order shipping across different shipping providers.

**Key architectural principle**: This is a base library that other MWC packages depend on. There is no release versioning - projects always use `dev-main` branch.

## Commands

### Testing
```bash
# Run all tests
vendor/bin/phpunit tests

# Run unit tests only
vendor/bin/phpunit tests/Unit

# Run tests with specific seed (for reproducing failures)
vendor/bin/phpunit tests --random-order-seed=12345
```

### Code Quality
```bash
# Run PHPStan (static analysis at max level)
vendor/bin/phpstan analyse

# Run PHP CodeSniffer (PHPCompatibility checks for PHP 7.4+)
vendor/bin/phpcs

# Pre-commit hooks (run automatically on commit)
# - tartufo (secret scanning)
# - php-cs-fixer (code formatting)
```

### Dependencies
```bash
# Install dependencies
composer install

# Update this package in dependent projects
composer update godaddy/mwc-shipping
```

## Architecture

### Namespace Structure
- **Root namespace**: `GoDaddy\WordPress\MWC\Shipping`
- **PSR-4 autoloading**: `src/` maps to root namespace, `tests/` to `Tests\` namespace

### Core Components

**1. Entry Points**
- `Shipping.php` - Main singleton class, loads providers from configuration
- `Fulfillment.php` - Handles shipment lifecycle (create, update, delete) and order fulfillment status updates

**2. Models (`Models/`)** - Data representations
- `Shipment` - Core shipment model with origin/destination addresses, packages, carrier
- `ShippingRate`, `ShippingLabel`, `Carrier`, `ShippingService`
- `Packages/` - Package models with dimensions, weight, items
- `Orders/` - Order fulfillment models and status classes
- `Account/` - Shipping account models

**3. Contracts (`Contracts/`)** - Interfaces defining capabilities
- Gateway contracts: `HasShippingRatesGatewayContract`, `HasShippingLabelsGatewayContract`, etc.
- Operation contracts: `CalculateShippingRatesOperationContract`, `PurchaseShippingLabelsOperationContract`, etc.
- Capability contracts: `CanGetShippingRatesContract`, `CanPurchaseShippingLabelsContract`, etc.
- Model contracts: `ShipmentContract`, `PackageContract`, etc.

**4. Operations (`Operations/`)** - Business operation implementations
- `CalculateShippingRatesOperation`, `GetShippingRateOperation`
- `PurchaseShippingLabelsOperation`, `VoidShippingLabelOperation`
- `GetTrackingStatusOperation`, `ListCarriersOperation`

**5. Traits (`Traits/`)** - Reusable behavior
- Gateway traits: `HasShippingRatesGatewayTrait`, `HasShippingLabelsGatewayTrait`
- Capability traits: `CanGetShippingRatesTrait`, `CanPurchaseShippingLabelsTrait`
- Model traits: `HasShipmentTrait`, `HasPackageTrait`, `HasAccountTrait`
- `AdaptsRequestsTrait` - Request/response transformation

**6. Gateways (`Gateways/`)** - Provider integrations
- `AbstractGateway` - Base class for provider-specific implementations

**7. Providers (`Providers/`)** - Shipping service providers
- Extend `AbstractProvider` from `mwc-common`
- Registered via configuration (`shipping.providers`)

**8. Events (`Events/`)** - Domain events
- `ShipmentCreatedEvent`, `ShipmentUpdatedEvent`, `ShipmentDeletedEvent`
- Broadcast via `Events::broadcast()` from `mwc-common`

**9. Adapters (`Adapters/`)** - Data transformation layer
- Implement `GatewayRequestAdapterContract`
- Convert between internal models and provider-specific formats

### Design Patterns

**Trait-based capabilities**: Functionality is composed using traits that implement specific contracts. For example, a gateway that supports shipping rates would use `HasShippingRatesGatewayTrait` and implement `HasShippingRatesGatewayContract`.

**Operation pattern**: Complex actions are encapsulated in Operation classes that implement `OperationContract`. Operations are executed by gateways and contain the business logic for specific tasks.

**Provider pattern**: Shipping providers extend `AbstractProvider` and register their gateways. The main `Shipping` class manages all registered providers.

**Event-driven**: Key lifecycle events (shipment created/updated/deleted) are broadcast using the event system from `mwc-common`, allowing decoupled handlers to react to changes.

## Dependencies

- **godaddy/mwc-common**: Core MWC functionality (models, traits, providers, events, configuration)
- **PHP**: 7.4+ (platform set to 7.4 in composer.json)
- **WooCommerce**: Required at runtime (stubs used for development)
- **WordPress**: Required at runtime (stubs used for development)

## Testing Notes

- Uses PHPUnit 9.5 with strict mode enabled
- WP Mock with Patchwork for WordPress function mocking
- Tests run in random order by default (see `phpunit.xml`)
- Requires `@covers` annotation for all tests (`forceCoversAnnotation="true"`)
- Test bootstrap: `tests/bootstrap.php` loads composer autoloader and initializes WP_Mock

## Development Workflow

1. This package has no versioned releases - dependent projects use `dev-main`
2. PHPStan runs at max level with a baseline file (`phpstan-baseline.neon`)
3. Pre-commit hooks enforce secret scanning (tartufo) and code formatting
4. When updating in dependent projects, run `composer update godaddy/mwc-shipping` only (don't update other packages)
