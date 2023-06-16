<?php

namespace App\Http\Controllers;

session_start();

use App\Models\Contact;
use App\Models\User;
use App\Repositories\ArtistRepository;
use App\Repositories\NewsRepository;
use App\Repositories\OtherNewsRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SliderRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\View;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\News;
use App\Models\Config;
use App\Helpers\Common;
use Illuminate\Support\Facades\Auth;
use App\Repositories\CategoryRepository;
use App\Repositories\ComponentRepository;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMail;
use App\Repositories\EventRepository;
use App\Repositories\PartnerRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\StudentRepository;

class HomeController extends Controller
{
    function __construct(ArtistRepository $artistRepository, SliderRepository $sliderRepository, NewsRepository $newsRepository, ComponentRepository $componentRepository, ProductRepository $productRepository)
    {
        //    
        $products = $productRepository->getListProduct(5);
        $data['contac-popup-name'] = $componentRepository->getBySlug('contac-popup-name')->description;
        $data['contac-popup-email'] = $componentRepository->getBySlug('contac-popup-email')->description;
        $data['contac-popup-phone'] = $componentRepository->getBySlug('contac-popup-phone')->description;
        $data['contac-popup-pos'] = $componentRepository->getBySlug('contac-popup-pos')->description;
        $data['contac-popup-text'] = $componentRepository->getBySlug('contac-popup-text')->description;
        $data['contac-popup-image'] = $componentRepository->getBySlug('contac-popup-image')->images;
        $data['contac-popup-zalo'] = $componentRepository->getBySlug('contac-popup-zalo')->link;
        $data['contac-popup-mess'] = $componentRepository->getBySlug('contac-popup-mess')->link;
        $data['contac-popup-facebook'] = $componentRepository->getBySlug('contac-popup-facebook')->link;
        $data['have-slide'] = 1;
        $data['products'] = $products;
        return view::share('dataShare', $data);
    }
    function index(
        ArtistRepository $artistRepository,
        SliderRepository $sliderRepository,
        ProductRepository $productRepository,
        ComponentRepository $componentRepository,
        NewsRepository $newsRepository,
        PartnerRepository $partnerRepository
    ) {
        $products = $productRepository->getListProduct(5);
        // $teachers = $userRepository->getTeachers();
        $sliders = $sliderRepository->getListByType(5, 6);
        $news = $newsRepository->getListTinTuc(3);
        $kienthuc = $newsRepository->getListKienThuc(3);
        $artists = $artistRepository->getList();
        $partners = $partnerRepository->getList();


        $data['home-banner-title'] = $componentRepository->getBySlug('home-banner-title')->description;
        $data['home-banner-text'] = $componentRepository->getBySlug('home-banner-text')->description;
        $data['home-date-title'] = $componentRepository->getBySlug('home-date-title')->description;
        $data['home-date-text'] = $componentRepository->getBySlug('home-date-text')->description;
        $data['home-artist-text'] = $componentRepository->getBySlug('home-artist-text')->description;
        $activeHome = 'active';

        return view('modules.fontend.home', [
            'activeHome' => $activeHome,
            'artists' => $artists,
            'products' => $products,
            'sliders' => $sliders,
            'news' => $news,
            'kienthuc' => $kienthuc,
            'partners' => $partners,
            'data' => $data
        ]);
    }

