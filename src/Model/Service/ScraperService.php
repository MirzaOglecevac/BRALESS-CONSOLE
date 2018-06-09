<?php

namespace Model\Service;

use Model\Entity\ResponseBootstrap;
use Symfony\Component\HttpFoundation\Request;
use Model\Entity\Videos;
use Model\Mapper\ScraperMapper;
use Model\Entity\Pornstar;

class ScraperService {
 
    private $scraperMapper;
    
    public function __construct(ScraperMapper $scraperMapper){
        $this->scraperMapper = $scraperMapper;
    }
    
    
   
    public function scrapVideos($html, \DOMDocument $xvideos_doc):ResponseBootstrap {
        
        // create response object
        $response = new ResponseBootstrap();
     
        $xvideos_doc->loadHTML($html);
        libxml_clear_errors();
        
        $xvideos_xpath = new \DOMXPath($xvideos_doc);

        $links = $xvideos_xpath->query("//div[contains(@class, 'thumb')]/a/@href");
        
        $counter = 0;
        
        foreach($links as $link){

            $linkTemp = $link->nodeValue;
            
            $htmlPage = file_get_contents('https://www.xvideos.com' . $linkTemp);
            $xvideos_page = new \DOMDocument();
            $xvideos_page->loadHTML($htmlPage);
            libxml_clear_errors();
            $path = new \DOMXPath($xvideos_page);
            
            
            // get video link
            $xvideos_video = $path->query("//div[contains(@class, 'tabs')]/div[contains(@id, 'tabShareAndEmbed')]/input/@value");
            $videoUnsliced = $xvideos_video[0]->nodeValue;
            
            // take only link data from the text value
            $start = strpos($videoUnsliced, 'https://www.xvideos.com/embedframe');
            $end = strpos($videoUnsliced, 'frameborder');
            $video = substr($videoUnsliced, $start, $end - 15);
            
            // get video views
            $xvideos_views = $path->query("//div[contains(@id, 'video-views-votes')]/span/span/strong");
            $views = $xvideos_views[0]->nodeValue;
            $viewsNoCommas = (int)str_replace(',', '', $views);

            // get video thumbnail
            $xvideos_thumb = $path->query("//img/@src");
   
            foreach($xvideos_thumb as $img){
                $thumbnail = $img->nodeValue;
            }

            //get video title
            $xvideos_title = $path->query("//h2[contains(@class, 'page-title')]");
            $title = $xvideos_title[0]->firstChild->nodeValue;
            
            // get video duration and if is HD or not
            $xvideos_duration_hd = $path->query("//h2[contains(@class, 'page-title')]/span");
            $duration = $xvideos_duration_hd[0]->nodeValue;
            $hd = isset($xvideos_duration_hd[1]) ?  'true' : 'false';

            // get video tags
            $xvideos_tags = $path->query("//div[contains(@class, 'video-metadata video-tags-list ordered-label-list cropped')]/ul/li[position()>1]");
            $tags = [];
            
            if($xvideos_tags->length > 0){
                foreach($xvideos_tags as $row){
                    array_push($tags, $row->nodeValue);
                }
            }
            
            // remove + as tag
            array_pop($tags);
            $tags = implode(', ', $tags);
            
            // call mapper to insert data into database
            if(isset($video) && isset($views) && isset($title) && isset($duration) && isset($hd) && isset($tags) && isset($thumbnail)){
                // create videos entity and set its values
                $videos = new Videos();
                $videos->setTitle($title);
                $videos->setLength($duration);
                $videos->setHd($hd);
                $videos->setVideoUrl($video);
                $videos->setViews($viewsNoCommas);
                $videos->setThumbnail($thumbnail);
                
                $data = $this->scraperMapper->saveScrapedVideosData($videos, $tags);
            }
            
        }
   
        // return response
        $response->setStatus(200);
        $response->setMessage('Success');  
        
        return $response;
  }
       
  
  
  
  public function scrapPornstars($html, \DOMDocument $xvideos_doc):ResponseBootstrap {
      
      // create response object
      $response = new ResponseBootstrap();
      
      $xvideos_doc->loadHTML($html);
      libxml_clear_errors();
      
      $xvideos_xpath = new \DOMXPath($xvideos_doc);
      
      // find all profiles on the page
      $links = $xvideos_xpath->query("//div[contains(@class, 'thumb')]/a/@href");
    
      // get pornstar thumbnail
      $xvideos_thumb = $xvideos_xpath->query("//div[@class='thumb']/a");
      
      $pornstarThumbnails = [];
      
//       foreach($xvideos_thumb as $img){
//           $thumbnail = $img->nodeValue;
//           $start = strpos($thumbnail, 'http');
//           $end = strpos($thumbnail, '.jpg');
//           $thumbnailLink = substr($thumbnail, $start, $end-48);
//           array_push($pornstarThumbnails, $thumbnailLink);
//       }
      
      
      
      $counter = 0;

      foreach($links as $link){
          
          $linkTemp = $link->nodeValue;
          
          $htmlPage = file_get_contents('https://www.xvideos.com' . $linkTemp . '/#_tabAboutMe');
         
          $xvideos_page = new \DOMDocument();
          $xvideos_page->loadHTML($htmlPage);
          libxml_clear_errors();
          $path = new \DOMXPath($xvideos_page);
          
          
          // get pornstar name
          $xvideos_name = $path->query("//span[@class='mobile-hide']/strong[@class='text-danger']");
          $name = $xvideos_name[0]->nodeValue;
          
          // get pornstar gender
          $xvideos_gender = $path->query("//p[@id='pinfo-sex']/span");
          $gender = $xvideos_gender[0]->nodeValue;
          
          
          // get pornstar age
          $xvideos_age = $path->query("//p[@id='pinfo-age']/span");
          $age = (int)$xvideos_age[0]->nodeValue;
          
          // get pornstar country
          $xvideos_country = $path->query("//p[@id='pinfo-country']/span");
          $country = $xvideos_country[0]->nodeValue;
          
          // get pornstar profile views
          $xvideos_profile_views = $path->query("//p[@id='pinfo-profile-hits']/span");
          $profileViews = (int)str_replace(',', '', $xvideos_profile_views[0]->nodeValue);
          
          // get pornstar profile subscribers
          $xvideos_subscribers = $path->query("//p[@id='pinfo-subscribers']/span");
          $subscribers = (int)str_replace(',', '', $xvideos_subscribers[0]->nodeValue);
          
          // get pornstar total video views
          $xvideos_total_video_views = $path->query("//p[@id='pinfo-videos-views']/span");
          $totalVideoViews = (int)str_replace(',', '', $xvideos_total_video_views[0]->nodeValue);
          
          // get pornstar about
          $xvideos_about = $path->query("//p[@id='pinfo-aboutme']");
          $about = $xvideos_about[0]->nodeValue == NULL ? 'About me...' : $xvideos_about[0]->nodeValue;
          
          // get pornstar profile picture
          $xvideos_profile_image = $path->query("//div[@class='profile-pic']/a/img/@src");
          $profileImage = $xvideos_profile_image[0]->nodeValue == NULL ? 'No profile image.' : $xvideos_profile_image[0]->nodeValue;
          
          
          //  && isset($age) && isset($gender) && isset($country) && isset($profileViews) && isset($totalVideoViews) && isset($subscribers)
          
          // call mapper to insert data into database
          if(isset($name)  && isset($profileImage)){
              // create videos entity and set its values
              $pornstar = new Pornstar();
              $pornstar->setName($name);
              $pornstar->setAge($age);
              $pornstar->setCountry($country);
              $pornstar->setSex($gender);
              $pornstar->setDefaultProfileViews($profileViews);
              $pornstar->setDefaultSubscribers($subscribers);
              $pornstar->setDefaultTotalVideoViews($totalVideoViews);
              $pornstar->setAbout($about);
              $pornstar->setProfileImage($profileImage);
              // $pornstar->setProfileImage($pornstarThumbnails[$counter++]);
              
              $data = $this->scraperMapper->saveScrapedPornstarData($pornstar);
          }else {
              $counter++;
          }
          
      }
      
      // return response
      $response->setStatus(200);
      $response->setMessage('Success');
      
      return $response;
  }
  
        
}




