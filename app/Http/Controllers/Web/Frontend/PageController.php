<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public $theme;

    public function __construct()
    {
        $this->theme = env('THEME', 'simple');
    }
    
    public function index($slug)
    {
        $cmsData = \App\Models\CMS::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', \App\Enums\PageEnum::HOME), 'common' => $cmsData->where('page', \App\Enums\PageEnum::COMMON)];
        $page = Page::where('slug', $slug)->firstOrFail();
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.page", compact('page', 'socials', 'cms'));
    }
}
