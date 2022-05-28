@extends('layouts.master')
@section('titulo')
Perfil
@endsection
@section('body')
<div class="container my-5">
    <div class="col-12  "></div>
    <div class="container my-5 py-5 px-5 bg-light shadow-sm">
        <div class="col-12 col-lg-12 col-sm-12">
            <div class="row ">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div id='map' style='width: 400px; height: 300px;'></div>
                            <script>
                                mapboxgl.accessToken = 'pk.eyJ1IjoiYWxleGlua3NwZWxsIiwiYSI6ImNsMHdrNHFtczA3bjgzZXBvODE3Y2ppdXMifQ.NNZ0CaX__fpRKsqrmmZYgQ';
                                const map = new mapboxgl.Map({
                                    container: 'map', // container ID
                                    style: 'mapbox://styles/mapbox/streets-v11', // style URL
                                    center: [-8.4197741, 43.3730082, 18.4], // starting position [lng, lat]
                                    zoom: 15 // starting zoom
                                });
                                const geojson = {
                                    type: 'FeatureCollection',
                                    features: [{
                                        type: 'Feature',
                                        geometry: {
                                            type: 'Point',
                                            coordinates: [-8.4197741, 43.3730082]
                                        }
                                    }]
                                };

                                // add markers to map
                                for (const feature of geojson.features) {
                                    // create a HTML element for each feature
                                    const el = document.createElement('div');
                                    el.className = 'marker';

                                    // make a marker for each feature and add to the map
                                    new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(map);
                                }
                            </script>
                        </div>
                        <div class="col-6 fs-5  mt-5 text-dark">
                            {{__('We are an online store designed for PIMES and small entrepreneurs who cannot afford to have theirown website offering a very affordable annual contract and a very low sales rates')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<br>

@endsection