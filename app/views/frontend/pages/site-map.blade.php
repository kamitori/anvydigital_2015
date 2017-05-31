<div class="row">
    <div class="col-md-10 col-md-offset-1 probox ">
    	<h1>{{ $category['name'] }}</h1>
        <h1>HERE</h1>
    	<div class="row homeproduct">
            @foreach($products as $product)
            <div class="item col-md-3">
                <a href="{{ $product['url'] }}" class="fadeout">
                  
                    <h5>{{ $product['name'] }}</h5>
                </a>
               
            </div>
            @endforeach
        </div>
    </div>
</div>