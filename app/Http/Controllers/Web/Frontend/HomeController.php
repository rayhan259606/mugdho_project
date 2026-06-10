<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\CacheEnum;
use App\Enums\PageEnum;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Post;
use App\Models\Product;
use App\Models\SocialLink;
use Modules\Portfolio\Models\Project;
use Modules\Portfolio\Models\Type;
use App\Traits\CMSData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use CMSData;
    
    public $theme;

    public function __construct()
    {
        $this->theme = env('THEME', 'simple');
    }
    
    public function index(Request $request)
    {
        //CMS Data
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = [
            'home' => $cmsData->where('page', PageEnum::HOME),
            'common' => $cmsData->where('page', PageEnum::COMMON),
        ];

        $posts = Post::with(['category', 'user'])->where('status', 'active')->latest()->take(3)->get();
        $socials = SocialLink::where('status', 'active')->get();
        $types = Type::where('status', 'active')->get();
        $projects = Project::where('status', 'active')->get();

        $banners = \App\Models\Banner::where('status', 'active')->latest()->get();
        
        $query = Product::with(['category', 'user'])->where('status', 'active');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                if ($request->category == 'gadget') {
                    $q->whereIn('slug', ['gadget', 'gadgets']);
                } elseif ($request->category == 'digital') {
                    $q->whereIn('slug', ['digital', 'digital-products', 'digitals']);
                } elseif ($request->category == 'antique') {
                    $q->whereIn('slug', ['antique', 'antiques', 'antique-collection']);
                } else {
                    $q->where('slug', $request->category);
                }
            });
        }

        $products = $query->latest()->take(50)->get();
        $faqs = \App\Models\FAQ::where('status', 'active')->latest()->get();

        $posters = \App\Models\HomeMedia::where('type', 'poster')->where('status', 'active')->latest()->take(2)->get();
        $videos = \App\Models\HomeMedia::where('type', 'video')->where('status', 'active')->latest()->take(2)->get();

        return view("frontend.{$this->theme}.layouts.home.index", compact('cms', 'posts', 'types', 'projects', 'products', 'socials', 'banners', 'faqs', 'posters', 'videos'));
    }

    public function posts()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $posts = Post::where('status', 'active')->latest()->get();
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.posts", compact('cms', 'posts', 'socials'));
    }

    public function post($slug)
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $post = Post::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.post_details", compact('cms', 'post', 'socials'));
    }

    public function product($slug)
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = [
            'home' => $cmsData->where('page', PageEnum::HOME),
            'common' => $cmsData->where('page', PageEnum::COMMON),
        ];

        $product = Product::with(['category', 'user'])->where('slug', $slug)->where('status', 'active')->firstOrFail();
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.product_details", compact('cms', 'product', 'socials'));
    }

    public function course($id)
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = [
            'home' => $cmsData->where('page', PageEnum::HOME),
            'common' => $cmsData->where('page', PageEnum::COMMON),
        ];

        $course = \App\Models\Course::with('curricula')->findOrFail($id);
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.course_details", compact('cms', 'course', 'socials'));
    }

    public function service($id)
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = [
            'home' => $cmsData->where('page', PageEnum::HOME),
            'common' => $cmsData->where('page', PageEnum::COMMON),
        ];

        $service = \App\Models\Service::findOrFail($id);
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.service_details", compact('cms', 'service', 'socials'));
    }

    public function msmCourse()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $courses = \App\Models\Course::where('status', 'active')->latest()->get();
        $featured_course = $courses->first();
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.msm_course", compact('cms', 'courses', 'featured_course', 'socials'));
    }

    public function gadgets()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $products = Product::whereHas('category', function($q) { 
            $q->whereIn('slug', ['gadget', 'gadgets']); 
        })->latest()->get();
        $title = 'Gadgets Collection';
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.products", compact('cms', 'products', 'title', 'socials'));
    }

    public function digital()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $products = Product::whereHas('category', function($q) { 
            $q->whereIn('slug', ['digital', 'digital-products', 'digitals']); 
        })->latest()->get();
        $title = 'Digital Products';
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.products", compact('cms', 'products', 'title', 'socials'));
    }

    public function antique()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $products = Product::whereHas('category', function($q) { 
            $q->whereIn('slug', ['antique', 'antiques', 'antique-collection']); 
        })->latest()->get();
        $title = 'Antique Collection';
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.products", compact('cms', 'products', 'title', 'socials'));
    }

    public function services()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $services = \App\Models\Service::where('status', 'active')->latest()->get();
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.services", compact('cms', 'services', 'socials'));
    }
}
