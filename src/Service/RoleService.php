<?php

// src/Service/RoleService.php
namespace App\Service;

use App\Repository\OfficeRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Class RoleService
 */
class RoleService
{
    private Security $security;

    private OfficeRepository $officeRepository;

    /**
     * @param Security $security
     * @param OfficeRepository $officeRepository
     */
    public function __construct(Security $security, OfficeRepository $officeRepository)
    {
        $this->security = $security;
        $this->officeRepository = $officeRepository;
    }

    /**
     * @param Security $security
     * @param OfficeRepository $officeRepository
     * @return \App\Entity\Office[]
     */
    public function myOffices() {
        $user = $this->security->getUser();
        return $this->officeRepository->findAll();
    }
}
