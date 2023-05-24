<?php

use Chorki\Carts\Models\CartRepositoryInterface;

class SearchController extends \BaseController {
    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }

	public function index(){
		$keyword = Input::get('q') ? Input::get('q') : '';
		$page = Input::get('page') ? Input::get('page'): 1;

		$results = $this->getResults($keyword, $page);

		$paged_query = array_except(Input::query(), Paginator::getPageName());

		$resultWithPagination = Paginator::make($results->response->docs, $results->response->numFound, 24);
		$resultWithPagination->appends($paged_query);

        $cartCount = $this->cart->cartCount();
        $cartContents = $this->cart->cartContent();
        $cartTotal = $this->cart->cartTotal();
        $cart = View::make('_partials.cart',compact('cartCount','cartContents','cartTotal'));

		return View::make('search.show',compact('cart'))
		       ->withQuery($keyword)
           ->withFound($results->response->numFound)
		       ->withResults($results->response->docs)
		       ->withPage($resultWithPagination);
	}

	private function getResults($keyword, $page) {
		$json = file_get_contents($this->getTheUrl($keyword,$page));
       	$obj = json_decode($json);
       	return $obj;
	}

	private function getTheUrl($query, $page=1) {
       $start = ($page - 1) * 24;
       $url = 'http://103.239.252.141:8983/solr/chorkiSearch/chorki?q='.$this->queryuglify($query)
       .'&start='.$start.'&rows=24';
       return $url;
   }

   private function queryuglify($query) {
       return urlencode($query);
   }
}