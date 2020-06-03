<h1>Select the file you want to view</h1>
<table border="1">
    <tr>
        <th> file_name </th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($data as $key => $item) : ?>
        <tr>
            <td>
                <a href="http://ayunoss.phpbook/file/?name=<?= $key ?>"><?php echo $key; ?></a>
            </td>
            <td>
                <a href="http://ayunoss.phpbook/download-file/?name=<?= $key ?>"><i class="fas fa-download"></i></a>
            </td>
            <td>
                <a href="http://ayunoss.phpbook/edit-file/?name=<?= $key ?>"><i class="fas fa-edit"></i></a>
            </td>
            <td>
                <a href="http://ayunoss.phpbook/delete-file/?name=<?= $key ?>"><i class="far fa-trash-alt"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="<?php echo $generateUrl('fileUpload'); ?>">Upload file</a>
</p>