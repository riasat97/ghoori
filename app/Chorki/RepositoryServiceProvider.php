<?php
/**
 * Created by PhpStorm.
 * User: MOHSIN SHISHIR
 * Date: 3/11/2015
 * Time: 3:11 PM
 */

namespace Chorki;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider{

    public function register() {
        $this->app->bind(
            'Chorki\shops\Models\ShopRepositoryInterface',
            'Chorki\shops\Models\ShopRepositoryDb'
        );
        $this->app->bind(
            'Chorki\banners\Models\BannerRepositoryInterface',
            'Chorki\banners\Models\BannerRepositoryDb'
        );
        $this->app->bind(
           'Chorki\products\Models\ProductRepositoryInterface',
            'Chorki\products\Models\ProductRepositoryDb'
        );
        $this->app->bind(
            'Chorki\Subscription\SubscriptionRepositoryInterface',
            'Chorki\Subscription\EmailSubscriptionRepository'
        );
        $this->app->bind(
            'Chorki\Carts\Models\CartRepositoryInterface',
            'Chorki\Carts\Models\CartRepository'
        );
        $this->app->bind(
            'Chorki\Orders\Models\OrderRepositoryInterface',
            'Chorki\Orders\Models\OrderRepository'
        );
        $this->app->bind(
            'Chorki\Shippings\ShippingAddresses\Models\ShippingRepositoryInterface',
            'Chorki\Shippings\ShippingAddresses\Models\ShippingRepository'
        );
        $this->app->bind(
            'Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannelRepositoryInterface',
            'Chorki\Shippings\OwnShippingChannels\Models\OwnShippingChannelRepository'
        );
        $this->app->bind(
            'Chorki\PreOrders\PreOrderRepositoryInterface',
            'Chorki\PreOrders\PreOrderRepository'
        );
        $this->app->bind(
            'Chorki\PreOrders\Packages\PackageRepositoryInterface',
            'Chorki\PreOrders\Packages\PackageRepository'
        );
        $this->app->bind(
            'Chorki\PreOrders\Images\PreOrderImageRepositoryInterface',
            'Chorki\PreOrders\Images\PreOrderImageRepository'
        );
        $this->app->bind(
            'Chorki\PreOrders\Orders\PreorderOrderRepositoryInterface',
            'Chorki\PreOrders\Orders\PreorderOrderRepository'
        );

    }
}