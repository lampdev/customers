<?php

namespace Acme\CustomersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\CustomersBundle\Document\Report;
use Acme\CustomersBundle\Document\Swindler;
use Acme\CustomersBundle\Document\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\User;


class SendReportController extends Controller
{
    public function indexAction(Request $request)
    {

    	// header("Location: /app_dev.php/sendreport");
    	$report = new Report();
        $swindler = new Swindler();
        $dm = $this->get('doctrine_mongodb')->getManager();
        // $gettingData = $dm->createQueryBuilder('AcmeCustomersBundle:Swindler')
        //           ->field('name')->equals('aaaa')
        //           ->field('surname')->equals('aaaa')
        //           ->field('companyname')->equals('aaaa')
        //           ->limit(1)
        //           ->getQuery()
        //           ->execute();
        //           echo "<pre>";
        //           foreach ($gettingData as $val) {
        //             $des = $val->getDescription();
        //           }
        //             $doc = $dm->createQueryBuilder('AcmeCustomersBundle:Swindler')
        //               ->update()
        //               ->field('description')->set($des . "\r\nasd")
        //               ->field('name')->equals('aaaa')
        //               ->field('surname')->equals('aaaa')
        //               ->field('companyname')->equals('aaaa')
        //               ->getQuery()
        //               ->execute();
        //               var_dump($doc['updatedExisting']);
        //                       foreach ($doc as $key => $someSwindler) {
        //     // $swindlerName     = $someSwindler->getName();
        //     // $swindlerSurname  = $someSwindler->getSurname();
        //     // $swindlerCompName = $someSwindler->getCompanyname();
        //     var_dump($key . '/' . $someSwindler); echo"<br>";
        // }
        //        $doc = $dm->createQueryBuilder('AcmeCustomersBundle:Swindler')
        //           ->field('name')->Equals('aaaa')
        //           ->getQuery()
        //           ->execute();
        //           echo "<pre>";
        // foreach ($doc as $someSwindler) {
        //     // $swindlerName     = $someSwindler->getName();
        //     // $swindlerSurname  = $someSwindler->getSurname();
        //     // $swindlerCompName = $someSwindler->getCompanyname();
        //     print_r($someSwindler); echo"<br>";
        // }

        // if (($swindlerName=='aaa/aa')&&
        //     ($swindlerSurname=='aaaa')&&
        //     ($swindlerCompName=='aaaa')) {
        //     $doc = $dm->createQueryBuilder('AcmeCustomersBundle:Swindler')
        //               ->update()
        //               ->field('name')->set('aaaa')
        //               ->field('name')->equals('aaa/aa')
        //               ->getQuery()
        //               ->execute();
        //               echo "<pre>";
        //     foreach ($doc as $someSwindler) {
        //         print_r($someSwindler); echo"<br>";
        //     }                
        // }
        // var_dump(ucwords(mb_strtolower('d1aDDs')));

         // die();

    	$form = $this->createFormBuilder($report)
    				 ->add('description', 'textarea', array(
                                                            'attr' => array(
                                                                            'cols' => '300', 
                                                                            'rows' => '7',
                                                                            'style' => 'resize: none'
                                                                            )
                                                            )
                        )
    				 ->add('file','file', array(
                                                'required' => true,
                                                'label'=>'File: (pdf/html/gif/jpeg/png)'
                                                )
                        )
                     ->add('swname','text', array('label'=>'First Name'))
                     ->add('swsurname','text', array('label'=>'Second name'))
                     ->add('swcompany','text', array('label'=>'Company name','required'=>false))
                     ->add('swdescript','textarea', array(  
                                                            'label'=>'Info:',
                                                            'attr' => array(
                                                                            'cols' => '300', 
                                                                            'rows' => '5',
                                                                            'style' => 'resize: none'
                                                                            )
                                                            )
                        )
                     ->add('photo','file', array(
                                                'required' => true,
                                                'label'=>'Photo: (image)'
                                                )
                        )
                     ->add('swcontacts','textarea', array(
                                                            'label'=>'Contacts:',
                                                            'attr' => array(
                                                                            'cols' => '300', 
                                                                            'rows' => '4',
                                                                            'style' => 'resize: none'
                                                                            )
                                                            )
                     )
    				 ->add('Send', 'submit', array(
                                                    'attr' => array(
                                                                    'style' => 'margin-right:15px; margin-top:15px',
                                                                    'class' => 'btn btn-default'
                                                                    )
                                                    )
                         )
		             ->getForm();
                     
		$form->handleRequest($request);

	    if ($form->isValid()) {

            $userName = $this->get('security.context')->getToken()->getUser()->getUsername();
            
            $dm = $this->get('doctrine_mongodb')->getManager();

            $dataToDataBase = $form->getData();
            $filename = array();
// echo "<pre>";var_dump($_FILES);die();
            foreach ($_FILES as $someFile) {
                $filename['file'] = $someFile['name']['file'];
                $filename['photo'] = $someFile['name']['photo'];
                // var_dump($filename); echo"</br>";
            }
            // die();
            // echo "<pre>";var_dump($_FILES);die();
            $report->setUser       ($userName);
            $report->setDescription($dataToDataBase->getDescription());
            $report->setDocs       ($report->getFileFullPath($filename['file']));
            $report->setPhotolink  ($report->getPhotoFullPath($filename['photo']));
            $report->setTopublic   (false);

            $report->upload();

            $swindlerName     = (ucwords(mb_strtolower($report->getSwname())));
            $swindlerSurname  = (ucwords(mb_strtolower($report->getSwsurname())));
            $swindlerCompName = (ucwords(mb_strtolower($report->getSwcompany())));
            $swindlerDiscr    = (ucfirst($report->getSwdescript()));

            $gettingData = $dm->createQueryBuilder('AcmeCustomersBundle:Swindler')
                              ->field('name')       ->equals($swindlerName)
                              ->field('surname')    ->equals($swindlerSurname)
                              ->field('companyname')->equals($swindlerCompName)
                              ->getQuery()
                              ->execute();

            $des = '';
            foreach ($gettingData as $val) {
                $des = $val->getDescription();
            }

            $doc = $dm->createQueryBuilder('AcmeCustomersBundle:Swindler')
                      ->update()
                      ->field('description')->set($des . "\r\n" . $swindlerDiscr)
                      ->field('name')       ->equals($swindlerName)
                      ->field('surname')    ->equals($swindlerSurname)
                      ->field('companyname')->equals($swindlerCompName)
                      ->getQuery()
                      ->execute();

            if ($doc['updatedExisting']==false) {
                $swindler->setName       (ucwords(mb_strtolower($swindlerName)));
                $swindler->setSurname    (ucwords(mb_strtolower($swindlerSurname)));
                $swindler->setDescription($swindlerDiscr);
                $swindler->setPhotolink  ($report->getPhotolink());
                $swindler->setContacts   ($report->getSwcontacts());
                $swindler->setCompanyname(ucwords(mb_strtolower($swindlerCompName)));
                $swindler->setTopublic   (false);
                $swindler->upload();
                $dm->persist($swindler);
            }


            $dm->persist($report);
            $dm->flush();


	        return $this->redirect($this->generateUrl('acme_customers_new'));
	    }

        return $this->render('AcmeCustomersBundle:SendReport:report.html.twig', array(
            'report' => $form->createView(),
        ));
    }

    public function okAction()
    {
    	return $this->render('AcmeCustomersBundle:SendReport:ok.html.twig');
    }

    public function prePersist($report) {
        $this->saveFile($report);
    }

    public function preUpdate($report) {
        $this->saveFile($report);
    }

    public function saveFile($report) {
        $basepath = $this->getRequest()->getBasePath();
        $report->upload($basepath);
    }
}
