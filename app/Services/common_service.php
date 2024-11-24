<?php

namespace App\Services;

use App\Repositories\common_repository;

class common_service
{
    protected $common_repository;

    public function __construct(common_repository $common_repository)
    {
        $this->common_repository = $common_repository;
    }

    public function getAlldetails($table){
       return  $this->common_repository->getAlldetails($table);
    }

    public function updateOrCreateData($where,$data,$table){
        return  $this->common_repository->updateOrCreateData($where,$data,$table);
    }

    public function getUniversityData($table,$where,$relations=NULL){
        return  $this->common_repository->getUniversityData($table,$where,$relations);
    }

    public function DeleteUniversityData($table,$id){
        return  $this->common_repository->DeleteUniversityData($table,$id);
    }

    public function getSyllabusData($id){
        return  $this->common_repository->getSyllabusData($id);
    }

    // Implement service methods here
}
