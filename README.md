# SilverStripe Image Extension

Provides the ability to extend images in SilverStripe

## Installation (with composer)

	$ composer require heyday/silverstripe-imageextension

## Usage

```php
class CustomImageExtension extends \Heyday\SilverStripe\ImageExtension
{
    public function generateTwoColumn(Image_Backend $backend)
    {
        $backend->resizeByWidth(300);
        return $backend;
    }
}
```