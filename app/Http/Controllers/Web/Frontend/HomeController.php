<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\CacheEnum;
use App\Enums\PageEnum;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Post;
use App\Models\Product;
use App\Models\AntiqueProduct;
use App\Models\DigitalProduct;
use App\Models\Gadget;
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

        // Search across all models if search is active
        $searchResults = collect();
        $searchQuery = $request->get('search');
        if ($request->filled('search')) {
            // Standard products
            $foundProducts = Product::where('status', 'active')
                ->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })->latest()->take(20)->get()->map(function($item) {
                    $item->search_type = 'Product';
                    $item->search_badge_color = 'bg-primary text-white';
                    $item->detail_url = route('product.details', $item->slug);
                    $item->display_image = $item->thumbnail;
                    $item->display_price = '৳' . number_format($item->price - $item->discount);
                    return $item;
                });

            // Gadgets
            $foundGadgets = Gadget::where('status', 'active')
                ->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })->latest()->take(20)->get()->map(function($item) {
                    $item->search_type = 'Gadget';
                    $item->search_badge_color = 'bg-success text-white';
                    $item->detail_url = route('product.details', $item->slug);
                    $item->display_image = $item->thumbnail;
                    $item->display_price = '৳' . number_format($item->price - $item->discount);
                    return $item;
                });

            // Digital products
            $foundDigitals = DigitalProduct::where('status', 'active')
                ->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })->latest()->take(20)->get()->map(function($item) {
                    $item->search_type = 'Digital';
                    $item->search_badge_color = 'bg-info text-white';
                    $item->detail_url = route('product.details', $item->slug);
                    $item->display_image = $item->thumbnail;
                    $item->display_price = '৳' . number_format($item->price - $item->discount);
                    return $item;
                });

            // Antique products
            $foundAntiques = AntiqueProduct::where('status', 'active')
                ->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })->latest()->take(20)->get()->map(function($item) {
                    $item->search_type = 'Antique';
                    $item->search_badge_color = 'bg-warning text-dark';
                    $item->detail_url = route('product.details', $item->slug);
                    $item->display_image = $item->thumbnail;
                    $item->display_price = '৳' . number_format($item->price - $item->discount);
                    return $item;
                });

            // Courses
            $foundCourses = \App\Models\Course::where('status', 'active')
                ->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })->latest()->take(20)->get()->map(function($item) {
                    $item->search_type = 'Course';
                    $item->search_badge_color = 'bg-indigo text-white';
                    $item->detail_url = route('course.details', $item->id);
                    $item->display_image = 'default/no image.webp';
                    $item->display_price = 'Premium Course';
                    return $item;
                });

            // Services
            $foundServices = \App\Models\Service::where('status', 'active')
                ->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })->latest()->take(20)->get()->map(function($item) {
                    $item->search_type = 'Service';
                    $item->search_badge_color = 'bg-secondary text-white';
                    $item->detail_url = route('service.details', $item->id);
                    $item->display_image = $item->image ?? 'default/no image.webp';
                    $item->display_price = 'Inquiry Only';
                    return $item;
                });

            // Merge everything
            $searchResults = $foundProducts->concat($foundGadgets)->concat($foundDigitals)->concat($foundAntiques)->concat($foundCourses)->concat($foundServices);
        }

        return view("frontend.{$this->theme}.layouts.home.index", compact('cms', 'posts', 'types', 'projects', 'products', 'socials', 'banners', 'faqs', 'posters', 'videos', 'searchResults', 'searchQuery'));
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

        $product = null;
        $module_type = null;

        // Search in each table until found
        if ($p = Product::with(['category', 'user'])->where('slug', $slug)->where('status', 'active')->first()) {
            $product = $p;
            $module_type = null; // standard product
        } elseif ($p = AntiqueProduct::where('slug', $slug)->where('status', 'active')->first()) {
            $product = $p;
            $module_type = 'antique';
        } elseif ($p = DigitalProduct::where('slug', $slug)->where('status', 'active')->first()) {
            $product = $p;
            $module_type = 'digital';
        } elseif ($p = Gadget::where('slug', $slug)->where('status', 'active')->first()) {
            $product = $p;
            $module_type = 'gadget';
        }

        if (!$product) {
            abort(404);
        }

        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.product_details", compact('cms', 'product', 'module_type', 'socials'));
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
        $faqs = \App\Models\MsmFaq::where('status', 'active')->latest()->get();
        return view("frontend.{$this->theme}.layouts.modules.msm_course", compact('cms', 'courses', 'featured_course', 'socials', 'faqs'));
    }

    public function gadgets()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $products = Gadget::where('status', 'active')->orderBy('position', 'asc')->orderBy('id', 'desc')->get();
        $pageCms = CMS::where('page', 'gadgets')->where('section', 'hero')->first();
        $title = $pageCms->title ?? 'Gadgets Collection';
        $module_type = 'gadget';
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.products", compact('cms', 'products', 'title', 'socials', 'pageCms', 'module_type'));
    }

    public function digital()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $products = DigitalProduct::where('status', 'active')->orderBy('position', 'asc')->orderBy('id', 'desc')->get();
        $pageCms = CMS::where('page', 'digital_products')->where('section', 'hero')->first();
        $title = $pageCms->title ?? 'Digital Products';
        $module_type = 'digital';
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.products", compact('cms', 'products', 'title', 'socials', 'pageCms', 'module_type'));
    }

    public function antique()
    {
        $cmsData = CMSData::all()->makeHidden(['created_at', 'updated_at']);
        $cms = ['home' => $cmsData->where('page', PageEnum::HOME), 'common' => $cmsData->where('page', PageEnum::COMMON)];
        $products = AntiqueProduct::where('status', 'active')->orderBy('position', 'asc')->orderBy('id', 'desc')->get();
        $pageCms = CMS::where('page', 'antique_collection')->where('section', 'hero')->first();
        $title = $pageCms->title ?? 'Antique Collection';
        $module_type = 'antique';
        $socials = \App\Models\SocialLink::where('status', 'active')->get();
        return view("frontend.{$this->theme}.layouts.modules.products", compact('cms', 'products', 'title', 'socials', 'pageCms', 'module_type'));
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
