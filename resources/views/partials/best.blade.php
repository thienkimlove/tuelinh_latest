<div class="box">
    <div class="box-heading">Sản phẩm bán chạy</div>
    <div class="box-content">
        <div class="box-product">
            @foreach ($bestSeller as $product)
                <div>
                    <div class="image">
                        <a href="{{url($product->slug.'.html')}}">
                            <img
                                    src="{{url('images/medium/'. $product->image)}}"
                                    alt="{{$product->title}}">
                        </a>
                    </div>
                    <div class="name">
                        <a href="{{url($product->slug.'.html')}}">{{$product->title}}</a>
                    </div>
                    <div class="price">{{$product->price}}</div>
                    <div class="cart">
                        <input value="Thêm vào giỏ"
                               onclick="addToCart('{{$product->id}}');"
                               class="button"
                               type="button" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>