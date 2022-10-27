function initMap() {
	var latlng = new google.maps.LatLng(36.678467, 137.207614);
	var options = {
		zoom: 16,
		center: latlng,
		mapTypeControlOptions: {
			mapTypeIds: ['mono', google.maps.MapTypeId.SATELLITE]
		},
		scrollwheel: false
	};

	var map = new google.maps.Map(document.getElementById("gmap"), options);
	/* 地図style */
	var style = [
		{
			featureType: "all",
			elementType: "labels",
			stylers: [
				{saturation: -100},
				{gamma: 1.08}
			]
		}
	];

	var styledMapOptions = {
		name: '地図'
	};
	var monoType = new google.maps.StyledMapType(style, styledMapOptions);
	map.mapTypes.set('mono', monoType);
	map.setMapTypeId('mono');

	var Marker = new google.maps.Marker({
		position: latlng,
		map: map,
		icon: 'common/images/about/marker.png'
	});

	//var offset = new google.maps.Size(0, 170);
	var infowindow = new google.maps.InfoWindow({
		content: "<div class='gmap-content'><h4>ファイブスターカメラ</h4><p>〒939-8271<br>富山県富山市太郎丸西町1-9-1</p></div>",
		//positon: latlng,
		//pixelOffset: offset
	});

	//infowindow.open(map, lopanMarker);//初期状態で吹き出しを表示させる場合は有効にする 
	google.maps.event.addListener(Marker, 'click', function() {
		infowindow.open(map, Marker);
	});
}
google.maps.event.addDomListener(window, 'load', initMap);