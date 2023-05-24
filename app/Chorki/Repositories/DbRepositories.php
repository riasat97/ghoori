<?php
/**
 * Created by PhpStorm.
 * User: MOHSIN SHISHIR
 * Date: 3/11/2015
 * Time: 2:59 PM
 */

namespace Chorki\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

abstract class DbRepositories {



    public function getAll() {
        return $this->model->all();
    }

    public function getWith($model){
        return $this->model->with($model)->get();
    }

    public function getById($id) {
        return $this->model->findOrFail($id);
    }

    public function getBySlug($slug) {

        return $this->model->where('slug', '=', $slug)->first();
    }
    public function getIdBySlug($slug){
        return $this->model->where('slug','=',$slug)->select('id')->get();
    }

    public function countviewer($countable,$tablePrefix,$countable_id)
    {
        /*$year=Carbon::now()->year;
        $month=Carbon::now()->month;
        $table= $tablePrefix.'-'.$month.'-'.$year;

        if(! Schema::hasTable($table)) {

            Schema::create($table , function($table)use($countable_id)
            {
                $table->increments('id');
                $table->integer($countable_id);
                $table->text('user_id')->nullable();
                $table->string('ip')->nullable();
                $table->text('os')->nullable();
                $table->text('browser')->nullable();
                $table->timestamps();
            });
        }

        $visitor= Tracker::currentSession();
        if(Auth::user()){
            $user_id = Auth::user()->id;
        }
        else{
            $user_id = $visitor->uuid;
        }
        DB::table($table)->insert(
            array(
                $countable_id => $countable->id,
                'user_id' => $user_id,
                'ip' => $visitor->client_ip,
                'os' => (!empty($visitor->device->platform) ? $visitor->device->platform : null ),
                'browser' => (!empty($visitor->agent->browser) ? $visitor->agent->browser : null),
                'created_at'=> Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString()
            )
        );*/
    }
}