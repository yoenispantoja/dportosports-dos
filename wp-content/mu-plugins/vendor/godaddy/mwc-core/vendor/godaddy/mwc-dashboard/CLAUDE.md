# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

MWC Dashboard is a WordPress/WooCommerce library that provides dashboard backend functionality for the Managed WooCommerce (MWC) platform. It's a proprietary GoDaddy package that depends on `mwc-common` and `mwc-shipping` libraries.

**Key architectural notes:**
- This package uses `dev-main` branch (no versioning) to avoid dependency conflicts across MWC projects
- The codebase follows PSR-4 autoloading with namespace `GoDaddy\WordPress\MWC\Dashboard`
- Uses singleton pattern and component-based architecture via `HasComponentsFromContainerTrait`
- REST API controllers are conditionally registered based on WooCommerce availability
- Configuration files in `configurations/` directory are loaded via `Configuration::initialize()`

## Development Commands

### Testing
```bash
# Run all tests
vendor/bin/phpunit

# Run specific test suite
vendor/bin/phpunit --testsuite=Unit
vendor/bin/phpunit --testsuite=Integration

# Run single test file
vendor/bin/phpunit tests/Unit/Path/To/ClassTest.php

# Run with specific random seed (for reproducing failures)
vendor/bin/phpunit --random-order-seed=12345
```

### Code Quality
```bash
# PHP CodeSniffer (PHP 7.4+ compatibility check)
vendor/bin/phpcs

# PHPStan static analysis (level: max)
vendor/bin/phpstan analyse

# PHP-CS-Fixer code style fixes
vendor/bin/php-cs-fixer fix
```

### Dependencies
```bash
# Install dependencies
composer install

# Update this package in dependent projects (e.g., mwc-core)
composer update godaddy/mwc-dashboard
```

## Architecture

### Core Components
- **Dashboard.php** - Main plugin class extending `BasePlatformPlugin`, uses singleton pattern
- **API/** - REST API controllers for various resources (messages, plugins, orders, shipping, support)
- **Shipping/** - Fulfillment and shipment tracking adapters/data stores
- **Support/** - Support request handling and user management
- **Message/** - Dashboard messaging system with opt-in functionality

### Component Loading
Components are loaded conditionally via `$classesToInstantiate` array:
- `API::class` - Always loaded
- `GetHelpMenu::class` - Loaded in web context
- `WooCommerceExtensionsPage::class` - Loaded in web context

API controllers for orders, extensions, shipping are only registered when WooCommerce is active (see `API::setControllers()`).

### Data Flow
1. WordPress hooks trigger component initialization
2. Configuration loaded from `configurations/` directory
3. REST API routes registered on `rest_api_init` action
4. Controllers use traits for permission checks (`RequiresWooCommercePermissionsTrait`, `RequiresAdministratorPermissionsTrait`)
5. Adapters transform between WordPress/WooCommerce and internal data models

## Testing

- **Framework**: PHPUnit 9.6 with WP_Mock
- **Test types**: Unit tests (mock WordPress functions) and Integration tests
- **Bootstrap**: `tests/bootstrap.php` loads Composer autoloader and initializes WP_Mock with Patchwork
- **Coverage**: Tests must use `@covers` annotations (strict mode enabled)
- **Randomization**: Tests run in random order by default for isolation verification

## Code Standards

### PHP Compatibility
- Target: PHP 7.4+ (configured in composer.json platform)
- PHPCompatibility ruleset enforced via PHPCS

### Static Analysis
- PHPStan level: max
- Baseline: `phpstan-baseline.neon` (excludes `MessagesFailedFetchException.php`)
- Uses WordPress/WooCommerce stubs for type inference

### Code Style
- PHP-CS-Fixer configuration in `.php_cs`
- Key rules: short array syntax, single-space operators, PSR-2 braces, no concat spacing
- Targets: `src/`, `configurations/`, `tests/`

## Special Considerations

- The package conditionally loads based on `WordPressRepository::isCliMode()` returning false
- Text domain `mwc-dashboard` loaded from `languages/` directory
- Configuration values include `PLUGIN_DIR`, `PLUGIN_URL`, and `VERSION` (currently 1.3.1)
- SkyVerge Dashboard is deactivated when GetHelpMenu loads
