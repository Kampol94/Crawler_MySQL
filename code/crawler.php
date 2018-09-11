<?php
    $pageCrawlerResult = '';
    include 'create_db.php';
    
    $pageCrawlerResult = [];
    $crawlerDepth = 2;
    $dbName = 'crawler';
     //connection with database
    $conn = new mysqli($servername, $username, $password, $dbname)
    //check connection with database
    if ($conn->connect_error) 
    {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
     function crawl_page($url, $depth = 5)
    {
        $result = '';
        $hrefArray = [];
        static $seen = array();
        if (isset($seen[$url]) || $depth === 0) {
        if (isset($seen[$url]) || $depth === 0) 
        {
            return;
        }
         $seen[$url] = true;
         $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile($url);
         $anchors = $dom->getElementsByTagName('a');
        $hrefArray = [];
         foreach ($anchors as $element) {
			// Remove anchors
        foreach ($anchors as $element) 
        {   // Remove anchors
            $finalLink = explode("#", $element->getAttribute('href'));
            $link = $finalLink[0];
 			// Add the protocol
			$adres = substr($link, 0, 7);
			$adresS = substr($link, 0, 8);
 			$protocol = 'http://';
			$protocolS = 'https://';
 			if($adres != $protocol && $adresS != $protocolS){
				//echo '<br>Brak protokolu<br><br>';
			if($adres != $protocol && $adresS != $protocolS)
            {
				echo '<br>Brak protokolu<br><br>';
				$link = $url.$link;
			}
 			// Push final link to array
            $hrefArray[] = $link;
        }
        $hrefArray = array_unique($hrefArray);
         foreach ($hrefArray as $href) {
            $result .= '<a href="' . $href . '">' . $href . '</a>';
        }
         return $result;
        return $hrefArray
    }
     if(!empty($_GET['url'])){
    if(!empty($_GET['url']))
    {
        $url = $_GET['url'];
    }
     if(isset($url)) {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
    if(isset($url)) 
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) 
        {
            echo 'Not a valid html!!!';
        } else {
            $pageCrawlerResult = crawl_page($url, 2);
        } 
        else 
        {
            $pageCrawlerResult = crawl_page($url, $crawlerDepth);
            $pageContent = 'Page Content'
            $sqlInsert = "INSERT INTO SitesAwaiting (site) VALUES ('$url')";
            if (mysqli_query($conn, $sql)) 
            {
                echo "Query added successfully".'<br>';
            } 
            else 
            {
                echo "Error creating query " . mysqli_error($conn).'<br>';
            }
            //Links
            foreach ($pageCrawlerResult as $link) 
            {
                $sql = "INSERT INTO SitesViewed (site, content) VALUES ('$url', '$link')";
                if (mysqli_query($conn, $sql)) 
                {
                    //echo "Query added successfully".'<br>';
                } 
                else 
                {
                    echo "Error creating query " . mysqli_error($conn).'<br>';
                }
            }
        }
    }
    // Close connection with database
    $conn -> close();      
?>
 <!DOCTYPE html>
@@ -82,7 +114,10 @@ function crawl_page($url, $depth = 5)
  	</div>
    <div class="result">
        <?php
            echo $pageCrawlerResult;
            foreach ($pageCrawlerResult as $href) 
            {
              echo '<a href = "'.$href.'">'.$href.'</a>';
            }
        ?>
    </div>
  </body>
</html>
