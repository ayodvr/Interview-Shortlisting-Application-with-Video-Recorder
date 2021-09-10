<?php

if(isset($_FILES["video"])){

    $fileName = "myvideo.webm";

    $uploadDirectory = '/UploadedVideos'. $fileName;

    if(!move_uploaded_file($_FILES["video"]["tmp_name"], $uploadDirectory)) {
        echo("Could not upload video");
    }
}else{
    echo "No file upload";
}

?>