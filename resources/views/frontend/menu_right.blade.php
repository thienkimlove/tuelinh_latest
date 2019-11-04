<div class="menu-right" id="menu-right">
    <div class="inner">
        <a href="javascript:void(0)" title="Menu" class="btn-menu" id="btn-menu">Menu</a>
        <div class="search">
            <div class="search-in">
                <form>
                    <input type="text" name="keyword" class="txt" placeholder="Từ khóa tìm kiếm"/>
                    <input type="submit" name="submit" class="btn-find" value=""/>
                </form>
            </div>
        </div>
        <nav>
            <ul class="nav-mobile">
               <li class="active">
                    <a href="{{url('/')}}" title="">Trang chủ</a>
                </li>
                <li class="has-sub">
                    <a href="#" title="">Tuệ Linh</a>
                    <ul>
                        <li>
                            <a href="{{url('lich-su-hinh-thanh')}}" title="">{{trans('common.recommend_cate')}}</a>
                        </li>
                        <li>
                            <a href="{{url('tam-nhin-su-menh')}}" title="">{{$cates['tam-nhin-su-menh']}}</a>
                        </li>
                        <li>
                            <a href="{{url('thanh-tuu')}}" title="">Thành tựu</a>
                        </li>
                        @if ($current == 'vi')
                            <li>
                                <a href="{{url('tam-nhin-su-menh/tuyen-dung')}}" title="">{{$cates['tuyen-dung']}}</a>
                            </li>
                            <li class="last">
                                <a href="{{url('tam-nhin-su-menh/hoat-dong-doanh-nghiep')}}" title="">{{$cates['hoat-dong-doanh-nghiep']}}</a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{url('san-pham')}}" title="">Sản phẩm</a>
                </li>
                <li class="has-sub">
                    <a href="#" title="">Tin y dược</a>
                    <ul>
                        <li>
                            <a href="{{url('thong-tin-suc-khoe/me-va-be')}}" title="">Mẹ &amp; bé</a>
                        </li>
                        <li>
                            <a href="{{url('thong-tin-suc-khoe/y-hoc-co-truyen')}}" title="">Y học cổ truyền</a>
                        </li>
                        <li>
                            <a href="{{url('thong-tin-suc-khoe/khoe-va-dep')}}" title="">Khỏe và đẹp</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#" title="">Tra cứu</a>
                    <ul>
                        <li>
                            <a href="{{url('dai-cuong-ve-benh')}}" title="">Đại cương về bệnh</a>
                        </li>
                        <li>
                            <a href="{{url('tim-thuoc-theo-benh')}}" title="">Tìm thuốc theo bệnh</a>
                        </li>
                        <li>
                            <a href="{{url('thuoc-nam-tri-benh')}}" title="">Thuốc nam trị bệnh</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{url('he-thong-phan-phoi')}}" title="">Hệ thống phân phối</a></li>

                <li><a href="{{url('lien-he')}}" title="">Liên hệ</a></li>
            </ul>
        </nav>
    </div>
</div>