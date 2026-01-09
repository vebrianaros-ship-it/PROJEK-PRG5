<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;

class CaptchaController extends Controller
{
    public function generate()
    {
        try {
            // Generate random captcha text
            $captcha_text = $this->generateRandomString(5);
            
            // Store in session
            Session::put('captcha', $captcha_text);
            
            // Always use SVG for now to debug
            return $this->generateTextCaptcha($captcha_text);
            
        } catch (\Exception $e) {
            // Return a simple error image if something goes wrong
            $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="120" height="40" xmlns="http://www.w3.org/2000/svg">
    <rect width="120" height="40" fill="#ffcccc" stroke="#ff0000"/>
    <text x="60" y="25" font-family="Arial, sans-serif" font-size="12" text-anchor="middle" fill="#ff0000">ERROR</text>
</svg>';
            
            return response($svg)
                ->header('Content-Type', 'image/svg+xml');
        }
    }
    
    private function generateImageCaptcha($captcha_text)
    {
        // Create image
        $image = imagecreate(120, 40);
        
        // Colors
        $bg_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $line_color = imagecolorallocate($image, 64, 64, 64);
        
        // Add some noise lines
        for ($i = 0; $i < 5; $i++) {
            imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
        }
        
        // Add text
        imagestring($image, 5, 25, 10, $captcha_text, $text_color);
        
        // Start output buffering
        ob_start();
        imagepng($image);
        $imageData = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        
        return response($imageData)
            ->header('Content-Type', 'image/png')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
    
    private function generateTextCaptcha($captcha_text)
    {
        // Create a simple SVG captcha
        $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg width="120" height="40" xmlns="http://www.w3.org/2000/svg">
    <rect width="120" height="40" fill="#f8f9fa" stroke="#dee2e6" stroke-width="1"/>
    <text x="60" y="25" font-family="Arial, sans-serif" font-size="16" font-weight="bold" text-anchor="middle" fill="#495057">' . $captcha_text . '</text>
    <line x1="10" y1="15" x2="110" y2="25" stroke="#adb5bd" stroke-width="1" opacity="0.5"/>
    <line x1="20" y1="30" x2="100" y2="10" stroke="#adb5bd" stroke-width="1" opacity="0.5"/>
    <circle cx="20" cy="20" r="2" fill="#6c757d" opacity="0.3"/>
    <circle cx="100" cy="15" r="2" fill="#6c757d" opacity="0.3"/>
    <circle cx="80" cy="30" r="2" fill="#6c757d" opacity="0.3"/>
</svg>';
        
        return response($svg)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
    
    private function generateRandomString($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public static function validate($input)
    {
        return strtoupper($input) === strtoupper(Session::get('captcha'));
    }
}