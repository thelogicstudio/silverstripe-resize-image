# Silverstripe Image Maximum Size

This package implements a maximum image upload size. If uploaded images are larger than the defined dimensions, the original will be reduced in size. By default this limits to 2000px in either dimension.

## Prerequisites

This uses the command line ImageMagick `convert` command. If that isn't available to PHP's `exec()` function, this extension will not work.

## Usage

```
> composer require thelogicstudio/silverstripe-resize-image
```

## Configuration

Configuration can be updated in your assets.yml (or any config file). To change your maximum dimensions to 1000px: 

```
TheLogicStudio\ResizeImages\ResizeImages:
  maximum_width: 1000
  maximum_height: 1000
```
