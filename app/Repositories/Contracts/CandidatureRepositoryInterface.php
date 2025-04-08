<?php

namespace App\Repositories\Contracts;

interface CandidatureRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function getByUser($userId);
    public function getByAnnonce($annonceId);
    public function getByUserAndAnnonce($userId, $annonceId);
    public function create(array $data);
    public function update($id, array $data);
    public function updateStatus($id, $status);
    public function delete($id);
    public function countByUser($userId);
    public function countByAnnonce($annonceId);
    public function countByStatut($statut);
}