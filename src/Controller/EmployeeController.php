<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/add/{name}/{adresse}", name="employee.add.random")
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
     * @Route("/add/{id?0}", name="employee.add")
     */
    public function addEmployee(Request $request, Employee $employee = null) {
        if (!$employee)
            $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($employee);
            $manager->flush();
            return $this->redirectToRoute('employee.list');
        }
        return $this->render('employee/add.html.twig',  [
           'form' => $form->createView()
        ]);
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
