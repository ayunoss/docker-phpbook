<form id="form" method="post" action="<?php echo $generateUrl('fileUpload'); ?>" enctype="multipart/form-data">
    <div class="container">
        <h1>Here you can upload files</h1>
    </div>
    <div class="container">
        <label>Choose files</label>
        <input class="form-img" id="files" type="file" name="files[]" multiple>
    </div>
    <span class="error"></span>
    <div class="container">
        <input type="submit" class="btn btn-success">
    </div>

    </div>
</form>
<script src="/public/js/uploadFile.js"></script>