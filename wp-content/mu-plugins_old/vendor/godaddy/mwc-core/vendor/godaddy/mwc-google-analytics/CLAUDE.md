# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

MWC Google Analytics - WordPress/WooCommerce Google Analytics integration module. Adapted from the WooCommerce Google Analytics Pro plugin as an MWC (Managed WooCommerce) module imported via Composer. Supports both Google Analytics 4 (GA4) and Universal Analytics (UA, deprecated).

## Development Commands

### Code Quality
```bash
# Run PHP CodeSniffer
composer phpcs

# Run phpcs on changed files only (diff from origin/master)
composer phpcs-diff
```

### Testing
No automated test suite is configured. Tests directory structure exists but tests are managed externally (Codeception suites).

### Dependencies
```bash
# Install dependencies
composer install

# Update framework (runs post-package-update hook)
composer update skyverge/wc-plugin-framework
```

## Architecture

### Core Structure

**Namespace**: `GoDaddy\WordPress\MWC\GoogleAnalytics`

**Main Classes**:
- `Plugin` (src/Plugin.php:40) - Main plugin singleton, extends SkyVerge framework `SV_WC_Plugin`
- `Integration` (src/Integration.php:41) - WooCommerce integration settings handler, extends `WC_Integration`
- `Tracking` (src/Tracking.php:37) - Tracking orchestration, coordinates Event/Email/Frontend tracking
- `Properties_Handler` (src/Properties_Handler.php) - Manages GA4/UA property configuration and data streams
- `API_Client` (src/API/API_Client.php) - Google API client for Admin API, Management API, and Measurement Protocol

### Initialization Flow

1. Plugin loads via Composer autoload (PSR-4: `GoDaddy\WordPress\MWC\GoogleAnalytics\` → `src/`)
2. `Plugin::__construct()` hooks into `after_setup_theme` (priority 0) instead of standard `plugins_loaded` (priority 15)
3. `setup_handlers()` instantiates tracking and API handlers
4. Integration registered via `woocommerce_integrations` filter
5. If WooCommerce Subscriptions active, loads `Subscriptions_Integration`

### Tracking System

**Event Architecture**:
- GA4 events: `src/Tracking/Events/GA4/*.php` (extend `GA4_Event`)
- UA events: `src/Tracking/Events/Universal_Analytics/*.php` (extend `Universal_Analytics_Event`)
- Subscription events: `src/Integrations/Subscriptions/Events/` (GA4 & UA variants)

**Event Contracts**:
- `Tracking_Event` - Base event interface
- `Deferred_Event` - Events tracked later (e.g., server-side)
- `Deferred_AJAX_Event` - Events tracked via AJAX

**Data Adapters** (src/Tracking/Adapters/):
Transform WooCommerce objects to GA event data structures (Cart, Order, Product items)

### Google APIs Integration

**Admin API** (`src/API/Admin_API.php`):
- Manages GA4 properties, data streams, measurement protocol secrets
- Creates/retrieves data streams for GA4 setup
- Handles API authentication and user data collection acknowledgement

**Management API** (`src/API/Management_API/`):
- Manages UA properties (deprecated)
- Account summaries and profiles

**Measurement Protocol API**:
- GA4: `src/API/Measurement_Protocol_API.php`
- UA: `src/API/Universal_Analytics/Measurement_Protocol_API.php`

**Authentication** (`src/API/Auth.php`):
OAuth 2.0 flow for Google API access (read & edit scopes)

### Key Helpers

- `Identity_Helper` (src/Helpers/Identity_Helper.php) - User identity tracking (Client ID, User ID)
- `Order_Helper` (src/Helpers/Order_Helper.php) - Order data extraction for events
- `Product_Helper` (src/Helpers/Product_Helper.php) - Product data formatting

## Important Patterns

### WooCommerce Framework Dependency
Built on `skyverge/wc-plugin-framework` v5.15.11. Framework classes aliased as `Framework\*`.

### Settings Management
Integration settings via `Integration::init_form_fields()`. Dynamic field generation for GA4/UA events with customizable event names.

### MWC-Specific Behavior
- `Plugin::handle_features_compatibility()` is no-op (MWC-16720) - bundled plugins don't declare Woo compatibility
- GA4 data streams auto-created with name "Managed WooCommerce Google Analytics"
- API secrets auto-generated during property setup

### Event Name Customization
Events stored in settings with pattern `{event_id}_event_name`. GA4 recommended events warn if names deviate from Google standards.

## Configuration Files

- **phpcs.xml** - SkyVerge PHP coding standards (excludes i18n, lib, vendor, woo-includes)
- **composer.json** - Platform PHP 7.4, supports PHP 7.4-8.3
- **.env.lumiere.dist** - Lumiere testing environment template

## Key Constants

- `Plugin::VERSION` - Current version: 3.0.6
- `Plugin::PLUGIN_ID` - 'google_analytics_pro'
- `Integration::DATA_STREAM_NAME` - "Managed WooCommerce Google Analytics"
- `Integration::API_SECRET_NAME` - "Managed WooCommerce Google Analytics"

## Common Tasks

### Adding GA4 Event
1. Create event class in `src/Tracking/Events/GA4/`
2. Extend `GA4_Event`, implement `get_form_field()` and event logic
3. Register in `Event_Tracking::__construct()`
4. Add adapter if custom data structure needed

### Modifying Settings
1. Edit `Integration::get_tracking_settings_fields()` or `get_event_name_fields()`
2. Handle in `Integration::filter_admin_options()` if transformation needed
3. Admin JS/CSS in `assets/js/admin/` and `assets/css/admin/`

### API Integration Changes
1. Request/Response classes in `src/API/{API_Name}/`
2. Extend framework base API classes
3. Update `API_Client` factory methods
