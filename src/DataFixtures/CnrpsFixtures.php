<?php

namespace App\DataFixtures;

use App\Entity\Cin;
use App\Entity\Employee;
use App\Entity\Skills;
use App\Entity\Specialite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CnrpsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $skills = [];
        echo 'start';
        for ($i=0; $i <10; $i++) {
            $skill = new Skills();
            $skill->setDesignation("skill ${i}");
            $manager->persist($skill);
            $skills[$i] = $skill;
        }
        $manager->flush();
        echo 'end of skill load';
        $cins = [];
        for ($i=0; $i <10; $i++) {
            $cin = new Cin();
            $cin->setNumero($faker->numberBetween(100000,999999));
            $cin->setCreatedAt($faker->dateTime);
            $cins[$i] = $cin;
            $manager->persist($cin);
        }
        $manager->flush();
        echo 'end of cin load';
        $specs = [];
        for ($i=0; $i <10; $i++) {
            $spec = new Specialite();
            $spec->setDesignation("specialite ${i}");
            $manager->persist($spec);
            $specs[$i] = $spec;
        }
        $manager->flush();
        echo 'end of spec load';
        for ($i=0; $i <10; $i++) {
            $employee = new Employee();
            $employee->setFullName($faker->name);
            $employee->setDateNaissance($faker->dateTime);
            $employee->setAdresse($faker->address);
            $employee->setCin($cins[$i]);
            $employee->setSpecialite($specs[$i]);
            for ($j=0; $j<3; $j++ ) {
                $employee->addSkill($skills[$faker->numberBetween(0,count($skills)-1)]);
            }
            $manager->persist($employee);
        }
        $manager->flush();
        echo 'end of employees load';
    }
}
