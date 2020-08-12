@extends($templatePath.'.shop_layout')

@section('center')
<style>
.product-grid{font-family:Raleway,sans-serif;text-align:center;padding:0 0 72px;border:1px solid rgba(0,0,0,.1);overflow:hidden;position:relative;z-index:1}
.product-grid .product-image{position:relative;transition:all .3s ease 0s}
.product-grid .product-image a{display:block}
.product-grid .product-image img{width:100%;height:auto}
.product-grid .pic-1{opacity:1;transition:all .3s ease-out 0s}
.product-grid:hover .pic-1{opacity:1}
.product-grid .pic-2{opacity:0;position:absolute;top:0;left:0;transition:all .3s ease-out 0s}
.product-grid:hover .pic-2{opacity:1}
.product-grid .social{width:150px;padding:0;margin:0;list-style:none;opacity:0;transform:translateY(-50%) translateX(-50%);position:absolute;top:60%;left:50%;z-index:1;transition:all .3s ease 0s}
.product-grid:hover .social{opacity:1;top:50%}
.product-grid .social li{display:inline-block}
.product-grid .social li a{color:#fff;background-color:#333;font-size:16px;line-height:40px;text-align:center;height:40px;width:40px;margin:0 2px;display:block;position:relative;transition:all .3s ease-in-out}
.product-grid .social li a:hover{color:#fff;background-color:#ef5777}
.product-grid .social li a:after,.product-grid .social li a:before{content:attr(data-tip);color:#fff;background-color:#000;font-size:12px;letter-spacing:1px;line-height:20px;padding:1px 5px;white-space:nowrap;opacity:0;transform:translateX(-50%);position:absolute;left:50%;top:-30px}
.product-grid .social li a:after{content:'';height:15px;width:15px;border-radius:0;transform:translateX(-50%) rotate(45deg);top:-20px;z-index:-1}
.product-grid .social li a:hover:after,.product-grid .social li a:hover:before{opacity:1}
.product-grid .product-discount-label,.product-grid .product-new-label{color:#fff;background-color:#ef5777;font-size:12px;text-transform:uppercase;padding:2px 7px;display:block;position:absolute;top:10px;left:0}
.product-grid .product-discount-label{background-color:#333;left:auto;right:0}
.product-grid .rating{color:#FFD200;font-size:12px;padding:12px 0 0;margin:0;list-style:none;position:relative;z-index:-1}
.product-grid .rating li.disable{color:rgba(0,0,0,.2)}
.product-grid .product-content{background-color:#fff;text-align:center;padding:12px 0;margin:0 auto;position:absolute;left:0;right:0;bottom:-27px;z-index:1;transition:all .3s}
.product-grid:hover .product-content{bottom:0}
.product-grid .title{font-size:13px;font-weight:400;letter-spacing:.5px;text-transform:capitalize;margin:0 0 10px;transition:all .3s ease 0s}
.product-grid .title a{color:#828282}
.product-grid .title a:hover,.product-grid:hover .title a{color:#ef5777}
.product-grid .price{color:#333;font-size:17px;font-family:Montserrat,sans-serif;font-weight:700;letter-spacing:.6px;margin-bottom:8px;text-align:center;transition:all .3s}
.product-grid .price span{color:red;font-size:13px;font-weight:400;margin-left:3px;display:inline-block}
.product-grid .add-to-cart{color:#000;font-size:13px;font-weight:600}
@media only screen and (max-width:990px){.product-grid{margin-bottom:30px}
}


</style>
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ trans('front.features_items') }}</h2>
                @foreach ($products_new as  $key => $product_new)
                 <div class="col-md-4 col-sm-6" style="margin-bottom: 20px">
            <div class="product-grid">
                <div class="product-image product-box-{{ $product_new->id }}">
                   <a href="{{ $product_new->getUrl() }}"><img src="{{ asset($product_new->getThumb()) }}" alt="{{ $product_new->name }}" /></a>
                    <ul class="social">
         

                         <li>
                          <a data-tip="So Sánh" onClick="addToCartAjax('{{ $product_new->id }}','compare')"><i class="fa fa-plus-square"></i></a>
                          </li>
                        <li>
                          <a onClick="addToCartAjax('{{ $product_new->id }}','wishlist')" data-tip="Yêu Thích">
                            <i class="glyphicon glyphicon-heart"></i>
                          </a>
                        </li>
                       
                        <li>
                           @if ($product_new->allowSale())
                             <a class=" add-to-cart" data-tip="Thêm Giỏ Hàng" onClick="addToCartAjax('{{ $product_new->id }}','default')"><i class="fa fa-shopping-cart"></i></a>
                            @else
                              &nbsp;
                            @endif

                        </li>
                    </ul>
                    <span class="product-new-label">Top</span>
                    <span>
                        @if ($product_new->price != $product_new->getFinalPrice() && $product_new->kind != SC_PRODUCT_GROUP)
                      <img style="    width: 16% !important;" src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}"style="    width: 16% !important;" class="new" alt="" />
                      @elseif($product_new->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}"style="    width: 16% !important;" class="new" alt="" />
                      @elseif($product_new->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt=""style="    width: 16% !important;" />
                      @elseif($product_new->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}"style="    width: 16% !important;" class="new" alt="" />
                      @endif
                    </span>

                      
                </div>
                <ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star disable"></li>
                </ul>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{ $product_new->name }}</a></h3>
                    <div class="price"> {!! $product_new->showPrice() !!}
                        <span> <a href="{{ $product_new->getUrl() }}"><p></p></a>
              </span>
                    </div>
                    
                </div>
            </div>
        </div>
               @endforeach
          </div><!--features_items-->

          <div class="recommended_items" style="    margin-top: 21px;"><!--recommended_items-->
            <h2 class="title text-center">{{ trans('front.products_hot') }}</h2>

            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                @foreach ($products_hot as  $key => $product_hot)
                @if ($key % 3 == 0)
                  <div class="item {{  ($key ==0)?'active':'' }}">
                @endif
                  <div class="col-sm-4">
                    <div class="product-image-wrapper product-single">
                      <div class="single-products   product-box-{{ $product_hot->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product_hot->getUrl() }}"><img src="{{ asset($product_hot->getThumb()) }}" alt="{{ $product_hot->name }}" /></a>
                            {!! $product_hot->showPrice() !!}
                            <a href="{{ $product_hot->getUrl() }}"><p>{{ $product_hot->name }}</p></a>
                            @if ($product_hot->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product_hot->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product_hot->price != $product_hot->getFinalPrice() && $product_hot->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product_hot->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product_hot->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif

                      </div>
                      <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','wishlist')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_wishlist')}}</a></li>
                          <li><a onClick="addToCartAjax('{{ $product_hot->id }}','compare')"><i class="fa fa-plus-square"></i>{{trans('front.add_to_compare')}}</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                @if ($key % 3 == 2 || $key+1 == $products_hot->count())
                  </div>
                @endif
               @endforeach

              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
            </div>
          </div><!--/recommended_items-->

          <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#cate1" data-toggle="tab">{{ trans('front.products_build') }}</a></li>
                  <li><a href="#cate2" data-toggle="tab">{{ trans('front.products_group') }}</a></li>
              </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane fade active in" id="cate1" >
                  @foreach ($products_build as $product)
                    <div class="col-sm-4">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
              </div>
                <div class="tab-pane fade" id="cate2" >
                  @foreach ($products_group as $product)
                    <div class="col-sm-4">
                      <div class="product-image-wrapper product-single">
                        <div class="single-products  product-box-{{ $product->id }}">
                          <div class="productinfo text-center">
                            <a href="{{ $product->getUrl() }}"><img src="{{ asset($product->getThumb()) }}" alt="{{ $product->name }}" /></a>
                            {!! $product->showPrice() !!}
                            <a href="{{ $product->getUrl() }}"><p>{{ $product->name }}</p></a>
                            @if ($product->allowSale())
                             <a class="btn btn-default add-to-cart" onClick="addToCartAjax('{{ $product->id }}','default')"><i class="fa fa-shopping-cart"></i>{{trans('front.add_to_cart')}}</a>
                            @else
                              &nbsp;
                            @endif
                          </div>

                      @if ($product->price != $product->getFinalPrice() && $product->kind != SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/sale.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_NEW)
                      <img src="{{ asset($templateFile.'/images/home/new.png') }}" class="new" alt="" />
                      @elseif($product->type == SC_PRODUCT_HOT)
                      <img src="{{ asset($templateFile.'/images/home/hot.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_BUILD)
                      <img src="{{ asset($templateFile.'/images/home/bundle.png') }}" class="new" alt="" />
                      @elseif($product->kind == SC_PRODUCT_GROUP)
                      <img src="{{ asset($templateFile.'/images/home/group.png') }}" class="new" alt="" />
                      @endif
                        </div>
                      </div>
                    </div>
                @endforeach
                </div>
          </div><!--/category-tab-->


@endsection



@push('styles')
@endpush

@push('scripts')

@endpush
