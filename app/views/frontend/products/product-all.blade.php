<div class="row">
    <div class="col-md-10 col-md-offset-1 probox ">
    	<h1>{{ $category['name'] }}</h1>
    	<div class="row homeproduct">
            @foreach($products as $product)
            <div class="item col-md-3">
                <a href="{{ $product['url'] }}" class="fadeout">
                    <img src="{{ $product['cover'] }}" alt="" class="proimg" style="width:276px; height:184px" />
                    <h2>{{ $product['name'] }}</h2>
                </a>
                <div class="item-description">{{ $product['short_description'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>