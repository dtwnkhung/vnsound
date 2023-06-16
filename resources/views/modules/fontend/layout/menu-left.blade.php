<div class="col-sm-3 col-left" id="menu-left">
	<aside class="cate-product-sidebar">
		<div class="title-sidebar">
			<h3><span>Danh mục</span></h3>
		</div>
		<div class="content-sidebar-category">
            <ul>
                @foreach($data['list_category'] as $cate)
                    <li >
                        <a href="{{ url($cate->slug.'.html') }}">
                            <h2>{{$cate->name}}</h2>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
	</aside>
    <aside class="news-sidebar-recent">
		<div class="title-sidebar">
			<h3><span>Tin tức mới nhất</span></h3>
		</div>
        <div class="content-news-recent">
            <ul>
                @if($data['list_news'] && count($data['list_news']) > 0)
                    @foreach($data['list_news'] as $new)
                        <li>
                            <a href="{{ url('tin-tuc/'.$new->slug.'.html') }}">
                                <h4>{{$new->title}}</h4>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </aside>
    <aside class="promo-sidebar">
        <img src="./files/sliders/promo.jpg" alt="quảng cáo" style="width: 100%">
    </aside>
</div>