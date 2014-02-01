<?php

namespace Sam\XboxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	
    	error_reporting(E_ALL);
    	ini_set('display_errors', '1');
    	
    	$users = array("white whidow", "yusukiho", "big budha haze", "SevenCircle9");
    	$filled = new ArrayCollection();
    	
    	$info = file_get_contents('https://widget.live-ca.callofduty.com/widgets/mycod/xbox/Njk3Mjc2NDoxMzkyMzgxNDg2ODIzOmQyNjVlZjdjYjI3YzY2NjFhNmQ5MGNjZDA2ODc1NTM2');
    	
    	
    	//xit(var_dump(strpos($info, "({"))); 
    	//exit(var_dump(json_decode($info)));
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    	foreach ($users as $user) {
    		
    		curl_setopt($ch, CURLOPT_URL, 'https://www.xboxleaders.com/api/profile.json?gamertag='.urlencode($user));
    		$output = curl_exec($ch);
    		
    		//exit(var_dump($output));
    		
    		$filled->add(json_decode(html_entity_decode($output)));
    		
    		
    		
    		
    		
    		
    		
    		
    	}
    	
    	//exit(var_dump($filled));
    	
        return $this->render('SamXboxBundle:Default:index.html.twig', array('info' => json_decode($info), 'filled' => $filled));
    }
}
