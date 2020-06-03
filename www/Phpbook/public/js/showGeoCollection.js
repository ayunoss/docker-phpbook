$(document).ready (function () {
    $("#chooseCollection").bind('click', function (event) {
        event.preventDefault();
        $.ajax ({
            url: "/maps/collections",
            type: "POST",
            data: ({
                chooseCollection: $("#collection").val(),
            }),
            dataType: "html",
            success: function (data) {
                console.log(data);
                data = JSON.parse(data);
                if (data.status === 'success') {
                    ymaps.ready(init);
                    function init() {
                        let myMap = new ymaps.Map('map', {
                            center: [55.753994, 37.622093],
                            zoom: 9,
                            controls: ['smallMapDefaultSet']
                        }, {
                            searchControlProvider: 'yandex#search'
                        })
                        console.log(data.coords);

                        $.each(data.coords, function(key, value) {
                            var myGeoObject = new ymaps.GeoObject({
                                // Описание геометрии.
                                geometry: {
                                    type: "Point",
                                    coordinates: "[" + value + "]"
                                },
                                // Свойства.
                                properties: {
                                    // Контент метки.
                                    iconContent: 'Я тащусь',
                                    hintContent: 'Ну давай уже тащи'
                                }
                            }, {
                                preset: 'islands#violetDotIconWithCaption',
                                draggable: true
                            });
                            console.log(value);
                            ymaps.geoQuery(myGeoObject).addToMap(myMap);
                        });

                    }
                }
            }
        })
        document.getElementById("mapContainer").style.display = 'block';
    })
});