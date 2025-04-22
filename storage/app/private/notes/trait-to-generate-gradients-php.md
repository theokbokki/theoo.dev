I needed a way to generate small 32x32 default profile pictures for my users and did not want to rely on external APIs. So I built this small class which generates a SVG with some filters to create a nice gradient.  
It works very well for small square images, but when I've tried to generate large wallpapers with it, it did not work quite so well. I might update the code in the future if I need to.  
I should try to explore some of the methods mentioned in <a href="https://justinjay.wang/methods-for-random-gradients/" target="_blank">this article</a> to make it better.


```php
<?php

namespace App\Concerns;

trait GeneratesGradient
{
    protected int $width;

    protected int $height;

    protected int $buffer = 5;

    protected bool $isHorizontal;

    protected float $splitThreshold;

    public function generateGradient(int $width = 32, int $height = 32): string
    {
        $this->width = $width;
        $this->height = $height;
        $this->isHorizontal = $width > $height;
        $this->splitThreshold = $this->isHorizontal ? $width / 2 : $height / 2;

        $colorCount = random_int(3, 5);
        $colorStops = $this->generateColorStops($colorCount);
        $circlePositions = $this->generateCirclePositions($colorCount);

        return $this->buildSvg($colorStops, $circlePositions);
    }

    private function generateColorStops(int $count): array
    {
        return array_map(
            fn () => $this->generateVibrantColor(),
            array_fill(0, $count, null)
        );
    }

    private function generateVibrantColor(): string
    {
        return $this->convertHslToHex(
            random_int(0, 360),    // hue
            random_int(70, 100),   // saturation
            random_int(40, 60)     // lightness
        );
    }

    private function convertHslToHex(float $hue, float $saturation, float $lightness): string
    {
        $hue /= 360;
        $saturation /= 100;
        $lightness /= 100;

        $chroma = $lightness < 0.5
            ? $lightness * (1 + $saturation)
            : $lightness + $saturation - $lightness * $saturation;

        $base = 2 * $lightness - $chroma;

        return $this->convertRgbToHex(
            $this->calculateRgbComponent($base, $chroma, $hue + 1 / 3),
            $this->calculateRgbComponent($base, $chroma, $hue),
            $this->calculateRgbComponent($base, $chroma, $hue - 1 / 3)
        );
    }

    private function calculateRgbComponent(float $base, float $chroma, float $hue): float
    {
        $hue = $this->normalizeHue($hue);

        if ($hue < 1 / 6) {
            return $base + ($chroma - $base) * 6 * $hue;
        }

        if ($hue < 1 / 2) {
            return $chroma;
        }

        if ($hue < 2 / 3) {
            return $base + ($chroma - $base) * (2 / 3 - $hue) * 6;
        }

        return $base;
    }

    private function normalizeHue(float $hue): float
    {
        return match (true) {
            $hue < 0 => $hue + 1,
            $hue > 1 => $hue - 1,
            default => $hue
        };
    }

    private function convertRgbToHex(float $red, float $green, float $blue): string
    {
        return sprintf('#%02X%02X%02X',
            round($red * 255),
            round($green * 255),
            round($blue * 255)
        );
    }

    private function generateCirclePositions(int $count): array
    {
        $positions = [];

        for ($i = 0; $i < $count; $i++) {
            $positions[] = match ($i) {
                0 => $this->generateFirstAnchorPoint(),
                1 => $this->generateSecondAnchorPoint(),
                default => $this->generateRandomPosition()
            };
        }

        return $positions;
    }

    private function generateFirstAnchorPoint(): array
    {
        if ($this->isHorizontal) {
            return $this->createPosition(
                random_int($this->buffer, $this->splitThreshold - $this->buffer),
                random_int($this->buffer, $this->height - $this->buffer)
            );
        }

        return $this->createPosition(
            random_int($this->buffer, $this->width - $this->buffer),
            random_int($this->buffer, $this->splitThreshold - $this->buffer)
        );
    }

    private function generateSecondAnchorPoint(): array
    {
        if ($this->isHorizontal) {
            return $this->createPosition(
                random_int($this->splitThreshold + $this->buffer, $this->width - $this->buffer),
                random_int($this->buffer, $this->height - $this->buffer)
            );
        }

        return $this->createPosition(
            random_int($this->buffer, $this->width - $this->buffer),
            random_int($this->splitThreshold + $this->buffer, $this->height - $this->buffer)
        );
    }

    private function generateRandomPosition(): array
    {
        return $this->createPosition(
            random_int($this->buffer, $this->width - $this->buffer),
            random_int($this->buffer, $this->height - $this->buffer)
        );
    }

    private function createPosition(int $x, int $y): array
    {
        return [
            'x' => $x,
            'y' => $y,
            'radius' => $this->width / random_int(2, 4),
        ];
    }

    private function buildSvg(array $colorStops, array $circlePositions): string
    {
       $blurRadius = $this->width / 4;

        return <<<SVG
        <svg xmlns="http://www.w3.org/2000/svg"
             width="{$this->width}" height="{$this->height}" viewBox="0 0 {$this->width} {$this->height}">
            <defs>
                <filter id="blur" x="-50%" y="-50%" width="200%" height="200%">
                    <feGaussianBlur stdDeviation="{$blurRadius}"/>
                </filter>
            </defs>
            <rect width="100%" height="100%" fill="{$colorStops[0]}" opacity="0.15"/>
            <g filter="url(#blur)" opacity="0.85">
                {$this->generateCircleElements($circlePositions, $colorStops)}
            </g>
        </svg>
        SVG;
    }

    private function generateCircleElements(array $positions, array $colors): string
    {
        return implode('', array_map(
            fn ($pos, $color) => sprintf(
                '<circle cx="%d" cy="%d" r="%s" fill="%s"/>',
                $pos['x'],
                $pos['y'],
                $pos['radius'],
                $color
            ),
            $positions,
            $colors
        ));
    }
}
```
