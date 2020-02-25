<?php

namespace App\Controller;

use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employee")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route("/", name="employee.list")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Employee::class);
        $employees = $repository->findAll();
        return $this->render('employee/index.html.twig', [
            'listeDesEmployees' => $employees
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/add/{name}/{adresse}", name="employee.add")
     */
    public function addSomeRandomEmployee($name, $adresse) {
        $manager = $this->getDoctrine()->getManager();
        $employee = new Employee();
        $employee->setFullName($name);
        $employee->setAdresse($adresse);
        $employee->setDateNaissance(new \DateTime());
        $manager->persist($employee);
        $manager->flush();
        return $this->redirectToRoute('employee.list');
    }

    /**
     * @param $id
     * @Route("/{id}", name="employee.profil")
     */
    public function employeeProfil(Employee $employee=null) {
        return $this->render('employee/profile.html.twig',[
            'employee' => $employee
        ]);
    }
}
