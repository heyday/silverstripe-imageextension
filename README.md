# SilverStripe Image Extension

Provides the ability to extend images in SilverStripe

## The problem

Providing custom image formatting was in the past thought to be easy. We would just extend `Image` and add our `generateX` functions there. We found over time however that this caused some major issues for clients, issues where images associated with certain pages, both added through `Content` and also associated via `has_X` would suddenly disappear. The underlying reason for this was a change of `ClassName` in the database record when the same image would be used somewhere else in the CMS (for example usage in TinyMce).

Our next option was to create a `DataObjectDecorator` or `DataExtension` and add the `generateX` methods there, but this had a annoyance of its own.

To achieve this you had to do something like the following:

```
class CustomImage extends DataExtension
{
    public function MyCustomFormat()
    {
        return $this->owner->getFormattedImage('MyCustomFormat');
    }

    public function generateMyCustomFormat(Image_Backend $backend)
    {
        return $backend->fittedResize(80, 110);
    }
}
```

Notice the need to define `MyCustomFormat` as well as `generateMyCustomFormat`. This gets kinda ugly when you have many formatting functions. Not nice.

## The solution

To avoid this, you can now use `heyday/silverstripe-imageextension`. Which will allow you to simply define the `generateX` methods in your extension.


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

`mysite/_config/config.yml`

```yml
Image:
    extensions:
        - CustomImageExtension
```


##License

SilverStripe Image Extension is licensed under an [MIT license](http://heyday.mit-license.org/)
