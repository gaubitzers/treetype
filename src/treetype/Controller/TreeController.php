<?php
namespace treetype\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use treetype\Entity\Tree;
use treetype\Entity\Product;
use treetype\Form\TreeForm;
use treetype\Form\CollectionForm;
use treetype\Form\CreateProduct;
use Zend\Mvc\View\Console\ViewManager;
use Zend\Form\FormInterface;
use elab\Entity\population;
use Zend\Form\Element\DateTime;
use treetype\Entity\Sitedetail;
use treetype\Entity\Geo;

class TreeController extends AbstractActionController
{

    protected $entityManager;

    public function viewAction ()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        $em = $this->getEntityManager();
        $query = $em->createQuery(
                'SELECT t FROM treetype\Entity\Tree t where t.id = ?1');
        $query->setParameter(1, $id);
        
        $tree = $query->getResult();
        
        return new ViewModel(
                array(
                        'tree' => $tree
                ));
    }
    
    public function importAction ()
    {
        return new ViewModel();                
    }

    public function addAction ()
    {
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            
            // Get your ObjectManager
            $objectManager = $this->getEntityManager();
            
            // Create the form and inject the ObjectManager
            $form = new TreeForm($objectManager);
            
            // Create a new, empty entity
            $tree = new Tree();
            $geo = new Geo();
            $sitedetail = new Sitedetail();
            $sitedetail->setGeo($geo);
            $tree->setSitedetail($sitedetail);
            
            $em = $this->getEntityManager();
            $id = $this->zfcUserAuthentication()
                ->getIdentity()
                ->getId();
            
            $query = $em->createQuery(
                    'SELECT u FROM treetype\Entity\User u where u.userId = ?1');
            $query->setParameter(1, $id);
            $user = $query->getResult();
            $tree->setUser($user[0]);
            
            // bind it to the form
            $form->bind($tree);
            
            $request = $this->getRequest();
            if ($request->isPost()) {
                $File = $this->params()->fromFiles('image-upload');
                $post = array_merge_recursive($request->getPost()->toArray(), 
                        $request->getFiles()->toArray());                
                $form->setData($post);                
                if ($form->isValid()) {
                    $data = $form->getData();                    
                    $adapter = new \Zend\File\Transfer\Adapter\Http();
                    //$adapter->setDestination(dirname(__DIR__) . '/images');
                    $adapter->setDestination('./public/img/trees');
                    $adapter->receive($File['name']);

                    // find the image name and set it in the tree table
                    $imagename = $adapter->getFileInfo()['tree_image-upload_']['name'];
                    $tree->setImage($imagename);
                    
                    // save tables in the database
                    $objectManager->persist($tree);
                    $objectManager->flush();                    
                    $this->redirect()->toRoute("tree", 
                            array(
                                    'action' => 'view',
                                    'id' => $tree->getId()
                            ));
                }
            }
            
            return array(
                    'form' => $form
            );
        } else {
            return $this->redirect()->toRoute('zfcuser', 
                    array(
                            'action' => 'login'
                    ));
        }
    }

    public function deleteAction ()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if (! $id) {
            return $this->redirect()->toRoute('tree');
        }
        
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            $em = $this->getEntityManager();
            $tree = $em->getRepository('treetype\Entity\Tree')->findOneBy(
                    array(
                            'id' => $id
                    ));
            if ($this->zfcUserAuthentication()
                ->getIdentity()
                ->getId() == $tree->getUser()->getId()) {
                $request = $this->getRequest();
                if ($request->isPost()) {
                    $del = $request->getPost('del', 'No');
                    
                    if ($del == 'Yes') {
                        $site = $em->getRepository('treetype\Entity\Tree')->findOneBy(
                                array(
                                        'id' => $id
                                ));
                        
                        $em->remove($site);
                        $em->flush();
                    }
                    
                    return $this->redirect()->toRoute('tree');
                }
                return array(
                        'id' => $id,
                        'tree' => $tree
                );
            } else {
                return $this->redirect()->toRoute('zfcuser', 
                        array(
                                'action' => 'login'
                        ));
            }
        } else {
            return $this->redirect()->toRoute('zfcuser', 
                    array(
                            'action' => 'login'
                    ));
        }
    }

    public function editAction ()

    {
        // get Tree ID
        $id = (int) $this->params()->fromRoute('id', 0);

        // get Tree Entity
        $em = $this->getEntityManager();
        $tree = $em->getRepository('treetype\Entity\Tree')->findOneBy(
                array(
                        'id' => $id
                ));

        // check if the user is allowed to edit this tree
        if ($this->zfcUserAuthentication()->hasIdentity()) {
            if ($this->zfcUserAuthentication()->getIdentity()->getId() == $tree->getUser()->getId() ){
                    ;
            }
            else {
                    return $this->redirect()->toRoute('tree', 
                            array(
                                    'action' => 'view',
                                    'id' => $id
                            ));
            }
        } else {
                return $this->redirect()->toRoute('zfcuser', 
                    array(
                         'action' => 'login'
                    ));
        } 

        $objectManager = $this->getServiceLocator()->get(
                'Doctrine\ORM\EntityManager');
        $form = new TreeForm($objectManager);
        
        // Create a new, empty entity and bind it to the form
        
        $form->bind($tree);
        
        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());
            
            if ($form->isValid()) {
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                // If a new File is upladed save the new file and set the name in the table
                if($adapter->isUploaded())
                {
                    $adapter->setDestination('./public/img/trees');
                    $adapter->receive($File['name']);                    
                    $imagename = $adapter->getFileInfo()['tree_image-upload_']['name'];
                    $tree->setImage($imagename);
                    //TODO-->delete the old image
                }
                // Save the changes
                $objectManager->flush();
                $this->redirect()->toRoute("tree", 
                        array(
                                'action' => 'view',
                                'id' => $tree->getId()
                        ));
            }
        }
        
        return array(
                'form' => $form
        );
    }

    public function listAction ()
    {
        $page = $this->params()->fromRoute('id', 1);
        $userid = $this->params()->fromQuery('userid', '');
        $max = 20;
        
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        $qb = $em->createQueryBuilder();
        
        if ($userid == '') {
            $qb->select('t')->from('treetype\Entity\Tree', 't');
        } else {
            $qb->select('t')->from('treetype\Entity\Tree', 't')
                ->where('t.user = ?1') 
                ->setParameter(1, $userid);
        }
        
        $query = $qb->getQuery();
        
        $paginator = new Paginator(
                new DoctrinePaginator(new ORMPaginator($query)));
        
        $paginator->setCurrentPageNumber($page)->setItemCountPerPage($max);
        
        $vm = new ViewModel(
                array(
                        'paginator' => $paginator,
                        'trees' => $this->params()->fromQuery()
                ));
        return $vm;
    }

    public function indexAction ()
    {
        $form = new CreateProduct();
        $product = new Product();
        $form->bind($product);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                var_dump($product);
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
