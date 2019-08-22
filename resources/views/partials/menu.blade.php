<div id="header">
    <div id="logo"><a href="{{url('/')}}"><img src="{{url('files/trai-cay-nhap-khau-fruit-shop.jpg')}}" title="CHOSACHCUAME" alt="CHOSACHCUAME" /></a></div>


    <div id="search">
        <div class="button-search"></div>
        <input type="text" name="search" placeholder="Tìm kiếm" value="" />
    </div>
</div>
<div id="menu">
    <ul>
        <li><a href="{{url('/')}}">TRANG CHỦ</a></li>
        @foreach ($categories->slice(0, 6) as $cate)
        <li>
            <a href="{{url($cate->slug)}}">{{str_limit($cate->title, 10)}}</a>
        </li>
        @endforeach
    </ul>
</div>
<div id="notification">@include('flash::message')</div>
<div id="column-left">
    <div class="box">
        <div class="box-heading">DANH MỤC</div>
        <div class="box-content">
            <ul class="box-category">
                @foreach ($categories as $cate)
                <li><div>
                        <a href="{{url($cate->slug)}}">{{str_limit($cate->title, 15)}}</a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="box">
        <div class="box-heading">Sản Phẩm Mới</div>
        <div class="box-content">
            <div class="new-product">
                <div class="box-product">
                    @foreach ($newProducts as $product)
                    <div>
                        <div class="image">
                            <a href="{{url($product->slug.'.html')}}">
                                <img src="{{url('images/small/'. $product->image)}}" alt="{{$product->title}}" />
                            </a>
                        </div>
                        <div class="name">
                            <a href="{{url($product->slug.'.html')}}">{{$product->title}}</a>
                        </div>
                        <div class="price">{{$product->price}} VND</div>
                    </div>
                   @endforeach
                </div>
            </div></div>
    </div>
    <div class="box">
        <div class="box-heading">Sản phẩm bán chạy</div>
        <div class="box-content">
            <div class="box-product">
                @foreach ($bestSellerProducts as $product)
                <div>
                    <div class="image">
                        <a href="{{url($product->slug.'.html')}}">
                            <img src="{{url('images/small/'. $product->image)}}" alt="{{$product->title}}" />
                        </a>
                    </div>
                    <div class="name"><a href="{{url($product->slug.'.html')}}">{{$product->title}}</a></div>
                    <div class="price">{{$product->price}}</div>
                    <div class="cart"><input type="button" value="Thêm vào giỏ" onclick="addToCart('{{$product->id}}}');" class="button" /></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>