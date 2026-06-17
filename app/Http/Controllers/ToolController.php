<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $seoData = (object) [
            'meta_title' => 'Free Developer Tools — Sumit Kumar',
            'meta_description' => 'A collection of free, fast, and secure developer utilities including JSON Formatter, Base64 Encoder, and UUID Generator.',
            'og_title' => 'Developer Tools by Sumit Kumar',
            'og_description' => 'A collection of free, fast, and secure developer utilities.',
        ];
        return view('tools.index', compact('seoData'));
    }

    public function jsonFormatter()
    {
        $seoData = (object) [
            'meta_title' => 'Free JSON Formatter & Validator Online',
            'meta_description' => 'Format, beautify, and validate JSON online securely in your browser. Blazing fast tool by Sumit Kumar.',
            'og_title' => 'JSON Formatter & Validator',
            'og_description' => 'Format and validate JSON data instantly.',
        ];
        return view('tools.json-formatter', compact('seoData'));
    }

    public function base64()
    {
        $seoData = (object) [
            'meta_title' => 'Base64 Encoder and Decoder Online',
            'meta_description' => 'Encode strings to Base64 or decode Base64 strings instantly in your browser.',
            'og_title' => 'Base64 Encoder & Decoder',
            'og_description' => 'Fast and secure Base64 encode/decode tool.',
        ];
        return view('tools.base64', compact('seoData'));
    }

    public function uuidGenerator()
    {
        $seoData = (object) [
            'meta_title' => 'Free Online UUID / GUID Generator',
            'meta_description' => 'Generate secure random UUIDs (v4) online instantly. Perfect for database primary keys and testing.',
            'og_title' => 'Online UUID Generator',
            'og_description' => 'Generate random v4 UUIDs instantly.',
        ];
        return view('tools.uuid-generator', compact('seoData'));
    }
}
