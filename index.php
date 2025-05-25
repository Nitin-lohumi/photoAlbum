<?php
$imagesPerPage = 6;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$imageDir = __DIR__ . '/images/';
$allowedExtensions = ['jpg', 'jpeg', 'png'];
$maxFileSize = 4 * 1024 * 1024;
$uploadError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $fileName = basename($file['name']);
    $fileSize = $file['size'];
    $fileTmp = $file['tmp_name'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedExtensions)) {
        $uploadError = "Unsupported file type. Only JPG, JPEG, PNG allowed.";
    } elseif ($fileSize > $maxFileSize) {
        $uploadError = "File size exceeds 4MB limit.";
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadError = "Error uploading file.";
    } else {
        $newFileName = uniqid('img_', true) . '.' . $fileExt;
        $destination = $imageDir . $newFileName;

        if (move_uploaded_file($fileTmp, $destination)) {
            header("Location: index.php?page=$page");
            exit;
        } else {
            $uploadError = "Failed to move uploaded file.";
        }
    }
}
$allImages = array_filter(scandir($imageDir), function ($file) use ($allowedExtensions, $imageDir) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return in_array($ext, $allowedExtensions) && is_file($imageDir . $file);
});

$filesWithTime = [];
foreach ($allImages as $file) {
    $filesWithTime[$file] = filemtime($imageDir . $file);
}
asort($filesWithTime);
$allImages = array_keys($filesWithTime);

$totalImages = count($allImages);
$totalPages = ceil($totalImages / $imagesPerPage);
if ($page > $totalPages) $page = $totalPages;

$startIndex = ($page - 1) * $imagesPerPage;
$imagesToShow = array_slice($allImages, $startIndex, $imagesPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Photo Album</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">

        <h1>Photo Album</h1>

        <form id="uploadForm" action="index.php?page=<?= $page ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" accept=".jpg,.jpeg,.png" required />
            <button type="submit">Upload Image</button>
        </form>
        <?php if ($uploadError): ?>
            <p class="error"><?= htmlspecialchars($uploadError) ?></p>
        <?php endif; ?>
        <div class="album">
            <div class="left-column">
                <?php
                for ($i = 0; $i < 3; $i++) {
                    if (isset($imagesToShow[$i])) {
                        $imgPath = 'images/' . $imagesToShow[$i];
                        echo "<div class='image-wrapper'><img src='$imgPath' alt='Image' loading='lazy' /></div>";
                    }
                }
                ?>
            </div>
            <div class="right-column">
                <?php
                for ($i = 3; $i < 6; $i++) {
                    if (isset($imagesToShow[$i])) {
                        $imgPath = 'images/' . $imagesToShow[$i];
                        echo "<div class='image-wrapper'><img src='$imgPath' alt='Image' loading='lazy' /></div>";
                    }
                }
                ?>
            </div>
        </div>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="index.php?page=<?= $page - 1 ?>" class="btn">Previous</a>
            <?php else: ?>
                <span class="btn disabled">Previous</span>
            <?php endif; ?>

            <span>Page <?= $page ?> of <?= $totalPages ?: 1 ?></span>

            <?php if ($page < $totalPages): ?>
                <a href="index.php?page=<?= $page + 1 ?>" class="btn">Next</a>
            <?php else: ?>
                <span class="btn disabled">Next</span>
            <?php endif; ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>