    function product(
        Request $request, 
        ProductRepository $productRepository, 
        ComponentRepository $componentRepository, 
        ArtistRepository $artistRepository,  
        StudentRepository $studentRepository)
    {
        $pro_id = $request->id;
        if (!$pro_id) {
            return redirect('/');
        }
        $product = $productRepository->getById($pro_id);
        $product['comments'] = explode(',', $product['comments']);
        $listOption = file_get_contents(base_path('resources/data/list-profit-optons.json'));
        $listOption = json_decode($listOption, true);
        $listOption = $listOption['profit'];
        $product['free_benefit'] = explode(',', $product['free_benefit']);
        $product['basic_benefit'] = explode(',', $product['basic_benefit']);
        $product['pre_benefit'] = explode(',', $product['pre_benefit']);
        $free_benefit = [];
        $basic_benefit = [];
        $pre_benefit = [];
        foreach ($product['free_benefit'] as $key => $opt) {
            $free_benefit[] = $listOption[$opt];
        }
        foreach ($product['basic_benefit'] as $key => $opt) {
            $basic_benefit[] = $listOption[$opt];
        }
        foreach ($product['pre_benefit'] as $key => $opt) {
            $pre_benefit[] = $listOption[$opt];
        }
        $product['free_benefit'] = $free_benefit;
        $product['basic_benefit'] = $basic_benefit;
        $product['pre_benefit'] = $pre_benefit;

        $artist = $artistRepository->getById($product['teacher_id']);
        $students = $studentRepository->getListOpinionByClassId($pro_id);
        $activeProduct = 'active';
        // $data['nstnd-video-banner'] = $componentRepository->getBySlug('nstnd-video-banner');
        // $data['nstnd-video-titlt-1'] = $componentRepository->getBySlug('nstnd-video-titlt-1')->description;
        // $data['nstnd-video-titlt-2'] = $componentRepository->getBySlug('nstnd-video-titlt-2')->description;
        // $data['nstnd-main-title'] = $componentRepository->getBySlug('nstnd-main-title')->description;
        // $data['nstnd-main-content-1'] = $componentRepository->getBySlug('nstnd-main-content-1')->description;
        // $data['nstnd-main-content-2'] = $componentRepository->getBySlug('nstnd-main-content-2')->description;
        // $data['nstnd-main-content-3'] = $componentRepository->getBySlug('nstnd-main-content-3')->description;
        // $data['nstnd-main-content-3'] = $componentRepository->getBySlug('nstnd-main-content-3')->description;
        // if($componentRepository->getBySlug('nstnd-hoi-dap-question-1')){
        //     $data['nstnd-hoi-dap-question-1'] = $componentRepository->getBySlug('nstnd-hoi-dap-question-1')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-question-2')){
        //     $data['nstnd-hoi-dap-question-2'] = $componentRepository->getBySlug('nstnd-hoi-dap-question-2')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-question-3')){
        //     $data['nstnd-hoi-dap-question-3'] = $componentRepository->getBySlug('nstnd-hoi-dap-question-3')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-question-4')){
        //     $data['nstnd-hoi-dap-question-4'] = $componentRepository->getBySlug('nstnd-hoi-dap-question-4')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-question-5')){
        //     $data['nstnd-hoi-dap-question-5'] = $componentRepository->getBySlug('nstnd-hoi-dap-question-5')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-answer-1')){
        //     $data['nstnd-hoi-dap-answer-1'] = $componentRepository->getBySlug('nstnd-hoi-dap-answer-1')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-answer-2')){
        //     $data['nstnd-hoi-dap-answer-2'] = $componentRepository->getBySlug('nstnd-hoi-dap-answer-2')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-answer-3')){
        //     $data['nstnd-hoi-dap-answer-3'] = $componentRepository->getBySlug('nstnd-hoi-dap-answer-3')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-answer-4')){
        //     $data['nstnd-hoi-dap-answer-4'] = $componentRepository->getBySlug('nstnd-hoi-dap-answer-4')->description;
        // }
        // if($componentRepository->getBySlug('nstnd-hoi-dap-answer-5')){
        //     $data['nstnd-hoi-dap-answer-5'] = $componentRepository->getBySlug('nstnd-hoi-dap-answer-5')->description;
        // }
        return view('modules.fontend.product', [
            'activeProduct' => $activeProduct,
            'artist' => $artist,
            'item' => $product,
            'students' => $students,
            // 'data' => $data
        ]);
    }

