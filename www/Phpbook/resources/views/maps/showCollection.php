<form action="<?php echo $generateUrl('geoCollection'); ?>" method="post" id="chooseCollectionForm">
    <p> <b>Please select collection to view</b>
        <select class="form-control" name="chooseCollection">
            <option selected disabled>Choose collection</option>
            <?php foreach ($data as $item) : ?>
                <option id="collection" value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <b><button type="submit" class="btn btn-success" id="chooseCollection">Show collection</button></b>
    </p>
    <p>
        <a href="<?php echo $generateUrl('maps'); ?>"> Create geo collection </a>
    </p>
</form>
<span id="mapContainer" style="display: none">
<div id="map" style="width: 700px; height: 500px"></div>
</span>
<script src="/public/js/showGeoCollection.js"></script>