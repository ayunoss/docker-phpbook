<h1></h1>
<div class="container">
    <h1>Text Viewer</h1>
    <label><?= $_GET['name'] ?> </label>
    <p><?php echo htmlspecialchars($data[$_GET['name']]); ?></p>
    <p>
        <a href="http://ayunoss.phpbook/edit-file/?name=<?= $_GET['name'] ?>"> Edit file </a>
        <a href="http://ayunoss.phpbook/download-file/?name=<?= $_GET['name'] ?>"> Download file </a>
    </p>
    <p>
        <a href="<?php echo $generateUrl('files'); ?>">Files list</a>
    </p>
</div>