    function introduce(
        ArtistRepository $artistRepository,
        ComponentRepository $componentRepository,
        ServiceRepository $serviceRepository,
        ProjectRepository $projectRepository,
        EventRepository $eventRepository,
        SliderRepository $sliderRepository,
        StudentRepository $studentRepository,
        PartnerRepository $partnerRepository
    ) {
        $activeIntroduce = 'active';
        $artists = $artistRepository->getPagination(9);
        $services = $serviceRepository->getList(9);
        $services = $serviceRepository->getList(9);
        // $projects = $projectRepository->getList(2);
        $projects = $projectRepository->getList();
        $events = $eventRepository->getListGroupSix(1);
        // $best_events = $sliderRepository->getListByType(5, 9);
        $best_events = $eventRepository->getList();
        $students = $studentRepository->getListRepresentative(6);
        $partners = $partnerRepository->getList();


        $data['gioi-thieu-block-1-title'] = $componentRepository->getBySlug('gioi-thieu-block-1-title')->description;
        $data['gioi-thieu-block-2-title'] = $componentRepository->getBySlug('gioi-thieu-block-2-title')->description;
        $data['gioi-thieu-block-1-text'] = $componentRepository->getBySlug('gioi-thieu-block-1-text')->description;
        $data['gioi-thieu-block-2-text'] = $componentRepository->getBySlug('gioi-thieu-block-2-text')->description;
        $data['gioi-thieu-block-1-image'] = $componentRepository->getBySlug('gioi-thieu-block-1-image')->images;
        $data['gioi-thieu-block-2-image'] = $componentRepository->getBySlug('gioi-thieu-block-2-image')->images;
        $data['gioi-thieu-video'] = $componentRepository->getBySlug('gioi-thieu-video');
        // $data['home-hoc-vien-tot-nghiep'] = $componentRepository->getBySlug('home-hoc-vien-tot-nghiep')->description;
        // $data['home-user-theo-doi'] = $componentRepository->getBySlug('home-user-theo-doi')->description;

        return view('modules.fontend.introduce', [
            'activeIntroduce' => $activeIntroduce,
            'artists' => $artists,
            'services' => $services,
            'projects' => $projects,
            'events' => $events,
            'best_events' => $best_events,
            'students' => $students,
            'partners' => $partners,
            'data' => $data,
        ]);
    }
    function artists(Request $request, ArtistRepository $artistRepository)
    {
        $activeArtist = 'active';
        $text = isset($_GET['text-search']) ? $_GET['text-search'] : '';
        $artists = $artistRepository->getPagination(9);

        return view('modules.fontend.listArtist', [
            'activeArtist' => $activeArtist,
            'items' => $artists,
            'text_search' => $text,
        ]);
    }

    // function library(SliderRepository $sliderRepository)
    // {
    //     $mc = $sliderRepository->getListByType(1);

    //     $dj = $sliderRepository->getListByType(2);
    //     $producer = $sliderRepository->getListByType(3);
    //     $mkt = $sliderRepository->getListByType(4);
    //     $other = $sliderRepository->getListByType(6);
    //     return view('modules.fontend.library', [
    //         'mc' => $mc,
    //         'dj' => $dj,
    //         'producer' => $producer,
    //         'mkt' => $mkt,
    //         'other' => $other,
    //     ]);
    // }

    function library(SliderRepository $sliderRepository)
    {
        $sliders = $sliderRepository->getList();
        // $dj = $sliderRepository->getOneByType(2);
        // $producer = $sliderRepository->getOneByType(3);
        // $mkt = $sliderRepository->getOneByType(4);
        // $other = $sliderRepository->getOneByType(6);

        // $event = $sliderRepository->getOneByType(5);
        // $workShop = $sliderRepository->getOneByType(7);
        // $studio = $sliderRepository->getOneByType(8);
        // $profile = $sliderRepository->getOneByType(9);
        return view('modules.fontend.library', [
            'sliders' => $sliders
            // 'mc' => $mc
            // 'dj' => $dj,
            // 'producer' => $producer,
            // 'mkt' => $mkt,
            // 'other' => $other,
            // 'event' => $event,
            // 'workShop' => $workShop,
            // 'studio' => $studio,
            // 'profile' => $profile
        ]);
    }

