<?php
/**
 * Created by PhpStorm.
 * User: riasatraihan
 * Date: 3/18/2015
 * Time: 11:30 AM
 */

namespace Chorki\shops\Commands;


use Chorki\shops\Models\Shop;
use Chorki\shops\Models\ShopRepositoryInterface;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use User;

class PostShopListingCommandHandler implements CommandHandler{

    use DispatchableTrait;

    protected $shop,$shopRepositoryDb;

    function __construct( ShopRepositoryInterface $shopRepositoryDb)
    {

        $this->shopRepositoryDb = $shopRepositoryDb;
    }


    public function handle($command)
    {
        $clean_mobile_number = preg_replace('/^([+]?88)?/', '', $command->mobile);

        $shop = Shop::post(
            $command->title,
            $command->description,
            $command->address,
            $command->email,
            $clean_mobile_number,
            $command->user_id,
            $command->subDomain,
            $command->pickUpAddress,
            $command->package
        );

        $user = User::find($command->user_id);
        $user->name = $command->name;
        $user->nationalId=$command->nationalId;
        $user->drivingLicense=$command->drivingLicense;
        $user->passport=$command->passport;
        $user->birthCertificate=$command->birthCertificate;
        $user->save();

        $this->shopRepositoryDb->save($shop);
        $this->dispatchEventsFor($shop);

        return $shop;
    }
}