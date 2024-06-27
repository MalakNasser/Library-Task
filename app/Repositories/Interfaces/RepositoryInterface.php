<?php


namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function create(array $data);
    public function Update($id, array $data);
    public function Find($id);
}