    function artistDetail(ArtistRepository $artistRepository)
    {
        $activeArtist = 'active';
        $artist_id = $_GET['id'];
        $artist =  $artistRepository->getById($artist_id);
        $artist['clubs'] = explode(',', $artist['clubs']);
        $artist['partners'] = explode(',', $artist['partners']);
        $artist['project_1_image'] = explode(',', $artist['project_1_image']);
        $artist['project_2_image'] = explode(',', $artist['project_2_image']);
        return view('modules.fontend.artistDetail', [
            'activeArtist' => $activeArtist,
            'item' => $artist,
        ]);
    }
    function news($slug, NewsRepository $newsRepository)
    {
        $news = $newsRepository->getBySlug($slug);
        $listNews = $newsRepository->getListTinTucLienQuan($news->id, 6);
        return view('modules.fontend.news', [
            'news' => $news,
            'listNews' => $listNews
        ]);
    }

    function listNews(NewsRepository $newsRepository)
    {
        $hotNews = $newsRepository->getTinnoibat(1);
        $news = $newsRepository->getListTinTucPagination(9);

        $activeNews = 'active';
        return view('modules.fontend.listNews', [
            'items' => $news,
            'hotNews' => $hotNews,
            'activeNews' => $activeNews
        ]);
    }

    function knowledges(NewsRepository $newsRepository)
    {
        $hotNews = $newsRepository->getHotKnowledge(1);
        $news = $newsRepository->getKnowledgesPagination(9);

        $activeKnowledges = 'active';
        return view('modules.fontend.listNews', [
            'items' => $news,
            'hotNews' => $hotNews,
            'activeKnowledges' => $activeKnowledges
        ]);
    }

    function listDuan(NewsRepository $newsRepository)
    {
        $news = $newsRepository->getListDuan();
        return view('modules.fontend.listDuan', ['items' => $news]);
    }
    function category($id, CategoryRepository $categoryRepository)
    {
        $cate = $categoryRepository->getCateAndProduct($id);
        return view('modules.fontend.category', ['item' => $cate]);
    }
    function contact(ComponentRepository $componentRepository)
    {
        $activeContact = 'active';
        $data['lien-he-title'] = $componentRepository->getBySlug('lien-he-title')->description;
        $data['lien-he-text'] = $componentRepository->getBySlug('lien-he-text')->description;
        $data['lien-he-text'] = $componentRepository->getBySlug('lien-he-text')->description;
        $data['lien-he-hotline'] = $componentRepository->getBySlug('lien-he-hotline')->description;
        $data['lien-he-address'] = $componentRepository->getBySlug('lien-he-address')->description;
        return view('modules.fontend.contact', [
            'activeContact' => $activeContact,
            'data' => $data,
        ]);
    }
    function policy()
    {
        $activeHome = 'active';

        return view('modules.fontend.policy', [
            'activeHome' => $activeHome,
        ]);
    }
    function rules()
    {
        $activeHome = 'active';

        return view('modules.fontend.rules', [
            'activeHome' => $activeHome,
        ]);
    }

    function addContact(Request $request)
    {
        $arrRules =  [
            'name'                  => 'required|max:255',
            'description'                  => 'required|max:255',
            'email'                  => 'required|max:255',
        ];
        $arrMess  = [
            'name.required'         => 'Trường dữ liệu không được bỏ trống!',
            'name.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.required'         => 'Trường dữ liệu không được bỏ trống!',
            'email.max'              => 'Độ dài tối đa 255 kí tự!',
            'description.required'         => 'Trường dữ liệu không được bỏ trống!',
        ];
        $validator = Validator::make($request->all(), $arrRules, $arrMess);

        if ($validator->fails()) {
            return redirect('/lien-he.html#main-form')
                ->withErrors($validator)
                ->withInput();
        }
        //        $this->validate($request, $arrRules, $arrMess);
        $contact = new Contact();
        $contact->name              = $request->name;
        $contact->description       = $request->description;
        $contact->email             = $request->email;
        $contact->status       = 0;
        $contact->type       = 1;
        $contact->save();
        return redirect('/')->with('thongbao', 'Cảm ơn bạn đã liên hệ!');
    }

