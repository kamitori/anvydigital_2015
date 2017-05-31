<?php
class OffersController extends BaseController {

	public function index($offerName)
	{
		$offer = ProductOffer::where('short_name', 'like', '%'.$offerName.'%')
						->first();
		if( !is_object($offer) ) {
			return App::abort(404);
		}
		if( $offer->short_name !== $offerName ) {
			return Redirect::to(URL.'/offers/'.$offer->short_name);
		}
		$offerId = $offer->id;
		$products = Product::select('products.id', 'name', 'short_name', 'products_offers.description')
									->with('cover')
									->join('products_offers', function($join) use($offerId) {
										$join->on('products.id', '=', 'products_offers.product_id')
										                 ->where('products_offers.offer_id', '=', $offerId);
									})
									->orderBy('products_offers.id', 'asc')
									->get();
		if( !$products->isEmpty() ) {
			$products = $products->toArray();
			foreach($products as $k => $product) {
				$cover = '';
				if( isset($product['cover']) && isset($product['cover'][0]) ) {
					$cover = URL.'/'.str_replace('assets/images/products', 'assets/images/products/thumbs', $product['cover'][0]['path']);
				}
				$products[$k]['cover'] = $cover;
				$products[$k]['url'] = URL.'/products/'.$product['short_name'];
			}
		} else {
			$products = [];
		}

		if( $offer->meta_title ) {
			$this->layout->metaInfo['title_site'] = $offer->meta_title;
		}
		if( $offer->meta_description ){
			$this->layout->metaInfo['meta_description'] = $offer->meta_description;
		}
		$this->layout->content = View::make('frontend'.$this->mobiledir.'.offers.index')->with([
																		'offer' 	=> $offer->toArray(),
																		'products' 	=> $products
																	]);
	}
}