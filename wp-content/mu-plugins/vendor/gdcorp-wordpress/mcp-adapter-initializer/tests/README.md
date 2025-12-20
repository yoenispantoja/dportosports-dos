# MCP Adapter Initializer Tests

This directory contains unit tests for the MCP Adapter Initializer WordPress plugin using [BrainMonkey](https://brain-wp.github.io/BrainMonkey/) and PHPUnit.

## About BrainMonkey

BrainMonkey is a testing utility for WordPress plugins and themes. It allows you to:
- Mock WordPress functions without needing a full WordPress installation
- Test WordPress hooks (actions and filters)
- Use PHPUnit for unit testing WordPress code in isolation

## Prerequisites

- PHP 7.4 or higher
- Composer

## Installation

Install the test dependencies:

```bash
composer install
```

## Running Tests

### Run all tests

```bash
composer test
```

Or directly with PHPUnit:

```bash
./vendor/bin/phpunit
```

### Run specific test file

```bash
./vendor/bin/phpunit tests/test-mcp-adapter-initializer.php
```

### Run with coverage report

```bash
composer test:coverage
```

This generates an HTML coverage report in the `coverage/` directory.

## Test Structure

```
tests/
├── bootstrap.php                   # Test bootstrap file
├── TestCase.php                    # Base test case with common helpers
├── test-mcp-adapter-initializer.php # Main plugin tests
├── tools/
│   └── test-site-info-tool.php    # Example tool test
└── README.md                       # This file
```

## Writing Tests

### Basic Test Structure

```php
<?php
namespace GD\MCP\Tests;

use Brain\Monkey\Functions;

class My_Test extends TestCase {

    public function test_something() {
        // Mock WordPress functions
        Functions\when( 'get_option' )->justReturn( 'value' );
        
        // Your test code here
        $this->assertTrue( true );
    }
}
```

### Using the Base TestCase

The `TestCase` class provides helpful methods:

- `mockWpError()` - Create a WP_Error mock
- `mockWpPost()` - Create a WP_Post mock
- `mockWpUser()` - Create a WP_User mock
- `mockRestRequest()` - Create a WP_REST_Request mock
- `mockRestResponse()` - Create a WP_REST_Response mock

### Mocking WordPress Functions

```php
// Simple return value
Functions\when( 'get_option' )->justReturn( 'value' );

// Return argument
Functions\when( 'esc_html' )->returnArg();

// Expect function to be called
Functions\expect( 'wp_insert_post' )
    ->once()
    ->with( Mockery::type( 'array' ) )
    ->andReturn( 123 );
```

### Testing Hooks

```php
// Test that an action was added
Actions\expectAdded( 'init' )
    ->once()
    ->with( [ $instance, 'callback' ], 10, 1 );

// Test that a filter was added
Filters\expectAdded( 'the_content' )
    ->once()
    ->with( [ $instance, 'filter_callback' ] );
```

## Test Coverage

Current test coverage focuses on:

- ✅ Singleton pattern implementation
- ✅ Plugin initialization
- ✅ Hook registration
- ✅ MCP server creation and duplicate prevention
- ✅ Authentication flow
- ✅ Endpoint management
- ✅ Tool registration (example: Site Info Tool)

## Continuous Integration

Tests can be integrated into CI/CD pipelines:

```yaml
# Example GitHub Actions workflow
- name: Run tests
  run: composer test
```

## Troubleshooting

### Autoload Issues

If you encounter autoload errors, regenerate the autoloader:

```bash
composer dump-autoload
```

### Mock Not Working

Make sure you're using `Functions\when()` or `Functions\expect()` before the code that calls the WordPress function.

### Class Not Found

Ensure all required files are loaded in the test or bootstrap file.

## Resources

- [BrainMonkey Documentation](https://giuseppe-mazzapica.gitbook.io/brain-monkey/)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Mockery Documentation](http://docs.mockery.io/en/latest/)

## Contributing

When adding new features, please:

1. Write tests for new functionality
2. Ensure all tests pass
3. Aim for high code coverage
4. Follow WordPress coding standards

