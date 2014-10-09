<?php
namespace treetype\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use treetype\Entity\Site;
use treetype\Entity\Geo;
use treetype\Form\SiteForm;

class SiteController extends AbstractActionController
{

    protected $entityManager;

    public function viewAction ()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $em = $this->getEntityManager();
        $query = $em->createQuery(
                'SELECT s FROM treetype\Entity\Site s where s.id = ?1');
        $query->setParameter(1, $id);
        
         $site = $query->getResult();
        
        return new ViewModel(
                array(
                        'site' => $site
                ));
    }

    public function listAction ()
    {
        $page = $this->params()->fromRoute('id', 1);
        $max = 20;
        
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        $qb = $em->createQueryBuilder();
        
        $qb->select('s')->from('treetype\Entity\Site', 's');
        
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
         // Get your ObjectManager from the ServiceManager
        $objectManager = $this->getServiceLocator()->get(
                'Doctrine\ORM\EntityManager');
        
        // Create the form and inject the ObjectManager
        $form = new SiteForm($objectManager);
        
        // Create a new, empty entity and bind it to the form
        $site = new Site();
        $geo = new Geo();
        $site->setGeo($geo);
        $form->bind($site);
                
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                $objectManager->persist($site);                
                $objectManager->flush();
                $this->redirect()->toRoute("site", 
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
            return $this->redirect()->toRoute('site');
        }
        $em = $this->getEntityManager();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            
            if ($del == 'Yes') {
                $site = $em->getRepository('treetype\Entity\Site')->findOneBy(
                        array(
                                'id' => $id
                        ));
                
                $em->remove($site);
                $em->flush();
            }
            
            return $this->redirect()->toRoute('site');
        }
        $site = $em->getRepository('treetype\Entity\Site')->findOneBy(
                array(
                        'id' => $id
                ));
        return array(
                'id' => $id,
                'site' => $site
        );
    }

    public function editAction ()
    {
               // Create the form
        $objectManager = $this->getServiceLocator()->get(
                'Doctrine\ORM\EntityManager');
        $form = new SiteForm($objectManager);
        
        // Create a new, empty entity and bind it to the form
        //var_dump($this->params()->fromRoute());        
        $id = (int) $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();
        $site = $em->getRepository('treetype\Entity\Site')->findOneBy(
                array(
                        'id' => $id
                ));
        $form->bind($site);
        
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                // Save the changes
                //$em->persist($population); // is usefull?
                $objectManager->flush();
                $this->redirect()->toRoute("site");
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