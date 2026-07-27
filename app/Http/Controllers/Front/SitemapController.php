<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Photography;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for search engine indexing.
     */
    public function index(): Response
    {
        $photographies = Photography::latest()->get();

        $xml = view('front.sitemap', compact('photographies'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }

    /**
     * Generate dynamic robots.txt file.
     */
    public function robots(): Response
    {
        $sitemapUrl = url('/sitemap.xml');

        $content = "User-agent: *\n"
            . "Allow: /\n"
            . "Disallow: /admin/\n"
            . "Disallow: /login\n"
            . "Disallow: /register\n\n"
            . "Sitemap: {$sitemapUrl}\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
