<?php
namespace Chorki\Composers;
 
use Illuminate\Support\ServiceProvider;
 
class ComposerServiceProvider extends ServiceProvider {
 
  public function register()
	{
      /*  $this->app->bind('Chorki\Composers\ThemeCategoryTree', function($app)
        {
            new ThemeCategoryTree($this->app->make('Chorki\themes\products\ThemeProductRepository'));
        });*/
	}
	 
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
	  $this->app->view->composer('_partials.header', 'Chorki\Composers\NewOrdersCountForShopsComposer');
	  $this->app->view->composer('shops.myshop._partials.header', 'Chorki\Composers\NewOrdersCountForShopsComposer');
      $this->app->view->composer(['themes.theme_1.home._partials.category_sidebar','themes.theme_1._partials.default_subheader', 'themes.theme_2.home.home', 'themes.theme_2.product.product', 'themes.theme_2._partials.theme-header'],
            'Chorki\Composers\ThemeCategoryTree');
      $this->app->view->composer(['themes.theme_1.home._partials.sidebar_product'],
            'Chorki\Composers\ThemeSideBarProductsComposer');
      $this->app->view->composer(['_partials.cart'],
            'Chorki\Composers\Carts\CartsComposer');
    $this->app->view->composer('shops.myshop._layouts.main',
            'Chorki\Composers\ProductOverFlow');
	}


 
}