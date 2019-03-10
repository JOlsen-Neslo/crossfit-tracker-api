<?php

namespace App\Repository;


use App\Entity\ApiEntity;

interface IRepository
{

    public function create(ApiEntity $entity): ApiEntity;

    public function update(ApiEntity $entity): ApiEntity;

}