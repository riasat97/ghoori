<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/10/2015
 * Time: 5:36 PM
 */

namespace Chorki\products\Commands;

use Chorki\products\Models\Product;
use Chorki\products\Models\ProductRepositoryDb;
use Chorki\products\Models\ProductRepositoryInterface;
use Chorki\shops\Models\Shop;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Symfony\Component\Security\Core\User\User;


class PostProductListingCommandHandler implements CommandHandler {
    use DispatchableTrait;

    protected $product;
    /**
     * @var ProductRepositoryDb
     */
    protected $productRepositoryDb;

    function __construct(ProductRepositoryInterface $productRepositoryDb)
    {

        $this->productRepositoryDb = $productRepositoryDb;
    }

    public function handle($command){

        $product =  Product::post(
        $command->name,$command->description,$command->price,$command->category_id,
        $command->subcategory_id,$command->subSubCategory_id,$command->stock,
        $command->weight,$command->weightunit,$command->shop_id);
        $this->productRepositoryDb->save($product);
        // $this->dispatcher->dispatch($product->releaseEvents());
        $this->dispatchEventsFor($product);
        return $product;
    }


}