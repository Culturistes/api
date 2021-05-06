if (document.querySelector('#map')) {
    let latInput = document.querySelector('#FunCityName_latitude')
    let longInput = document.querySelector('#FunCityName_longitude')
    
    let lat = 46.232192999999995
    let long = 2.209666999999996
    let zoom = 4
    let marker = null
    if (latInput.value.length > 0 && longInput.value.length > 0) {
        lat = latInput.value
        long = longInput.value
        zoom = 6
        marker = L.marker([lat, long]);
    }

    let mymap = L.map('map').setView([lat, long], zoom);

    if (marker !== null) {
        console.log('la')
        marker.addTo(mymap)
    }
    
    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}.png', {
            attribution: '©OpenStreetMap, ©CartoDB'
    }).addTo(mymap);

    const search = new GeoSearch.GeoSearchControl({
        provider: new GeoSearch.OpenStreetMapProvider(),
      });
    
      var searchControl = mymap.addControl(search);

      mymap.on('geosearch/showlocation', (result) => {
          latInput.value = result.location.raw.lat
          longInput.value = result.location.raw.lon
      });
}
