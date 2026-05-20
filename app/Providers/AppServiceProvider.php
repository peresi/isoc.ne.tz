<?php

namespace App\Providers;

use App\Models\CmsPage;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.site', function ($view): void {
            $navigationPages = collect();
            $siteLogoUrl = null;

            if (Schema::hasTable('cms_pages')) {
                $navigationPages = CmsPage::query()->navigation()->get();
            }

            if (Schema::hasTable('site_settings')) {
                $logoPath = SiteSetting::getValue('site_logo_path');
                if ($logoPath) {
                    $siteLogoUrl = asset('storage/'.$logoPath);
                }
            }

            // Fallback to a public folder logo if no site setting is configured.
            if (!$siteLogoUrl) {
                if (file_exists(public_path('logo.webp'))) {
                    $siteLogoUrl = asset('logo.webp');
                } elseif (file_exists(public_path('logo.png'))) {
                    $siteLogoUrl = asset('logo.png');
                } elseif (file_exists(public_path('logo.jpg'))) {
                    $siteLogoUrl = asset('logo.jpg');
                } elseif (file_exists(public_path('logo.jpeg'))) {
                    $siteLogoUrl = asset('logo.jpeg');
                } elseif (file_exists(public_path('images/logo.webp'))) {
                    $siteLogoUrl = asset('images/logo.webp');
                } elseif (file_exists(public_path('images/logo.png'))) {
                    $siteLogoUrl = asset('images/logo.png');
                } elseif (file_exists(public_path('images/logo.jpg'))) {
                    $siteLogoUrl = asset('images/logo.jpg');
                } elseif (file_exists(public_path('images/logo.jpeg'))) {
                    $siteLogoUrl = asset('images/logo.jpeg');
                }
            }

            $view->with('navigationPages', $navigationPages);
            $view->with('siteLogoUrl', $siteLogoUrl);
        });
    }
}
