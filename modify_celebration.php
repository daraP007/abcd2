<?php
session_start();
require_once 'db_configuration.php';
require_once 'bin/functions.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: loginForm.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: admin_celebrations.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title            = trim($_POST['title'] ?? '');
    $description      = trim($_POST['description'] ?? '');
    $resource_type    = trim($_POST['resource_type'] ?? '');
    $celebration_type = trim($_POST['celebration_type'] ?? '');
    $celebration_date = trim($_POST['celebration_date'] ?? '');
    $tags             = trim($_POST['tags'] ?? '');
    $resource_url     = trim($_POST['resource_url'] ?? '');
    $image_name       = trim($_POST['image_name'] ?? '');

    $sql = "UPDATE celebrations_tbl
            SET title=?, description=?, resource_type=?, celebration_type=?, celebration_date=?, tags=?, resource_url=?, image_name=?
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
    if ($stmt->execute()) {
        header('Location: admin_celebrations.php');
        exit;
    } else {
        $error = 'Update failed: '.$db->error;
    }
}

$q = $db->prepare("SELECT id, title, description, resource_type, celebration_type, celebration_date, tags, resource_url, image_name
                   FROM celebrations_tbl WHERE id=?");
$q->bind_param('i', $id);
$q->execute();
$result = $q->get_result();
$cele = $result->fetch_assoc();
if (!$cele) {
    header('Location: admin_celebrations.php');
    exit;
}

$page_title = 'Project ABCD > Modify Celebration';
include 'header.php';
?>
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<div class="container mt-4 mb-5" style="max-width:900px;">
    <h2 class="mb-4">Modify Celebration</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <form method="post" action="modify_celebration.php?id=<?php echo (int)$cele['id']; ?>">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Title</label>
                <input name="title" class="form-control" value="<?php echo htmlspecialchars($cele['title']); ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Date</label>
                <input type="date" name="celebration_date" class="form-control" value="<?php echo htmlspecialchars($cele['celebration_date']); ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($cele['description']); ?></textarea>
            </div>

            <div class="col-md-4">
                <label class="form-label">Resource Type</label>
                <input name="resource_type" class="form-control" value="<?php echo htmlspecialchars($cele['resource_type']); ?>">
            </div>

            <div class="col-md-4">
                <label class="form-label">Celebration Type</label>
                <select name="celebration_type" class="form-select">
                    <?php
                    $types = ['Person','Event','Religious'];
                    foreach ($types as $t) {
                        $sel = ($cele['celebration_type'] === $t) ? 'selected' : '';
                        echo "<option value=\"".htmlspecialchars($t)."\" $sel>".htmlspecialchars($t)."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Image Name</label>
                <input name="image_name" class="form-control" value="<?php echo htmlspecialchars($cele['image_name']); ?>">
                <div class="form-text">File name in images/celebrations/</div>
            </div>

            <div class="col-12">
                <label class="form-label">Tags</label>
                <input name="tags" class="form-control" value="<?php echo htmlspecialchars($cele['tags']); ?>">
            </div>

            <div class="col-12">
                <label class="form-label">Resource URL</label>
                <input name="resource_url" class="form-control" value="<?php echo htmlspecialchars($cele['resource_url']); ?>">
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="admin_celebrations.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

