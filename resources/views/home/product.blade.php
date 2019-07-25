@extends('home.frame')

@section('title', $menu->name)
@section('keywords', $menu->keywords)
@section('description', $menu->description)

@section('img', $menu_up->img)
@section('curr_title', $menu_up->name)
@section('curr_ename', $menu_up->ename2)
@section('menu', $menu_up->name)
@section('menu_href', $menu_up->href)
@section('menu_up', '首页')
@section('menu_up_href', '/index')

@section('content')
  <div data-am-widget="tabs" class="am-tabs am-tabs-d2">
	<ul class="am-tabs-nav am-cf solutions-tabs-ul" id="bre-menu-nav">
		@foreach ($model_menu->getSecondMenusFromEname('pro') as $secondMenu)
			<li class="solutions-tabs-ul-li2">
				<a href="{{ $secondMenu->href }}">
					<i class="am-icon-{{ $secondMenu->img }}"></i>
					<span>{{ $secondMenu->name }}</span>
				</a>
	        </li>
	    @endforeach
	</ul>

      <div class="am-tabs-bd solutions-tabs-content">
          <div class="am-tab-panel am-active am-in">

            <ul class="product-show-ul">
            	@foreach ($model->getProductsFromMenuId( $menu->id ) as $product)
            		@if ($leftOrRight = $product->sort % 2)
            			<li>
            		@else
						<li class="bre-bg-color">
					@endif
							<div class="product-content">
							@if (!$leftOrRight)
								<div class="left am-u-sm-12 am-u-md-5 am-u-lg-5 product-content-left">
									<img class="product-img right" src="{{ asset($product->image) }}" />
								</div>
							@endif

							@if ($leftOrRight)
								<div class="left am-u-sm-12 am-u-md-7 am-u-lg-7 product-content-left">
							@else
								<div class="right am-u-sm-12 am-u-md-7 am-u-lg-7 product-content-right">
							@endif
									<div class="product-show-title">
										<h3>{{ $product->name }}</h3>
									</div>
									<div class="product-show-content">
										<div class="product-add">
											<span>购买地址：</span>
											<div>
												@if ($product->href)
													<p><a href="{{ $product->href }}">{{ url($product->href) }}</a></p>
												@else
													<p>正在建设中，敬请期待~</p>
												@endif
											</div>
											<i class="am-icon-dribbble"></i>
										</div>
										<div class="product-intro">
											<span>产品介绍：</span>
											<div>{{ $product->txt }}</div>
											<i class="am-icon-tasks"></i>
										</div>
									</div>
					    		</div>

					    	@if ($leftOrRight)
								<div class="right am-u-sm-12 am-u-md-5 am-u-lg-5 product-content-right">
									<img class="product-img" src="{{ asset($product->image) }}" />
								</div>
							@endif
								<div class="clear"></div>
							</div>
						</li>
				@endforeach
              </ul>  

          </div>
      </div>
  </div>
@stop