<?php
// Get reference to uploaded image
$image_file = $_FILES["photo"]; //image is the form input file element name
$color="danger";
$hr="#exclamation-triangle-fill";
// Exit if no file uploaded
if (!isset($image_file)) {
    $massage='No file uploaded.';
    $error=array($massage,$color,$hr);
    return($error);
}
// Exit if image file is zero bytes
if (filesize($image_file["tmp_name"]) <= 0) {
   $massage ='Uploaded file has no contents.';
   $error=array($massage,$color,$hr);
   return($error);
    
}
// Exit if is not a valid image file
$image_type = exif_imagetype($image_file["tmp_name"]);
if (!$image_type) {
    $massage='Uploaded file is not an image.';
    $error=array($massage,$color,$hr);
    return($error);
}

// Get file extension based on file type, to prepend a dot we pass true as the second parameter
$image_extension = image_type_to_extension($image_type, true);

// Create a unique image name
$image_name = bin2hex(random_bytes(16)) . $image_extension;

// Move the temp image file to the images directory
move_uploaded_file(
    // Temp image location
    $image_file["tmp_name"],

    // New image location
    __DIR__ . "/img/" . $image_name
);
?>