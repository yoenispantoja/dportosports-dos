# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

MWC Payments is a PHP library for processing payments in WooCommerce. It provides common models, contracts, and functionality to normalize payment transaction data. The library is designed to be extended by payment providers through abstraction layers.

## Development Commands

### Testing
```bash
# Run all tests
vendor/bin/phpunit tests

# Run specific test suite
vendor/bin/phpunit tests/Unit

# Run tests with specific seed (for reproducing random failures)
vendor/bin/phpunit tests --random-order-seed=12345

# Run a single test file
vendor/bin/phpunit tests/Unit/Models/Transactions/AbstractTransactionTest.php
```

### Code Quality
```bash
# Run PHPStan static analysis
vendor/bin/phpstan analyse

# Run PHP CodeSniffer (PHP 7.4+ compatibility check)
vendor/bin/phpcs

# Fix PHP CodeSniffer issues automatically
vendor/bin/phpcbf
```

### Dependencies
```bash
# Install dependencies
composer install

# Update this package in dependent projects
composer update godaddy/mwc-payments
```

## Architecture

### Core Abstractions

**Provider → Gateway → Transaction/Payment Method**

- **Providers** (`AbstractProvider`): Top-level payment provider implementations. Providers use traits to declare capabilities (e.g., `CanIssuePaymentsTrait`, `CanCreateCustomersTrait`)
- **Gateways** (`AbstractGateway`): Handle HTTP requests/responses to payment APIs. Broadcast `ProviderRequestEvent` and `ProviderResponseEvent` for monitoring
- **Transactions** (`AbstractTransaction`): Payment operations (authorization, capture, refund, void) with status tracking
- **Payment Methods**: Cards (`CardPaymentMethod`) and bank accounts (`BankAccountPaymentMethod`) with brand/type classification

### Event System

All transaction and payment method operations broadcast events through `GoDaddy\WordPress\MWC\Common\Events\Events`:
- `PaymentTransactionEvent`, `CaptureTransactionEvent`, `RefundTransactionEvent`, `VoidTransactionEvent`
- `CreatePaymentMethodEvent`
- `ProviderRequestEvent`, `ProviderResponseEvent`

### Adapter Pattern

WooCommerce integration uses adapters in `DataSources/WooCommerce/Adapters/`:
- `CardPaymentMethodAdapter`: WooCommerce payment token ↔ `CardPaymentMethod`
- `BankAccountPaymentMethodAdapter`: WooCommerce payment token ↔ `BankAccountPaymentMethod`
- `CustomerAdapter`: WooCommerce customer ↔ `Customer` model

Gateways use `DataSourceAdapterContract` for bidirectional transformation via `convertFromSource()` and `convertToSource()`.

### Trait-Based Capabilities

Providers compose capabilities through traits:
- **CRUD operations**: `CanCreate*Trait`, `CanGet*Trait`, `CanUpdate*Trait`, `CanDelete*Trait`
- **Transaction types**: `CanIssuePaymentsTrait`, `CanIssueCapturesTrait`, `CanIssueRefundsTrait`, `CanIssueVoidsTrait`
- **Adapters**: `AdaptsCustomersTrait`, `AdaptsPaymentMethodsTrait`, `AdaptsRequestsTrait`

## Key Patterns

### Extending for New Providers

1. Create provider class extending `AbstractProvider`
2. Add capability traits for supported operations
3. Implement gateway extending `AbstractGateway` for API communication
4. Create adapter classes for data transformation
5. Register provider in configuration: `Configuration::get('payments.providers')`

### Transaction Flow

1. Transaction created (e.g., `PaymentTransaction`, `CaptureTransaction`)
2. Gateway issues request via `doAdaptedRequest()` with adapter
3. `ProviderRequestEvent` broadcast before HTTP request
4. Response received, `ProviderResponseEvent` broadcast
5. Transaction status updated (Approved/Declined/Held/Pending)
6. Transaction event broadcast (e.g., `PaymentTransactionEvent`)

### Status Objects

Use typed status objects implementing contracts:
- **Transactions**: `ApprovedTransactionStatus`, `DeclinedTransactionStatus`, `HeldTransactionStatus`, `PendingTransactionStatus`
- **Orders**: `CompletedOrderStatus`, `CancelledOrderStatus`, `FailedOrderStatus`, etc.

## Testing

- Uses PHPUnit 9.x with WP_Mock for WordPress function mocking
- Tests execute in random order by default (helps catch test interdependencies)
- Strict mode enabled: `forceCoversAnnotation`, `failOnRisky`, `failOnWarning`
- Bootstrap file: `tests/bootstrap.php` loads WP_Mock with Patchwork
- Test naming: `*Test.php` suffix required

## Dependencies

- PHP 7.4+ (platform locked to 7.4 for compatibility)
- `godaddy/mwc-common` (^18.0.0): Shared MWC utilities, models, HTTP client
- `godaddy/mwc-tests` (dev): Testing utilities and helpers
- WordPress and WooCommerce stubs loaded in PHPStan for static analysis

## Versioning

This package uses `dev-main` branch without tagged releases. Dependent projects reference the latest main branch. To update: `composer update godaddy/mwc-payments` (do not update other packages).
