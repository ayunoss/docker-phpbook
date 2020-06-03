ymaps.ready(init);

function init() {
    var myPlacemark,
        myGeoObjects,
        myMap = new ymaps.Map('map', {
            center: [55.753994, 37.622093],
            zoom: 10,
            controls: ['smallMapDefaultSet']
        }, {
            searchControlProvider: 'yandex#search'
        })
    BalloonContentLayout = ymaps.templateLayoutFactory.createClass(
        '<div style="margin: 10px;">' +
        '<b>{{properties.address}}</b><br />' +
        '<p>{{properties.coords}}</p> ' +
        '<button id="button"> Save to collection </button>' +
        '</div>', {
            // Переопределяем функцию build, чтобы при создании макета начинать
            build: function () {
                // Сначала вызываем метод build родительского класса.
                BalloonContentLayout.superclass.build.call(this);
                // А затем выполняем дополнительные действия.
                $('#button').bind('click', this.onBtnClick);},
            // Аналогично переопределяем функцию clear, чтобы снять
            // прослушивание клика при удалении макета с карты.
            clear: function () {
                // Выполняем действия в обратном порядке - сначала снимаем слушателя,
                // а потом вызываем метод clear родительского класса.
                $('#button').unbind('click', this.onBtnClick);
                BalloonContentLayout.superclass.clear.call(this);},
            onBtnClick: function () {
                myGeoObjects = {
                    address: myPlacemark.properties._data.address,
                    coords: myPlacemark.properties._data.coords
                }
                console.log(myGeoObjects.coords);
                document.getElementById('createCollectionForm').style.display = 'block';
                document.getElementById('address').value = document.getElementById('address').value + myGeoObjects.address + "\n";
                document.getElementById('coords').value = document.getElementById('coords').value + myGeoObjects.coords + "\n";
            }
        });
    // Слушаем клик на карте.
    myMap.events.add('click', function (e) {
        var coords = e.get('coords');
        // Если метка уже создана – просто передвигаем ее.
        if (myPlacemark) {
            myPlacemark.geometry.setCoordinates(coords);
        }
        // Если нет – создаем.
        else {
            myPlacemark = createPlacemark(coords);
            myMap.geoObjects.add(myPlacemark);
            // Слушаем событие окончания перетаскивания на метке.
            myPlacemark.events.add('dragend', function () {
                getAddress(myPlacemark.geometry.getCoordinates());
            });
        }
        getAddress(coords);
    });
    // Создание метки.
    function createPlacemark(coords) {
        return new ymaps.Placemark(coords, {
            iconCaption: 'поиск...'
        }, {
            balloonContentLayout: BalloonContentLayout,
            preset: 'islands#violetDotIconWithCaption',
            draggable: true,
            balloonPanelMaxMapArea: 0,
            openEmptyBalloon: true
        });
    }
    // Определяем адрес по координатам (обратное геокодирование).
    function getAddress(coords) {
        myPlacemark.properties.set('iconCaption', 'поиск...');
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            myPlacemark.properties.set({
                // Формируем строку с данными об объекте.
                iconCaption: [
                    // Название населенного пункта или вышестоящее административно-территориальное образование.
                    firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                    // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                    firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                ].filter(Boolean).join(', '),
                // В качестве контента балуна задаем строку с адресом объекта и координатами
                address: firstGeoObject.getAddressLine(),
                coords: coords
            });
        });
    }
}
