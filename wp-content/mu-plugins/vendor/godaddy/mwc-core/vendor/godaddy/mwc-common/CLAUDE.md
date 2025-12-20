# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Overview

**MWC Common** is a shared PHP library for the Managed WooCommerce (MWC) platform. It provides reusable objects, registries, helpers, and abstractions used across MWC plugins.

**Namespace**: `GoDaddy\WordPress\MWC\Common`
**PHP Version**: 7.4 - 8.x
**Documentation**: https://upgraded-lamp-d562c70b.pages.github.io

## Development Commands

### Testing
```bash
# Run all tests
vendor/bin/phpunit tests

# Run specific test suite
vendor/bin/phpunit tests/Unit
vendor/bin/phpunit tests/Integration

# Run single test file
vendor/bin/phpunit tests/Unit/Path/To/SpecificTest.php

# Run with specific random seed (for reproducing test order failures)
vendor/bin/phpunit tests --random-order-seed=12345

# Generate code coverage report (outputs to /html directory)
vendor/bin/phpunit tests --coverage-html html
```

Tests execute in random order by default. PHPUnit outputs the seed when running - use `--random-order-seed` to reproduce specific test order failures.

### Installation
```bash
composer install
composer require godaddy/mwc-common  # For consuming projects
composer update godaddy/mwc-common   # Update to latest version
```

### Release Process
Releases are automated via GitHub Actions:
- Merging to `main` creates a **patch** release
- Use PR label `bump:minor` for **minor** releases
- Use PR label `bump:major` for **major** releases

## Architecture

### Core Abstractions

**Configuration System** (`Configuration/`)
- `Configuration::get('key.path', $default)` - Retrieve config values using dot notation
- `Configuration::set('key.path', $value)` - Override config at runtime
- Auto-loads PHP files from `/configurations` directory recursively
- Values cached in `Cache::configurations()` for performance

**Register Pattern** (`Register/`)
- Fluent API for WordPress hooks: `Register::action()->setGroup('hook_name')->setHandler($callable)->execute()`
- `Register::filter()` for filters
- Supports priority, argument count, and conditional registration

**Repository Pattern** (`Repositories/`)
- `WordPressRepository` - Core WP utilities (paths, URLs, filesystem, user auth, screen detection)
- `WooCommerce/*Repository` - WooCommerce-specific repositories (Orders, Products, RestApi, StockStats)
- Repositories provide data access abstraction over WordPress/WooCommerce APIs

**Model Pattern** (`Models/`)
- `AbstractModel` - Base for domain models with CRUD interface (`create()`, `get()`, `update()`, `delete()`, `save()`)
- Includes `CanConvertToArrayTrait` and `CanSeedTrait`
- Emits `ModelEvent` for lifecycle hooks
- Examples: `Product`, `Cart`, `Attribute`, `User`

**Interceptor Pattern** (`Interceptors/`)
- `AbstractInterceptor` implements `InterceptorContract` + `ConditionalComponentContract`
- Interceptors hook into WordPress/WooCommerce to modify behavior
- Override `addHooks()` to register hooks, `shouldLoad()` for conditional loading
- `load()` method triggers hook registration

**Dependency Injection** (`Container/`)
- `ContainerFactory::getInstance()->getSharedContainer()` - Access singleton DI container
- Based on League Container (scoped in `Vendor` namespace)
- Register services and resolve dependencies

### Directory Structure

- `Admin/` - WordPress admin UI components
- `API/` - API client abstractions
- `Auth/` - Authentication utilities
- `Cache/` - Caching abstractions and implementations
- `Components/` - Loadable component contracts
- `Configuration/` - Config system
- `Container/` - Dependency injection
- `Content/` - Post types, taxonomies, context (screens)
- `Contracts/` - Interfaces for major patterns
- `Database/` - Database utilities and migrations
- `DataObjects/` - DTOs for data transfer
- `DataSources/` - External data source adapters
- `Email/` - Email functionality
- `Enqueue/` - Asset enqueuing for scripts/styles
- `Events/` - Event system for pub/sub
- `Exceptions/` - Custom exception classes
- `Extensions/` - Extension/plugin management
- `Features/` - Feature flags and feature implementations
- `Helpers/` - Utility classes (ArrayHelper, StringHelper, TypeHelper, etc.)
- `HostingPlans/` - Hosting plan abstractions
- `Http/` - HTTP client, request/response objects, URL utilities
- `Interceptors/` - Hook-based interceptors
- `Loggers/` - Logging abstractions (Sentry integration)
- `Migrations/` - Database migration system
- `Models/` - Domain models
- `Pipeline/` - Pipeline pattern for data transformation
- `Platforms/` - Platform detection and configuration
- `Plugin/` - WordPress plugin lifecycle management
- `Providers/` - Service providers for bootstrapping
- `Register/` - WordPress hook registration
- `Repositories/` - Data access layer
- `Schedule/` - Scheduled task management (WP Cron)
- `Settings/` - Settings API abstractions
- `Stores/` - State management
- `Sync/` - Data synchronization utilities
- `Traits/` - Reusable traits (e.g., `CanGetNewInstanceTrait`, `IsSingletonTrait`)
- `Validation/` - Input validation

### Key Patterns

1. **Fluent Interfaces**: Many classes use method chaining (`Register`, HTTP classes)
2. **Trait Composition**: Common functionality via traits (`CanConvertToArrayTrait`, `CanSeedTrait`, `IsSingletonTrait`)
3. **Static Facades**: Configuration, Repositories use static methods for convenience
4. **Event-Driven**: Models emit events; components can subscribe
5. **Conditional Loading**: Components implement `shouldLoad()` for environment-specific behavior

### WordPress Integration

- Wraps WordPress globals and functions in repository methods for testability
- `WordPressRepository::requireWordPressInstance()` validates WP is loaded
- `WordPressRepository::requireWordPressFilesystem()` initializes WP_Filesystem
- Use repositories instead of direct global access for better testing and abstraction

## Development Notes

- All classes use strict typing (`declare(strict_types=1)` implied)
- Tests require `@covers` annotations (PHPUnit enforces coverage annotation)
- Prefer repository methods over direct WordPress function calls
- Use `Configuration::get()` over constants for environment-specific values
- Interceptors should extend `AbstractInterceptor` and implement `addHooks()`
