<div class="slider">
    <div class="row">
        <div class="col-sm-4">
            @php
                $banner1 = App\Slider::where('image', 'banner-1.jpg')->first();
            @endphp
            <a href="{{$banner1->link}}">
                <img src="./files/sliders/banner-1.jpg" alt="{{$banner1->title}}"> 
            </a>
        </div> 
        <div class="col-sm-4"> 
            @php
                $banner2 = App\Slider::where('image', 'banner-2.jpg')->first();
            @endphp
            <a href="{{$banner2->link}}">
                <img src="./files/sliders/banner-2.jpg" alt="{{$banner2->title}}"> 
            </a>
        </div> 
        <div class="col-sm-4"> 
            @php
                $banner3 = App\Slider::where('image', 'banner-3.jpg')->first();
            @endphp
            <a href="{{$banner3->link}}">
                <img src="./files/sliders/banner-3.jpg" alt="{{$banner3->title}}"> 
            </a>
        </div> 
    </div>
</div>