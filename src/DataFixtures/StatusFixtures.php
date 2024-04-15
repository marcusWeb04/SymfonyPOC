<?php

namespace App\Datafixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Status;

class StatusFixtures extends Fixture
{
    public const STATUT_EI = "STATUT_EI";
    public const STATUT_EURL = "STATUT_EURL";
    public const STATUT_SA = "STATUT_SA";
    public const STATUT_SARL = "STATUT_SARL";
    public const STATUT_SAS = "STATUT_SAS";
    public const STATUT_SASU = "STATUT_SASU";
    public const STATUT_SCA = "STATUT_SCA";
    public const STATUT_SCS = "STATUT_SCS";
    public const STATUT_SNC = "STATUT_SNC";

    const TYPE_STATUT_LIST = [
        self::STATUT_EI => [
            "name" => "EI",
        ],
        self::STATUT_EURL => [
            "name" => "EURL",
        ],
        self::STATUT_SA => [
            "name" => "SA", 
        ],
        self::STATUT_SARL => [
            "name" => "SARL", 
        ],
        self::STATUT_SAS => [
            "name" => "SAS", 
        ],
        self::STATUT_SASU => [
            "name" => "SASU", 
        ],
        self::STATUT_SCA => [
            "name" => "SCA", 
        ],
        self::STATUT_SCS => [
            "name" => "SCS", 
        ],
        self::STATUT_SNC => [
            "name" => "SNC", 
        ]
    ];
    
    public function load(ObjectManager $manager)
    {

        foreach (self::TYPE_STATUT_LIST as $reference => $data) {
            $status = new Status();
            $status->setName($data['name']);
            $manager->persist($status);

            $this->addReference($reference, $status);
        }

        $manager->flush();
    }
}
