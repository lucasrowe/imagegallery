<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- imageGallery -->
    <link rel="stylesheet" href="css/imagegallery.css" />

    <!-- justifiedGallery -->
    <link rel="stylesheet" href="justifiedGallery/justifiedGallery.min.css" />

    <!-- swipebox -->
    <link rel="stylesheet" href="swipebox/src/css/swipebox.min.css">

  </head>

  <body>
    <h1>Hello, world!</h1>

    <div id="mygallery">

    <?php

    // This code grabbed from
    // https://davidwalsh.name/generate-photo-gallery

    /* function:  generates thumbnail */
    function make_thumb($src,$dest,$desired_width) {
    	/* read the source image */
    	$source_image = imagecreatefromjpeg($src);
    	$width = imagesx($source_image);
    	$height = imagesy($source_image);
    	/* find the "desired height" of this thumbnail, relative to the desired width  */
    	$desired_height = floor($height*($desired_width/$width));
    	/* create a new, "virtual" image */
    	$virtual_image = imagecreatetruecolor($desired_width,$desired_height);
    	/* copy source image at a resized size */
    	imagecopyresized($virtual_image,$source_image,0,0,0,0,$desired_width,$desired_height,$width,$height);
    	/* create the physical thumbnail image to its destination */
    	imagejpeg($virtual_image,$dest);
    }

    /* function:  returns files from dir */
    function get_files($images_dir,$exts = array('jpg')) {
    	$files = array();
    	if($handle = opendir($images_dir)) {
    		while(false !== ($file = readdir($handle))) {
    			$extension = strtolower(get_file_extension($file));
    			if($extension && in_array($extension,$exts)) {
    				$files[] = $file;
    			}
    		}
    		closedir($handle);
    	}
    	return $files;
    }

    /* function:  returns a file's extension */
    function get_file_extension($file_name) {
    	return substr(strrchr($file_name,'.'),1);
    }

    /** settings **/
    $images_dir = 'photos/';
    $thumbs_dir = 'photos-thumbs/';
    $thumbs_width = 1000;
    $images_per_row = 3;

    /** generate photo gallery **/
    $image_files = get_files($images_dir);
    if(count($image_files)) {
    	$index = 0;
    	foreach($image_files as $index=>$file) {
    		$index++;
    		$thumbnail_image = $thumbs_dir.$file;
    		if(!file_exists($thumbnail_image)) {
    			$extension = get_file_extension($thumbnail_image);
    			if($extension) {
    				make_thumb($images_dir.$file,$thumbnail_image,$thumbs_width);
    			}
    		}
		    echo '<a href="',$images_dir.$file,'" class="justifiedGallery swipebox" rel="gallery"><img src="',$thumbnail_image,'" /></a>';
    	}
    }
    else {
    	echo '<p>There are no images in this gallery.</p>';
    }
    ?>
  </div>


    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

    <!--swipebox lightbox plugin -->
    <script src="swipebox/lib/jquery-2.1.0.min.js"></script>
    <script src="swipebox/src/js/jquery.swipebox.min.js"></script>

    <!-- justifiedGallery plugin -->
    <script src="justifiedGallery/jquery.justifiedGallery.min.js"></script>

    <!-- Run our gallery scripts -->
    <script src="imagegallery.js"></script>

  </body>
</html>
