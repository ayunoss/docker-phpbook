<div class="container">
    <form id="form" action="http://ayunoss.phpbook/edit-file/?name=<?= $_GET['name'] ?>" method="post" enctype="multipart/form-data">
    <h1> Edit <?= $_GET['name'] ?></h1>
    <textarea name="text" id="text" cols="60" rows="20"><?php echo htmlspecialchars($data[$_GET['name']]); ?></textarea>
    <p>
        <a href="<?php echo $generateUrl('files'); ?>"> Files list </a>
    </p>
    <p>
        <b><button type="submit" class="btn btn-success"> Save </button></b>
    </p>
    </form>
</div>
