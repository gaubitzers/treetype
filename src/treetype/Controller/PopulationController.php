<?php
namespace treetype\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use treetype\Entity\Population;
use treetype\Form\PopulationForm;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PopulationController extends AbstractActionController
{

    protected $entityManager;

    public function viewAction ()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $em = $this->getEntityManager();
        $query = $em->createQuery(
                'SELECT p FROM treetype\Entity\Population p where p.id = ?1');
        $query->setParameter(1, $id);
        
        $population = $query->getResult();
        
        return new ViewModel(
                array(
                        'population' => $population
                ));
    }

    public function listAction ()
    {
        $page = $this->params()->fromRoute('id', 1);
        $max = 20;
        
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        $qb = $em->createQueryBuilder();
        
        $qb->select('p')->from('treetype\Entity\Population', 'p');
        
        $query = $qb->getQuery();
        
        $paginator = new Paginator(
                new DoctrinePaginator(new ORMPaginator($query)));
        
        $paginator->setCurrentPageNumber($page)->setItemCountPerPage($max);
        
        $vm = new ViewModel(
                array(
                        'paginator' => $paginator,
                        'query' => $this->params()->fromQuery()
                ));
        return $vm;
    }

    public function addAction ()
    {
        $objectManager = $this->getServiceLocator()->get(
                'Doctrine\ORM\EntityManager');

        $form = new PopulationForm($objectManager);

        $population = new Population();
        $form->bind($population);
        
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                $objectManager->persist($population);
                $objectManager->flush();
                $this->redirect()->toRoute("population", 
                        array(
                                'action' => 'list'
                        ));
            }
        }
        
        return array(
                'form' => $form
        );
    }

    public function deleteAction ()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (! $id) {
            return $this->redirect()->toRoute('population');
        }
        $em = $this->getEntityManager();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            
            if ($del == 'Yes') {
                $population = $em->getRepository('treetype\Entity\Population')->findOneBy(
                        array(
                                'id' => $id
                        ));
                
                $em->remove($population);
                $em->flush();
            }
            
            return $this->redirect()->toRoute('population');
        }
        $population = $em->getRepository('treetype\Entity\Population')->findOneBy(
                array(
                        'id' => $id
                ));
        return array(
                'id' => $id,
                'population' => $population
        );
    }

    public function editAction ()
    {
        // Create the form
        $objectManager = $this->getServiceLocator()->get(
                'Doctrine\ORM\EntityManager');
        $form = new PopulationForm($objectManager);
        
        // Create a new, empty entity and bind it to the form
        // var_dump($this->params()->fromRoute());
        $id = (int) $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();
        $population = $em->getRepository('treetype\Entity\Population')->findOneBy(
                array(
                        'id' => $id
                ));
        $form->bind($population);
        
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                // Save the changes
                // $em->persist($population); // is usefull?
                $objectManager->flush();
                $this->redirect()->toRoute("population");
            }
        }
        
        return array(
                'form' => $form
        );
    }

    protected function setEntityManager (\Doctrine\ORM\EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    protected function getEntityManager ()
    {
        if (null === $this->entityManager) {
            $this->setEntityManager(
                    $this->getServiceLocator()
                        ->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }
}