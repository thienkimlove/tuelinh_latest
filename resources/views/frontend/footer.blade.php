<style type="text/css">
<!--
.style1 {font-weight: bold}
.style4 {color: #999999}
.style5 {color: #5e3a2e}
-->
</style>
<footer class="footer" id="footer">
    <nav class="menu-footer">
        <ul class="fix">
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
            <li><a href="{{url('lien-he')}}" title="">{{trans('common.index_footer_lien_he')}}</a></li>
        </ul>
    </nav>
    <div class="fix">
      <div class="copyright style1">
          <p>Ch&#7911; s&#7903; h&#7919;u: C&Ocirc;NG TY TNHH TU&#7878; LINH - M&atilde; s&#7889; doanh nghi&#7879;p: 0101262964 </p>
          <p>&#272;&#7883;a ch&#7881;: T&#7847;ng 5, T&ograve;a nh&agrave; 29T1, Ho&agrave;ng &#272;&#7841;o Th&uacute;y, H&agrave; N&#7897;i</p>
          <p>&#272;i&#7879;n tho&#7841;i: (024) 62824344 - Fax: 024.62824263</p>
          <p>Email: contact@tuelinh.com </p>
          <p><a href="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=15649" target="_blank"><img src="http://tuelinh.vn/images/bg/thongbaoweb.png" width="200" height="76" border="0" longdesc="http://online.gov.vn/HomePage/CustomWebsiteDisplay.aspx?DocId=15649" /></a></p>
      </div>
    </div>
</footer>
