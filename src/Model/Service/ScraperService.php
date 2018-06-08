<?php

namespace Model\Service;

use Model\Entity\ResponseBootstrap;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\Videos;
use Model\Mapper\ScraperMapper;

class ScraperService {
 
    private $scraperMapper;
    
    public function __construct(ScraperMapper $scraperMapper){
        $this->scraperMapper = $scraperMapper;
    }
    
    
    /**
     * Scrap data
     * 
     * @return ResponseBootstrap
     */
    public function scrap($html, \DOMDocument $xvideos_doc):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
     
        $xvideos_doc->loadHTML($html);
        libxml_clear_errors();
        
        $xvideos_xpath = new \DOMXPath($xvideos_doc);

        
        $links = $xvideos_xpath->query("//div[contains(@class, 'thumb')]/a/@href");
        
        foreach($links as $link){
            
            $linkTemp = $link->nodeValue;
            
            // get video link
            $xvideos_video = $xvideos_xpath->query("//div[contains(@class, 'tabs')]/div[contains(@id, 'tabShareAndEmbed')]/input/@value");
            $videoUnsliced = $xvideos_video[0]->nodeValue;
            
            // take only link data from the text value
            $start = strpos($videoUnsliced, 'https://www.xvideos.com/embedframe');
            $end = strpos($videoUnsliced, 'frameborder');
            $video = substr($videoUnsliced, $start, $end - 15);
            
            // get video views
            $xvideos_views = $xvideos_xpath->query("//div[contains(@id, 'video-views-votes')]/span/span/strong");
            $views = $xvideos_views[0]->nodeValue;
            $viewsNoCommas = (int)str_replace(',', '', $views);
            
            //get video title
            $xvideos_title = $xvideos_xpath->query("//h2[contains(@class, 'page-title')]");
            $title = $xvideos_title[0]->firstChild->nodeValue;
            
            // get video duration and if is HD or not
            $xvideos_duration_hd = $xvideos_xpath->query("//h2[contains(@class, 'page-title')]/span");
            $duration = $xvideos_duration_hd[0]->nodeValue;
            $hd = isset($xvideos_duration_hd[1]) ?  'true' : 'false';
            
            // get video tags
            $xvideos_tags = $xvideos_xpath->query("//div[contains(@class, 'video-metadata video-tags-list ordered-label-list cropped')]/ul/li[position()>1]");
            $tags = [];
            
            if($xvideos_tags->length > 0){
                foreach($xvideos_tags as $row){
                    array_push($tags, $row->nodeValue);
                }
            }
            
            // remove + as tag
            array_pop($tags);
            
            
            // create videos entity and set its values
            $videos = new Videos();
            $videos->setTitle($title);
            $videos->setLength($duration);
            $videos->setHd($hd);
            $videos->setVideoUrl($video);
            $videos->setViews($viewsNoCommas);
            
            
            // call mapper to insert data into database
            $data = $this->scraperMapper->saveScrapedData($videos, $tags);
        }
        
        die();
            
        // return response
        $response->setStatus(200);
        $response->setMessage('Success');  
        
        return $response;
  }
       
        
}




