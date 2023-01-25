<?php
class ImageResizer
{
  public static function resizeImage($file)
  {
    $sourcePath = $file["tmp_name"];

    list($wid, $ht, $ty) = getimagesize($sourcePath);
    $ext = self::MimeToExtension(self::mime($file));

    $new_file = substr(hash("sha256", time()), 0, 40);
    $filename = $new_file . "." . $ext;

    //$sourcePath = "images/" . $filename;
    $bigPath = IMAGES . "big-lightgallry/" . $filename;
    $thumbPath = IMAGES . "thumb-lightgallry/" . $filename;

    $ratio = $ht / $wid;
    $new_width = 1024; // assign new width to new resized image
    $new_height = $ratio * 1024;

    $thumb_new_width = 250; // assign new width to new resized image
    $thumb_new_height = $ratio * 250;

    $image = ImageCreateTrueColor($new_width, $new_height);
    $thumbImage = ImageCreateTrueColor($thumb_new_width, $thumb_new_height);

    if ($ty == IMAGETYPE_JPEG) {
      $originalImage = imagecreatefromjpeg($sourcePath);
      imagecopyresampled($image, $originalImage, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
      imagejpeg($image, $bigPath);
      imagecopyresampled($thumbImage, $originalImage, 0, 0, 0, 0, $thumb_new_width, $thumb_new_height, $wid, $ht);
      imagejpeg($thumbImage, $thumbPath);
    } elseif ($ty == IMAGETYPE_GIF) {
      $originalImage = imagecreatefromgif($sourcePath);
      imagecopyresampled($image, $originalImage, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
      imagegif($thumbImage, $bigPath);
      imagecopyresampled($thumbImage, $originalImage, 0, 0, 0, 0, $thumb_new_width, $thumb_new_height, $wid, $ht);
      imagegif($thumbImage, $thumbPath);
    } elseif ($ty == IMAGETYPE_PNG) {
      $originalImage = imagecreatefrompng($sourcePath);
      imagecopyresampled($image, $originalImage, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
      imagepng($thumbImage, $bigPath);
      imagecopyresampled($thumbImage, $originalImage, 0, 0, 0, 0, $thumb_new_width, $thumb_new_height, $wid, $ht);
      imagepng($thumbImage, $thumbPath);
    }

    return ["hashed_filename" => $filename];
  }

  private static function mime($file)
  {
    if (!file_exists($file["tmp_name"])) {
      return false;
    }
    if (!function_exists("finfo_open")) {
      throw new Exception("Function finfo_open() doesn't exist");
    }

    $finfo_open = finfo_open(FILEINFO_MIME_TYPE);
    $finfo_file = finfo_file($finfo_open, $file["tmp_name"]);
    finfo_close($finfo_open);

    list($mime) = explode(";", $finfo_file);
    return $mime;
  }

  private static function MimeToExtension($mime)
  {
    $arr = [
      "image/jpeg" => "jpeg", // for both jpeg & jpg.
      "image/png" => "png",
      "image/gif" => "gif",
      "application/msword" => "doc",
      "application/vnd.openxmlformats-officedocument.wordprocessingml.document" => "docx",
      "application/pdf" => "pdf",
      "application/zip" => "zip",
      "application/vnd.ms-powerpoint" => "ppt",
    ];
    return isset($arr[$mime]) ? $arr[$mime] : null;
  }

  private static function getFileName($file)
  {
    $filename = pathinfo($file["name"], PATHINFO_FILENAME);
    $filename = preg_replace("/([^A-Za-z0-9_\-\.]|[\.]{2})/", "", $filename);
    $filename = basename($filename);
    return $filename;
  }
}
?>