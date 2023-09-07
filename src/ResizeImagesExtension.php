<?php
    namespace TheLogicStudio\ResizeImages;

    use SilverStripe\Core\Config\Configurable;
    use SilverStripe\ORM\DataExtension;
    use SilverStripe\Assets\Image;

    class ResizeImages extends DataExtension {
        use Configurable;

        public function onAfterUpload() {
            /** @var Image $image */
            $image = $this->owner;

            $width = $this->config()->get('maximum_width');
            $height = $this->config()->get('maximum_height');

            if(
                (!$width || $image->getWidth() <= $width) &&
                (!$height || $image->getHeight() <= $height)
            ) return;


            $src = tempnam(sys_get_temp_dir(), 'resize');
            $dst = tempnam(sys_get_temp_dir(), 'resize');

            $size = $width.'x'.$height.'>';

            file_put_contents($src, $image->getString());
            exec('convert '.escapeshellarg($src). ' -resize '.escapeshellarg($size).' '.escapeshellarg($dst));
            if(file_exists($dst)) {
                $image->setFromLocalFile($dst, $image->getFilename());
                unlink($dst);
            }
            unlink($src);
        }
    }