    function addLienhe(Request $request)
    {
        $contact = new Contact();
        $contact->name              = $request->name;
        $contact->address              = $request->address;
        $contact->phone              = $request->phone;
        $contact->email              = $request->email;
        $contact->description              = $request->description;
        $contact->type       = 1;
        $contact->status       = 0;
        $contact->save();
        return redirect('/')->with('thongbao', 'Cảm ơn bạn đã liên hệ!');
    }

    public function registerUser(Request $request)
    {
        $arrRules =  [
            'name'                  => 'required|max:255',
            'email'                  => 'required|unique:users,email|max:255',
            'password'              => 'required|max:16|min:6',
            'phone'                 => 'required|min:11|numeric',
            'repassword'             => 'required|max:16|min:6|same:password',
        ];
        $arrMess  = [
            'name.required'         => 'Trường dữ liệu không được bỏ trống!',
            'name.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.required'         => 'Trường dữ liệu không được bỏ trống!',
            'email.max'              => 'Độ dài tối đa 255 kí tự!',
            'email.unique'              => 'Email đã tồn tại trên hệ thống!',
            'phone.required'         => 'Trường dữ liệu không được bỏ trống!',
            'phone.min'              => 'Số điện thoại không hợp lệ!',
            'phone.numeric'              => 'Số điện thoại không hợp lệ!',
            'password.required'       => 'Trường dữ liệu không được bỏ trống!',
            'password.max'              => 'Độ dài tối đa 16 kí tự!',
            'password.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.required'       => 'Trường dữ liệu không được bỏ trống!',
            'repassword.max'              => 'Độ dài tối đa 16 kí tự!',
            'repassword.min'              => 'Độ dài tối thiểu 6 kí tự!',
            'repassword.same'              => 'Mật khẩu xác nhận không chính xác!',
        ];
        $user = new User();
        $this->validate($request, $arrRules, $arrMess);
        $user->name              = $request->name;
        $user->email              = $request->email;
        $user->phone              = $request->phone;
        $user->password       = Hash::make($request->password);
        $user->type       = 2; //1-giasu|2-hocvien
        $user->save();
        return redirect('/')->with('thongbao', 'Đắng ký học viên thành công!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('name', $request->name)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('fe.home');
        } else {
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('fe.home');
    }
    public function sendFogotPasswordMail(Request $request)
    {
        $to_email = $request->email;

        $user = User::where('email', '=', $to_email)->first();

        if (!$user) {
            return redirect('/')->with('thongbao', 'Email không tồn tại!');
        }
        $newPass = Common::generateRandomString(8);
        $user->password = Hash::make($newPass);
        $user->save();
        $data['newPass'] = $newPass;

        Mail::to($to_email)->send(new SendMail($data));

        return redirect('/')->with('thongbao', 'Mật khẩu đã được reset, vui lòng kiểm tra Email!');
    }

    public function viewDetailLibrary(SliderRepository $sliderRepository, $id)
    {
        $imageLibrary = $sliderRepository->getListById($id);
        // dd($imageLibrary);
        // switch($id) {
        //     case '1' :
        //         $title = "MC";
        //        break;
        //     case '2':
        //         $title = "DJ";
        //        break;
        //     case '3':
        //         $title = "PRODUCER";
        //        break;
        //     case '4':
        //         $title = "MKT";
        //        break;
        //     case '5':
        //         $title = "Sự Kiện";
        //        break;
        //     case '6':
        //         $title = "Khác";
        //        break;
        //     case '7':
        //         $title = "STUDIO";
        //        break;
        //     case '9':
        //         $title = "PROFILE";
        //        break;
        //    default:
        //         $title = "WORKSHOP";
        // }
        return view('modules.fontend.detailLibrary', [
            'imageLibrary' => $imageLibrary,
            'title' => $imageLibrary[0]['title']
        ]);
    }

    function getById(EventRepository $eventRepository, Request $request)
    {
        $item = $eventRepository->getDetailById($request->id);
        // $data = kpi_input_program::where('id' , $request->id)->first();
        return response()->json($item, 200);
    }
}
