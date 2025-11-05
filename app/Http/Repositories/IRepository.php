<?php
namespace App\Http\Repositories;

interface IRepository{
    //  public function create(array $data);
    public function getAll($filters=[], $order="desc", $sort="created_at",$limit=10);
}