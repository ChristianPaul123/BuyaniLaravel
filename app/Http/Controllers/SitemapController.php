<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        // Create a sitemap instance
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily'))
            ->add(Url::create('/user/consumer')->setPriority(1.0)->setChangeFrequency('daily'))
            ->add(Url::create('/user/consumer/about-us')->setPriority(0.8)->setChangeFrequency('weekly'))
            ->add(Url::create('/user/consumer/contacts')->setPriority(0.5)->setChangeFrequency('monthly'));

        // Save the sitemap to the public directory
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json(['message' => 'Sitemap generated successfully!']);
    }
}
