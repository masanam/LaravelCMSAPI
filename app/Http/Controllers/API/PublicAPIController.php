<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Webcore\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Storage;
use Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\saveCareer;
use App\Mail\saveContact;
use App\Mail\saveInvestor;

use Str;

 /**
 * Class AchievementController
 * @package App\Http\Controllers\API
 */

class PublicAPIController extends AppBaseController
{

/**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/getMenu",
     *      summary="Get a listing of the Menus.",
     *      tags={"Public-API"},
     *      description="Get all Menus",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Menu")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */

    public function getMenu()
    {
        $menu_list = \App\Models\Menu::with('children')->get();
         
        if (empty($menu_list)) { 
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $menu_list
        ]);
    }

    public function getAllMenu()
    {

        $allmenu = \App\Models\AllMenu::orderby('orderid','asc')->get();
         
        if (empty($allmenu)) { 
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $allmenu
        ]);
    }

    public function getMenuDetail($link)
    {
        $menu_list = \App\Models\Menu::with('children')->where('link',$link)->get();
        
        if (empty($menu_list)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $menu_list
        ]);
    }

        public function menuTree($parent = 0, $level = 0)
        {
            $this->level = $this->level ?: $level;

            $menus =  \App\Models\Menu::where('parent_id', $parent)
                ->get()
                ->map(function ($menu, $key) {
                    return $this->menuItem($menu);
                });

            return $this->level ? $menus->toArray() : $menus->toJson();   
        }

        public function menuItem($item)
        {
            $data = [
                'name' => str_slug($item->title),
                'link' => $item->url,
            ];

            if ($this->level &&  \App\Models\Menu::where('parent_id', $item->id)->count()) {
                $data['child'] = $this->menuTree($item->id);
                $this->level--;
            }

            return $data;
        }

    
    public function getTypewithChild()
    {
        $type_list = \App\Models\Type::orderby('orderid','asc')->get(); 

        if (empty($type_list)) {
            return $this->sendError('Data not found');
        }

        foreach ($type_list as $row) {
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $type_list
        ]);
    }

    public function getBrandwithChild()
    {
        $brand_list = \App\Models\Brand::orderby('orderid','asc')->get();

        if (empty($brand_list)) {
            return $this->sendError('Data not found');
        }

        foreach ($brand_list as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            $row->kategori = $row->type->slug;
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $brand_list
        ]);
    }


    public function getSlider()
    {
        $slider = \App\Models\Slider::orderby('orderid','asc')->get();

        if (empty($slider)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $slider
        ]);
    }

    public function getHeader()
    {
        $header = \App\Models\Header::all();

        if (empty($header)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $header
        ]);
    }

    public function getCategory()
    {
        $category = \App\Models\Category::all();

        if (empty($category)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $category
        ]);
    }
    
    public function getTypes()
    {
        $types = \App\Models\Type::orderby('orderid','asc')->get();

        if (empty($types)) {
            return $this->sendError('Data not found');
        }


        foreach ($types as $row) {
            foreach ($row->brand as $item){
                $string = $item->content ;
                if (strlen($string) > 250) {
    
                    // truncate string
                    $stringCut = substr($string, 0, 250);
                    $endPoint = strrpos($stringCut, ' ');
    
                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    $string .= ' ...</p>';
                    foreach ($item->product as $prod){
                        $stringp = $prod->content ;
                        if (strlen($stringp) > 250) {
            
                            // truncate string
                            $stringCut = substr($stringp, 0, 250);
                            $endPoint = strrpos($stringCut, ' ');
            
                            //if the string doesn't contain any space then it will cut without word basis.
                            $stringp = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $stringp .= ' ...</p>';
                        }   
                        $prod->content = $prod->content ;
                        $prod->summary = $stringp ;
                        $prod->title = $prod->title ;
                    }    

                }

                if (strpos($item->title, '&') !== false) {
                    $slug = preg_replace("/[&]/", "n", $item->title);
                } else{
                    $slug = $item->title;
                }
                $item->slug = Str::slug($slug, '-');
                
                $item->summary = $string ;
                $item->title = $item->title ;
                $item->content = $item->content ;
                $item->tagline = $item->tagline ;

            }
        }

        return response()->json([
            'data' => $types
        ]);
    }



    public function getStatus()
    {
        $status = \App\Models\Status::all();

        if (empty($status)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $status
        ]);
    }

    public function getManagement()
    {
        $management = \App\Models\Management::all();

        if (empty($management)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $management
        ]);
    }

    public function getJenis()
    {
        $jenis = \App\Models\Jenis::all();

        if (empty($jenis)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $jenis
        ]);
    }

    public function getSection()
    {
        $section = \App\Models\Section::all();

        if (empty($section)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $section
        ]);
    }


    public function getAboutKino()
    {
        $aboutkino = \App\Models\Section::where('slug','about-kino')->get();

        if (empty($aboutkino)) {
            return $this->sendError('Data not found');
        }

        foreach ($aboutkino as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }


        return response()->json([
            'data' => $aboutkino
        ]);
    }
    public function getOurValue()
    {
        $ourvalue = \App\Models\Section::where('type','2')->orderby('orderid','asc')->get();

        if (empty($ourvalue)) {
            return $this->sendError('Data not found');
        }

        foreach ($ourvalue as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                // truncate string
                $stringCut = substr($string, 0, 300);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                 $string .= ' ...</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $ourvalue
        ]);
    }

    public function getTermCondition()
    {
        $condition = \App\Models\Section::where('slug','terms-condition')->get();

        if (empty($condition)) {
            return $this->sendError('Data not found');
        }

        foreach ($condition as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }
        return response()->json([
            'data' => $condition
        ]);
    }

    public function getPrivacy()
    {
        $privacy = \App\Models\Section::where('slug','privacy')->get();

        if (empty($privacy)) {
            return $this->sendError('Data not found');
        }

        foreach ($privacy as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $privacy
        ]);
    }

    public function getCodeofConduct()
    {
        $code = \App\Models\Section::where('slug','code-of-conduct')->get();

        if (empty($code)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $code
        ]);
    }

    public function getGroup()
    {
        $group = \App\Models\Group::orderby('orderid','asc')->get();

        if (empty($group)) {
            return $this->sendError('Data not found');
        }

        foreach ($group as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $group
        ]);
    }

    
    public function getPrologCorporate()
    {
        $prolog_corporate = \App\Models\Section::where('slug','corporate')->get();

        if (empty($prolog_corporate)) {
            return $this->sendError('Data not found');
        }

        foreach ($prolog_corporate as $row) {
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $prolog_corporate
        ]);
    }

    public function getPrologBrand()
    {
        $prolog_brand = \App\Models\Section::where('slug','brand')->get();

        if (empty($prolog_brand)) {
            return $this->sendError('Data not found');
        }

        foreach ($prolog_brand as $row) {
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $prolog_brand
        ]);
    }


    public function getAchievementCorporate()
    {
        $achievement_corporate = \App\Models\Achievement::where('type',1)->orderby('id','desc')->get();
        $prolog_corporate = \App\Models\Section::where('slug','corporate')->get();

        if (empty($achievement_corporate)) {
            return $this->sendError('Data not found');
        }

        foreach ($achievement_corporate as $item) {
            
            if (strpos($item->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $item->title);
            } else{
                $slug = $item->title;
            }
            $item->seotitle = Str::slug($slug, '-');  
        }

        return response()->json([
            'prolog'=> $prolog_corporate,
            'data' => $achievement_corporate
        ]);

    }

    public function getAchievementBrand()
    {
        $achievement_brand = \App\Models\Achievement::where('type',2)->orderby('id','desc')->get();
        $prolog_brand = \App\Models\Section::where('slug','brand')->get();

        if (empty($achievement_brand)) {
            return $this->sendError('Data not found');
        }

        foreach ($achievement_brand as $item) {
            
            if (strpos($item->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $item->title);
            } else{
                $slug = $item->title;
            }
            $item->seotitle = Str::slug($slug, '-');

        }

        return response()->json([
            'prolog'=> $prolog_brand,
            'data' => $achievement_brand
        ]);
    }

    public function getGroupDetail($seotitle)
    {
        $group_detail = \App\Models\Group::where('seotitle',$seotitle)->get();

        if (empty($group_detail)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $group_detail
        ]);
    }

    public function getAchievementDetail($seotitle)
    {
        $achievement_detail = \App\Models\Achievement::where('seotitle',$seotitle)->get();

        if (empty($achievement_detail)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $achievement_detail
        ]);
    }

    public function getOrganizationData()
    {
        $Organisation = \App\Models\Director::with('category')->orderby('category_id','asc')->get();

        if (empty($Organisation)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $Organisation
        ]);
    }

    public function getDirector()
    {
        $director = \App\Models\Director::with('category')->where('category_id','1')->orderby('id','asc')->get();

        if (empty($director)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $director
        ]);
    }

    public function getDirectorDetail($id)
    {
        $director_detail = \App\Models\Director::with('category')->where('id',$id)->get();

        if (empty($director_detail)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $director_detail
        ]);
    }

    public function getCommissioner()
    {
        $commissioner = \App\Models\Director::with('category')->where('category_id','2')->orderby('id','asc')->get();

        if (empty($commissioner)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $commissioner
        ]);
    }

    public function getCommittee()
    {
        $committee = \App\Models\Director::with('category')->where('category_id','3')->orderby('id','asc')->get();

        if (empty($committee)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $committee
        ]);
    }

    public function getAllDirector()
    {
        $director = \App\Models\Director::with('category')->orderby('sortby','asc')->get();

        if (empty($director)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $director
        ]);
    }


    public function getInnovations()
    {
        $latest = \App\Models\Product::with('brand')->where('latest','1')->get();

        if (empty($latest)) {
            return $this->sendError('Data not found');
        }

        foreach ($latest as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                // truncate string
                $stringCut = substr($string, 0, 300);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                 $string .= ' ...</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string ;
            $brandId = $row->brand_id;
            $types = \App\Models\Brand::find($brandId);
            $row->kategori = $types->type->slug;
        }


        return response()->json([
            'title'=> 'Latest Innovations',
            'seotitle'=> 'latest-innovations',
            'data' => $latest
        ]);
    }

    public function getBrandbyType($type)
    {
        $brands = \App\Models\Brand::with('type')->where('category_id',$type)->get();

        if (empty($brands)) {
            return $this->sendError('Data not found');
        }

        foreach ($brands as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                // truncate string
                $stringCut = substr($string, 0, 300);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                 $string .= ' ...</p>';
            }

            $row->summary = $string ;
        }


        return response()->json([
            'data' => $brands
        ]);
    }

    public function getBrandDetail($seotitle)
    {
        $brand_detail = \App\Models\Brand::with('type')->where('seotitle',$seotitle)->get();

        if (empty($brand_detail)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $brand_detail
        ]);
    }

    public function getTestimony()
    {
        $testimony = \App\Models\Testimony::orderby('id','desc')->get();

        if (empty($testimony)) {
            return $this->sendError('Data not found');
        }

        foreach ($testimony as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $testimony
        ]);
    }

    // public function getTestimonyEmployee()
    // {
    //     $testimonyE = \App\Models\Testimony::where('category_id','2')->get();

    //     if (empty($testimonyE)) {
    //         return $this->sendError('Data not found');
    //     }

    //     return response()->json([
    //         'data' => $testimonyE
    //     ]);
    // }

    public function getTestimonyDetail($seotitle)
    {
        $testimony_detail = \App\Models\Testimony::where('seotitle',$seotitle)->get();

        if (empty($testimony_detail)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $testimony_detail
        ]);
    }

    public function getNews()
    {
        $news = \App\Models\Content::with('category')->where('category_id','1')->orderby('published_at','desc')->get();

        if (empty($news)) {
            return $this->sendError('Data not found');
        }

        // foreach ($news as $row) {
        //     $row->summary = $this->get_word($row->content,300) ;
        // }

        foreach ($news as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string;
        }

        return response()->json([
            'data' => $news
        ]);
    }

    public function getNewsDetail($seotitle)
    {
        $news_detail = \App\Models\Content::with('category')->where('seotitle',$seotitle)->get();

        if (empty($news_detail)) {
            return $this->sendError('Data not found');
        }

        
        foreach ($news_detail as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string;
                    
        }

        return response()->json([
            'data' => $news_detail
        ]);
    }

    public function getEvent()
    {
        $event = \App\Models\Content::with('category')->where('category_id','2')->orderby('published_at','desc')->get();

        if (empty($event)) {
            return $this->sendError('Data not found');
        }

        foreach ($event as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string;
                            }

        return response()->json([
            'data' => $event
        ]);
    }

    public function getEventDetail($seotitle)
    {
        $event_detail = \App\Models\Content::with('category')->where('seotitle',$seotitle)->get();

        if (empty($event_detail)) {
            return $this->sendError('Data not found');
        }
        foreach ($event_detail as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string;
                            }

        return response()->json([
            'data' => $event_detail
        ]);
    }

    public function getCSR()
    {
        $csr = \App\Models\Content::with('category')->where('category_id','3')->orderby('published_at','desc')->get();

        if (empty($csr)) {
            return $this->sendError('Data not found');
        }

     foreach ($csr as $row) {
        $string = $row->content;
        if (strlen($string) > 150) {

            //if the string doesn't contain any space then it will cut without word basis.
            $string = '<p>'.Str::words($string, '28');
            $string .= '</p>';
        }
        
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }

            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string;
                    
        }
        
        return response()->json([
            'data' => $csr
        ]);
    }

    public function getCSRDetail($seotitle)
    {
        $csr_detail = \App\Models\Content::with('category')->where('seotitle',$seotitle)->get();

        if (empty($csr_detail)) {
            return $this->sendError('Data not found');
        }

        foreach ($csr_detail as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary =$string;
                    
        }

        return response()->json([
            'data' => $csr_detail
        ]);
    }

    public function getLatestCareer()
    {
        $latest_career = \App\Models\Career::where('home','1')->orderby('id','desc')->get();

        if (empty($latest_career)) {
            return $this->sendError('Data not found');
        }

        foreach ($latest_career as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string ;

        }


        return response()->json([
            'data' => $latest_career
        ]);
    }

    public function getCareer()
    {
        // $career = \App\Models\Group::with('group')->get();

        $career_list = \App\Models\Group::orderby('id','asc')->get();

        if (empty($career_list)) {
            return $this->sendError('Data not found');
        }

        foreach ($career_list as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
            $row->summary = $string ;

        }

        return response()->json([
            'data' => $career_list
        ]);
    }

    public function getCareerDetail($seotitle)
    {
        $career_detail = \App\Models\Career::with('group')->where('seotitle',$seotitle)->get();

        if (empty($career_detail)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $career_detail
        ]);
    }

    public function getCertification()
    {
        $certification = \App\Models\Certification::orderby('id','desc')->orderby('id','desc')->get();

        if (empty($certification)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $certification
        ]);
    }

    public function getAdvisor()
    {
        $advisor = \App\Models\Advisor::orderby('id','asc')->get();

        if (empty($advisor)) {
            return $this->sendError('Data not found');
        }

        foreach ($advisor as $row) {
            $string = $row->description;
            if (strlen($string) > 150) {

                // truncate string
                $stringCut = substr($string, 0, 300);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                 $string .= ' ...</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $advisor
        ]);
    }

    public function getDocumentCatalog()
    {
        $catalog = \App\Models\Document::with('jenis')->where('category','15')->orderby('published_at','desc')->get();

        if (empty($catalog)) {
            return $this->sendError('Data not found');
        }

        foreach ($catalog as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $catalog
        ]);
    }


    public function getDocumentArticles()
    {
        $article = \App\Models\Document::with('jenis')->where('category','6')->orderby('published_at','desc')->get();

        if (empty($article)) {
            return $this->sendError('Data not found');
        }

        foreach ($article as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $article
        ]);
    }

    public function getShareHoldingStructure()
    {
        $sharehold = \App\Models\Document::with('jenis')->where('category','9')->get();

        if (empty($sharehold)) {
            return $this->sendError('Data not found');
        }

        foreach ($sharehold as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $sharehold
        ]);
    }

    public function getOrganizationStructure()
    {
        $organization = \App\Models\Document::with('jenis')->where('category','10')->get();

        if (empty($organization)) {
            return $this->sendError('Data not found');
        }

        foreach ($organization as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $organization
        ]);
    }

        
    public function getKoperasiStructure()
    {
        $koperasi = \App\Models\Document::with('jenis')->where('category','14')->get();

        if (empty($koperasi)) {
            return $this->sendError('Data not found');
        }

        foreach ($koperasi as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $koperasi
        ]);
    }

    public function getProductCatalog()
    {
        $catalog = \App\Models\Document::with('jenis')->where('category','15')->get();

        if (empty($catalog)) {
            return $this->sendError('Data not found');
        }

        foreach ($catalog as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $catalog
        ]);
    }

    
    public function getDocumentFinancial()
    {
        $financial = \App\Models\Document::with('jenis')->where('category','1')->orderby('published_at','desc')->get();

        if (empty($financial)) {
            return $this->sendError('Data not found');
        }

        foreach ($financial as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $financial
        ]);
    }

    public function getDocumentAnnualReport()
    {
        $annual = \App\Models\Document::with('jenis')->where('category','2')->orderby('published_at','desc')->get();

        if (empty($annual)) {
            return $this->sendError('Data not found');
        }

        foreach ($annual as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }


        return response()->json([
            'data' => $annual
        ]);
    }

    public function getDocumentProspectus()
    {
        $prospectus = \App\Models\Document::with('jenis')->where('category','3')->orderby('published_at','desc')->get();

        if (empty($prospectus)) {
            return $this->sendError('Data not found');
        }

        foreach ($prospectus as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $prospectus
        ]);
    }

    public function getDocumentCompanyPresentation()
    {
        $presentation = \App\Models\Document::with('jenis')->where('category','4')->orderby('published_at','desc')->get();

        if (empty($presentation)) {
            return $this->sendError('Data not found');
        }

        foreach ($presentation as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $presentation
        ]);
    }

    public function getDocumentOthers()
    {
        $other = \App\Models\Document::with('jenis')->where('category','5')->orderby('published_at','desc')->get();

        if (empty($other)) {
            return $this->sendError('Data not found');
        }

        foreach ($other as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $other
        ]);
    }

    public function getDocumentCharter()
    {
        $charter = \App\Models\Document::with('jenis')->where('category','8')->orderby('published_at','desc')->get();

        if (empty($charter)) {
            return $this->sendError('Data not found');
        }

        foreach ($charter as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $charter
        ]);
    }

    public function getDocumentShareholder()
    {
        $share = \App\Models\Document::with('jenis')->where('category','7')->orderby('published_at','desc')->get();

        if (empty($share)) {
            return $this->sendError('Data not found');
        }

        foreach ($share as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $share
        ]);
    }

    public function getDocumentPressRelease()
    {
        $release = \App\Models\Document::with('jenis')->where('category','11')->orderby('published_at','desc')->get();

        if (empty($release)) {
            return $this->sendError('Data not found');
        }

        foreach ($release as $row) {
            $string = $row->description;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $release
        ]);
    }

    public function getDocumentShareInfo()
    {
        $shareinfo = \App\Models\Document::with('jenis')->where('category','12')->orderby('published_at','desc')->get();

        if (empty($shareinfo)) {
            return $this->sendError('Data not found');
        }

        foreach ($shareinfo as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }

        return response()->json([
            'data' => $shareinfo
        ]);
    }

    public function getDocumentRiskManagement()
    {
        $riskmgt = \App\Models\Document::with('jenis')->where('category','13')->orderby('published_at','desc')->get();

        if (empty($riskmgt)) {
            return $this->sendError('Data not found');
        }

        foreach ($riskmgt as $row) {

            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->seotitle = Str::slug($slug, '-');
        }


        return response()->json([
            'data' => $riskmgt
        ]);
    }

    public function getDividen()
    {
        $dividen = \App\Models\Dividen::orderby('id','desc')->get();

        if (empty($dividen)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $dividen
        ]);
    }

    public function getSharebyOwnership()
    {
        $share = \App\Models\Ownership::orderby('id','asc')->get();

        if (empty($share)) {
            return $this->sendError('Data not found');
        }

        $totalquantity = 0;
        $totalpersen = 0;

        foreach ($share as $value) {     
            $totalquantity+= (float)$value->quantity;         
            $totalpersen+= (float)$value->persentase;         
        }

        // $total=array();
        // $total['id'] = 999;
        // $total['name'] = 'Total';
        // $total['quantity'] = number_format($totalquantity, 0,".",",");
        // $total['persentase'] = number_format($totalpersen, 3,".",",");
        // $total['status'] = 2;

        foreach ($share as $row) {
            $row->quantity = number_format($row->quantity, 0,".",",");
            $row->persentase = number_format($row->persentase, 3,".",",");
        }

        // $share[] =  $total;

        return response()->json([
            'data' => $share
        ]);
    }

    public function getSharebyComposition()
    {
        $share = \App\Models\Composition::orderby('id','asc')->get();

        if (empty($share)) {
            return $this->sendError('Data not found');
        }

        $totaljumlah = 0;
        $totalquantity = 0;
        $totalpersen = 0;

        foreach ($share as $value) {   
            $totaljumlah+= (float)$value->jumlah;           
            $totalquantity+= (float)$value->quantity;         
            $totalpersen+= (float)$value->persentase;         
        }

        // $total=array();
        // $total['id'] = 999;
        // $total['name'] = 'Total';
        // $total['jumlah'] = number_format($totaljumlah, 0,".",",");
        // $total['quantity'] = number_format($totalquantity, 0,".",",");
        // $total['persentase'] = number_format($totalpersen, 3,".",",");
        // $total['status'] = 2;

        foreach ($share as $row) {
            $row->jumlah = number_format($row->jumlah, 0,".",",");
            $row->quantity = number_format($row->quantity, 0,".",",");
            $row->persentase = number_format($row->persentase, 4,".",",");
        }

        // $share[] =  $total;

        return response()->json([
            'data' => $share
        ]);
    }

    public function getSharebyPosition()
    {
        $share = \App\Models\Position::orderby('id','asc')->get();

        if (empty($share)) {
            return $this->sendError('Data not found');
        }

        $totalquantity = 0;
        $totalpersen = 0;

        foreach ($share as $value) {     
            $totalquantity+= (float)$value->quantity;         
            $totalpersen+= (float)$value->persentase;         
        }

        // $total=array();
        // $total['id'] = 999;
        // $total['name'] = 'Total';
        // $total['quantity'] = number_format($totalquantity, 0,".",",");
        // $total['persentase'] = number_format($totalpersen, 3,".",",");
        // $total['status'] = 2;

        foreach ($share as $row) {
            $row->quantity = number_format($row->quantity, 0,".",",");
            $row->persentase = number_format($row->persentase, 3,".",",");
        }

        // $share[] =  $total;

        return response()->json([
            'data' => $share
        ]);
    }


    public function getShareInfo()
    {
        // $shareinfo = \App\Models\Share::orderby('id','asc')->get();
        $shareinfo = \App\Models\Share::orderby('tanggal','desc')->paginate(5);


        if (empty($shareinfo)) {
            return $this->sendError('Data not found');
        }

        foreach ($shareinfo as $row) {
            $row->price = number_format($row->price, 0,".",",");
        }

        return response()->json([
            'data' => $shareinfo
        ]);
    }

    public function getCareerbyGroup($id)
    {
        $career_group = \App\Models\Career::with('group')->where('id',$id)->get();

        if (empty($career_group)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $career_group
        ]);
    }

    public function getWorkatKino()
    {
        $work = \App\Models\Release::where('category_id','3')->orderby('id','asc')->get();

        if (empty($work)) {
            return $this->sendError('Data not found');
        }

        foreach ($work as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }

        return response()->json([
            'data' => $work
        ]);
    }

    public function getDevelopmentProgram()
    {
        $program = \App\Models\Release::where('category_id','4')->orderby('id','asc')->get();

        if (empty($program)) {
            return $this->sendError('Data not found');
        }

        foreach ($program as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;
        }


        return response()->json([
            'data' => $program
        ]);
    }

    public function getLatestArticle()
    {
        // $press = \App\Models\Release::with('varian')->where('category_id','1')->get();
        $article = \App\Models\Content::with('category')->orderby('published_at','desc')->get();

        if (empty($article)) {
            return $this->sendError('Data not found');
        }

        foreach ($article as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string;
                            }

        return response()->json([
            'data' => $article
        ]);
    }

    public function getPressRelease()
    {
        // $press = \App\Models\Release::with('varian')->where('category_id','1')->get();
        $press = \App\Models\Content::with('category')->where('category_id','4')->orderby('published_at','desc')->get();

        if (empty($press)) {
            return $this->sendError('Data not found');
        }

        foreach ($press as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string;
                            }

        return response()->json([
            'data' => $press
        ]);
    }

    public function getPressReleaseDetail($seotitle)
    {
        // $press_detail = \App\Models\Release::with('varian')->where('seotitle',$seotitle)->get();
        $press_detail = \App\Models\Content::with('category')->where('seotitle',$seotitle)->get();

        if (empty($press_detail)) {
            return $this->sendError('Data not found');
        }

        foreach ($press_detail as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string;
                            }

        return response()->json([
            'data' => $press_detail
        ]);
    }


    public function getMediaCoverage()
    {
        // $media = \App\Models\Release::with('varian')->where('category_id','2')->get();
        $media = \App\Models\Content::with('category')->where('category_id','5')->orderby('published_at','desc')->get();

        if (empty($media)) {
            return $this->sendError('Data not found');
        }

        foreach ($media as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string;
                            }


        return response()->json([
            'data' => $media
        ]);
    }

    public function getMediaCoverageDetail($seotitle)
    {
        // $press_detail = \App\Models\Release::with('varian')->where('seotitle',$seotitle)->get();
        $media_detail = \App\Models\Content::with('category')->where('seotitle',$seotitle)->get();

        if (empty($media_detail)) {
            return $this->sendError('Data not found');
        }

        foreach ($media_detail as $row) {
            $string = $row->content;
            if (strlen($string) > 150) {

                //if the string doesn't contain any space then it will cut without word basis.
                $string = '<p>'.Str::words($string, '28');
                $string .= '</p>';
            }
            
            if (strpos($row->title, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->title);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string;
                            }

        return response()->json([
            'data' => $media_detail
        ]);
    }


    public function getMilestone()
    {
        $milestone = \App\Models\Milestone::get();

        if (empty($milestone)) {
            return $this->sendError('Data not found');
        }

        
        foreach ($milestone as $row) {
            $string = $row->description;
            if (strlen($string) > 150) {

                // truncate string
                $stringCut = substr($string, 0, 300);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                 $string .= ' ...</p>';
            }
            
            if (strpos($row->year, '&') !== false) {
                $slug = preg_replace("/[&]/", "n", $row->year);
            } else{
                $slug = $row->title;
            }
            $row->slug = Str::slug($slug, '-');
            $row->summary = $string ;

        }

        return response()->json([
            'data' => $milestone
        ]);
    }

    public function getUniqueWorkingEnvironment()
    {
        $working = \App\Models\Varian::where('id',5)->get();

        if (empty($working)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $working
        ]);
    }

    public function getDistributionLocal()
    {
        $distribution = \App\Models\Distribution::where('type',1)->get();

        if (empty($distribution)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $distribution
        ]);
    }

    public function getDistributionInternational()
    {
        $distribution = \App\Models\Distribution::where('type',2)->get();

        if (empty($distribution)) {
            return $this->sendError('Data not found');
        }

        return response()->json([
            'data' => $distribution
        ]);
    }


    public function saveContact(Request $request)
        {
            
            $this->validate($request, [
                'name'    => 'required',
                'email'   => 'required|email',
                'title' => 'required',
                'content' => 'required',
            ]);

            $request->request->add([
                'status' => '1'
            ]);
            $input = $request->all();
            $contact =  \App\Models\Contact::create($input);

            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'title' => $request->title,  
                'content' => $request->content,  

              ); 
        
              $recruitment = 'corsec@kino.co.id';
              Mail::to($recruitment)->send(new saveContact($data));

            return response()->json([
                'data' => $contact
            ]);
        }      


        public function saveInvestor(Request $request)
        {
            
            $this->validate($request, [
                'name'    => 'required',
                'email'   => 'required|email',
                'title' => 'required',
                'content' => 'required',
            ]);

            $request->request->add([
                'status' => '1'
            ]);
            $input = $request->all();
            $investor =  \App\Models\Investor::create($input);

            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,  
                'title' => $request->title,  
                'content' => $request->content,  
              ); 
        
              $recruitment = 'corsec@kino.co.id';
              Mail::to($recruitment)->send(new saveInvestor($data));

            return response()->json([
                'data' => $investor
            ]);
        }      
    

        
        public function saveCareerRecruitment(Request $request)
        {
            $this->validate($request, [
                'fullName'    => 'required',
                'email'   => 'required|email',
                'phone'    => 'required',
            ]);

            $resume = fopen($request->resume,"r");
            $extension = $request->resume->extension();
            $resumepath = '';

            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'pdf')
            {
                $file_name = 'Resume';
                $tgl=date('YmdHis');
                $resumename = $file_name.'-'.$tgl.'-'.$request->firstname.'-'.$request->lastname.'.'.$extension;

                $folder = 'storage/files/shares/resume/';
                $resumepath = $folder.$resumename;

                $request->resume->move(public_path($folder),$resumename);

                // $resumepath = Storage::putFileAs(
                //   'public/storage/files/shares/resume',
                //   $request->resume, $resumename
                // );
        
                $url = $request->resume;
                      if (substr($url,0,4) != 'http') {
                        $url = 'http://'.$url;
                      }
            }else{
                return $this->sendError('Data error');
            }


            $career = \App\Models\Registrant::create(array_merge($request->all(), 
            [
                'resume' => $resumepath,
                'status' => '1'
            ]));

      
            $data = array(
              'firstname' => $request->fullName,
              'email' => $request->email,
              'phone' => $request->phone,
              'address' => $request->address,
              'resume' => $resumepath,
              
            ); 
      
            $recruitment = 'recruitment@kino.co.id';
            Mail::to($request->email)->send(new saveCareer($data));
            // Mail::to($recruitment)->send(new saveCareer($data));


            return response()->json([
                'data' => $career
            ]);
        }  


        public function saveCareerRecruitment2(Request $request)
        {
            $this->validate($request, [
                'firstname'    => 'required',
                'email'   => 'required|email',
                'phone'    => 'required',
            ]);

            $resume = fopen($request->resume,"r");
            $extension = $request->resume->extension();
            $resumepath = '';

            if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'pdf')
            {
                $file_name = 'Resume';
                $tgl=date('YmdHis');
                $resumename = $file_name.'-'.$tgl.'-'.$request->firstname.'-'.$request->lastname.'.'.$extension;

                $folder = 'storage/files/shares/resume/';
                $resumepath = $folder.$resumename;

                $request->resume->move(public_path($folder),$resumename);

                // $resumepath = Storage::putFileAs(
                //   'public/storage/files/shares/resume',
                //   $request->resume, $resumename
                // );
        
                $url = $request->resume;
                      if (substr($url,0,4) != 'http') {
                        $url = 'http://'.$url;
                      }
            }else{
                return $this->sendError('Data error');
            }


            $career = \App\Models\Registrant::create(array_merge($request->all(), 
            [
                'resume' => $resumepath,
                'status' => '1'
            ]));

      
            $data = array(
              'firstname' => $request->firstname,
              'lastname' => $request->lastname,
              'email' => $request->email,
              'phone' => $request->phone,
              'address' => $request->address,
              'resume' => $resumepath,
              
            ); 
      
            $recruitment = 'recruitment2@kino.co.id';
            Mail::to($request->email)->send(new saveCareer($data));
            Mail::to($recruitment)->send(new saveCareer($data));


            return response()->json([
                'data' => $career
            ]);
        }  

        public function search(Request $request)
        {
            $result = array();
            $column = 'title';
            $column2 = 'content';
            $value = $request->key;

            $type = \App\Models\Type::where('title', 'like', '%'.$value.'%')->get();
            $group = \App\Models\Group::where($column, 'like', '%'.$value.'%')->orWhere($column2, 'like', '%'.$value.'%')->get();
            $brand = \App\Models\Brand::where($column, 'like', '%'.$value.'%')->orWhere($column2, 'like', '%'.$value.'%')->get();
            $product = \App\Models\Product::where($column, 'like', '%'.$value.'%')->orWhere($column2, 'like', '%'.$value.'%')->get();
            $content = \App\Models\Content::where($column, 'like', '%'.$value.'%')->orWhere($column2, 'like', '%'.$value.'%')->orderby('published_at','desc')->get();
            $release = \App\Models\Release::where($column, 'like', '%'.$value.'%')->orWhere($column2, 'like', '%'.$value.'%')->get();
            $testimony = \App\Models\Testimony::where($column, 'like', '%'.$value.'%')->orWhere($column2, 'like', '%'.$value.'%')->get();

            $result[] =  $type;
            $result[] =  $group;
            $result[] =  $brand;
            $result[] =  $product;
            $result[] =  $content;
            $result[] =  $release;
            $result[] =  $testimony;

            foreach ($content as $row) {
                $categoryId = $row->category_id;
                $types = \App\Models\Category::find($categoryId);
                $row->kategori = $types->title;

                $string = $row->content;
                if (strlen($string) > 150) {
    
                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = '<p>'.Str::words($string, '28');
                    $string .= '</p>';
                }
                    
                    if (strpos($row->title, '&') !== false) {
                        $slug = preg_replace("/[&]/", "n", $row->title);
                    } else{
                        $slug = $row->title;
                    }
                    $row->slug = Str::slug($slug, '-');
                    $row->summary = $string ;
                    $row->title = $row->title_en ;
                    $row->content = $row->content_en ;
            }

            foreach ($brand as $row) {
                $categoryId = $row->category_id;
                $types = \App\Models\Type::find($categoryId);
                $row->kategori = $types->slug;
                $string = $row->content;
                if (strlen($string) > 150) {
    
                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = '<p>'.Str::words($string, '28');
                    $string .= '</p>';
                }
    
                $row->summary = $string ;
            }

            foreach ($product as $row) {
                $brandId = $row->brand_id;
                $types = \App\Models\Brand::find($brandId);
                $row->brand = $types->seotitle;
                $row->kategori = $types->type->slug;
                $string = $row->content;
                if (strlen($string) > 150) {
    
                    //if the string doesn't contain any space then it will cut without word basis.
                    $string = '<p>'.Str::words($string, '28');
                    $string .= '</p>';
                }
    
                $row->summary = $string ;
            }


            if (empty($result)) {
                return $this->sendError('Data not found');
            }

            return response()->json([
                'type' => $type,
                'group' => $group,
                'brand' => $brand,
                'product' => $product,
                'content' => $content,
                'career' => $release,
                'testimony' => $testimony

            ]);
        }

        public function get_word($str,$number)
            {
            $array_str = explode(" ", $str);
            if(isset($array_str[$number]))
            {
                return implode(" ",array_slice($array_str, 0, $number));
            }
            return $str;
            }

        public static function getLocaleChangerURL($locale){
            $uri = request()->segments();

            $uri[0] = $locale;
        
            return implode($uri, '/');
            }    
}
