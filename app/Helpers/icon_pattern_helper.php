<?php

/**
 * @author Puji Ermanto <pujiermanto@gmail.com>
 * @license MIT License
 * @link
 * @return void
 */
function iconToBackground(string $iconName): string
{
    $iconPath = FCPATH . "assets/icons/{$iconName}.svg";
    if (!file_exists($iconPath)) {
        return '';
    }

    $svgContent = file_get_contents($iconPath);
    // Minimal cleanup (hapus newlines, spasi berlebih)
    $svgContent = trim(preg_replace('/\s+/', ' ', $svgContent));
    $encodedSvg = rawurlencode($svgContent);

    return "url('data:image/svg+xml,{$encodedSvg}')";
}
