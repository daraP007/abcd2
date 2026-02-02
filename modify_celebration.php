<?php
// require_once 'bin/debug_config.php'; //uncomment if debugging is needed

//  Session / includes  
session_start();
require_once 'db_configuration.php';
require_once 'bin/functions.php';

// admin check and redirect
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Unauthorized access. Admin privileges are required.');
            window.location.href = 'loginForm.php';
          </script>";
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: admin_celebrations.php');
    exit;
}

$error = '';
$allowedTypes = ['Person', 'Event', 'Religious'];
$MAX_VARCHAR = 255;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $id = isset($_POST['id']) ? (int)$_POST['id'] : $id;
    $title             = trim($_POST['title']            ?? '');
    $description       = trim($_POST['description']      ?? '');
    $resource_type     = trim($_POST['resource_type']    ?? '');
    $celebration_type  = trim($_POST['celebration_type'] ?? '');
    $celebration_date  = trim($_POST['celebration_date'] ?? '');
    $tags              = trim($_POST['tags']             ?? '');
    $resource_url      = trim($_POST['resource_url']     ?? '');
    $image_name        = trim($_POST['image_name']       ?? '');
    $image_name        = basename($image_name); 

    
    if ($title === '') {
        $error = 'Title is required.';
    } elseif (mb_strlen($title) > $MAX_VARCHAR) {
        $error = 'Title is too long (max 255).';
    }

    if ($error === '' && $celebration_type !== '') {
        if (!in_array($celebration_type, $allowedTypes, true)) {
            $error = 'Invalid celebration type.';
        }
    }

    if ($error === '' && $celebration_date !== '') {
        $dt = DateTime::createFromFormat('Y-m-d', $celebration_date);
        if (!$dt || $dt->format('Y-m-d') !== $celebration_date) {
            $error = 'Date must be valid (YYYY-MM-DD).';
        }
    }

    if ($error === '' && $resource_url !== '' && !filter_var($resource_url, FILTER_VALIDATE_URL)) {
        $error = 'Resource URL is invalid.';
    }

    if ($error === '' && (mb_strlen($image_name) > $MAX_VARCHAR || preg_match('/[\/\\\\]/', $image_name))) {
        $error = 'Image name must be a simple filename up to 255 chars.';
    }


    if ($error === '') {
        $sql = "UPDATE celebrations_tbl
                   SET title=?,
                       description=?,
                       resource_type=?,
                       celebration_type=?,
                       celebration_date=?,
                       tags=?,
                       resource_url=?,
                       image_name=?
                 WHERE id=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param(
            'ssssssssi',
            $title,
            $description,
            $resource_type,
            $celebration_type,
            $celebration_date,
            $tags,
            $resource_url,
            $image_name,
            $id
        );
        $stmt->execute();
        $stmt->close();

        header('Location: admin_celebrations.php?updated=1');
        exit;
    }
}

$q = $db->prepare("SELECT id, title, description, resource_type, celebration_type, celebration_date, tags, resource_url, image_name
                     FROM celebrations_tbl
                    WHERE id=?");
$q->bind_param('i', $id);
$q->execute();
$result = $q->get_result();
$cele = $result->fetch_assoc();
$q->close();

if (!$cele) {
    header('Location: admin_celebrations.php');
    exit;
}

$page_title = 'Project ABCD > Modify Celebration';
include('header.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/list_celebrations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
</head>

<div class="container my-4">
    <h2 id="title">Modify Celebration</h1>

    <?php if (!empty($error)): ?>
    <div class="alert alert-danger mt-3" role="alert">
        <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <h2 id="section-heading" class="mt-4">Edit Celebration</h2>
    <p class="instruction">Update the fields below and click <strong>Save Changes</strong>.</p>

    <form method="post" class="mt-3">
        <input type="hidden" name="id" value="<?= (int)$cele['id'] ?>">

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input name="title" class="form-control" maxlength="255"
                       value="<?= htmlspecialchars($cele['title']) ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Resource Type</label>
                <input name="resource_type" class="form-control" maxlength="255"
                       value="<?= htmlspecialchars($cele['resource_type']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Celebration Type</label>
                <select name="celebration_type" class="form-control">
                    <?php
                    $curr = $cele['celebration_type'] ?? '';
                    foreach ($allowedTypes as $opt) {
                        $sel = ($curr === $opt) ? 'selected' : '';
                        echo "<option value=\"".htmlspecialchars($opt)."\" $sel>".htmlspecialchars($opt)."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Celebration Date</label>
                <input type="date" name="celebration_date" class="form-control"
                       value="<?= htmlspecialchars($cele['celebration_date']) ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($cele['description']) ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tags (comma-separated)</label>
                <input name="tags" class="form-control"
                       value="<?= htmlspecialchars($cele['tags']) ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label">Image Name (e.g., mypic.png)</label>
                <input name="image_name" class="form-control" maxlength="255"
                       value="<?= htmlspecialchars($cele['image_name']) ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Resource URL</label>
                <input name="resource_url" class="form-control"
                       value="<?= htmlspecialchars($cele['resource_url']) ?>">
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="admin_celebrations.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
<footer class="page-footer text-center">
    <br>
    <p>© Summer 2025 Team DOLPHIN 🐬</p>
</footer>
