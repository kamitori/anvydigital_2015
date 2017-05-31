<div class="row">
    <div class="col-xs-12 probox" style="padding-left:15px; padding-right:15px">
    	<h1>{{ $offer['name'] }}</h1>
        <h2>{{ $offer['description'] }}</h2>
    	<div class="row homeproduct">
            @foreach($products as $product)
            <div class="item col-md-4">
                <a href="{{ $product['url'] }}" class="fadeout">
                    <img src="{{ $product['cover'] }}" alt="" class="proimg" style="width:276px; height:184px" />
                    <h2>{{ $product['name'] }}</h2>
                </a>
                <div class="item-description">{{ $product['description'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>