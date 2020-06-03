<h1>Mapsmaps</h1>
<p>
    <div id="map" style="width: 700px; height: 500px"></div>
</p>
<form action="<?php echo $generateUrl('maps'); ?>" method="post" id="createCollectionForm" style="display: none">
    <p>
        <label>Name of your collection</label>
        <input type="text" name="collectionName" id="collectionName">
    </p>
    <p>
        <label id="addressLabel">Address</label>
        <textarea name="address" id="address" style="width:400px; height:150px;"></textarea>
    </p>
    <p>
        <label id="coordsLabel">Coordinates</label>
        <textarea name="coords" id="coords" style="width:400px; height:150px;"></textarea>
    </p>
    <p>
        <button type="submit" class="btn btn-success">Create</button>
    </p>
</form>
<p>
    <a href="<?php echo $generateUrl('geoCollection'); ?>"> View geo collections </a>
</p>
<script src="/public/js/searchGeo.js"></script>
<script src="/public/js/createGeoCollection.js"></script>
