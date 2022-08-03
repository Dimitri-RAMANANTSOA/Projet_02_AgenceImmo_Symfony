/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

const ACCESS_TOKEN = 'pk.eyJ1IjoiZGltaXRyaXJhbWFuYW50c29hIiwiYSI6ImNsNmJ4M2NudTAxdWYzZW81bHRqZ3V3a3oifQ.ZFBQSWzoAEKqhK77x2ss7w';
const script = document.getElementById('search-js');


let showmap = document.querySelector('#map')
if (showmap !== null)
{
  console.log('map')
  script.onload = () => {
    const minimap = document.querySelector('mapbox-address-minimap');
  
    let lat = showmap.dataset.lat
    let lng = showmap.dataset.lng
    minimap.accessToken = ACCESS_TOKEN;

    if (lat != 0 && lng != 0)
    {
      minimap.feature = {
        type: 'Feature',
        geometry: {
        type: 'Point',
        coordinates: [lat, lng]
        },
        properties: {}
      };
    }
    
  };  
}

let inputCity = document.querySelector('#city_search')
if (inputCity !== null)
{
  console.log('city_search')
  
  script.onload = () => {
    const autofill = document.querySelector('mapbox-address-autofill');

    autofill.accessToken = ACCESS_TOKEN;
    autofill.options = { country: 'fr' };
     
    autofill.addEventListener('retrieve', (event) => {
      const featureCollection = event.detail;
      if (!featureCollection || !featureCollection.features.length) {
        return;
      }
      
      const feature = featureCollection.features[0];

      document.querySelector('#lat').value = feature.geometry.coordinates[0]  
      document.querySelector('#lng').value = feature.geometry.coordinates[1]
    });
  };
}

let inputAddress = document.querySelector('#property_address')
if (inputAddress !== null)
{
  console.log('property_address')
  script.onload = () => {
    const autofill = document.querySelector('mapbox-address-autofill');
    const minimap = document.querySelector('mapbox-address-minimap');

    let lat = document.querySelector('#property_lat').value
    let lng = document.querySelector('#property_lng').value
     
    autofill.accessToken = ACCESS_TOKEN;
    minimap.accessToken = ACCESS_TOKEN;

    if (lat != 0 && lng != 0)
    {
      minimap.feature = {
        type: 'Feature',
        geometry: {
        type: 'Point',
        coordinates: [lat, lng]
        },
        properties: {}
      };
    }
     
    autofill.addEventListener('retrieve', (event) => {
      const featureCollection = event.detail;
      if (!featureCollection || !featureCollection.features.length) {
        minimap.feature = null;
        return;
      }
      
      const feature = featureCollection.features[0];
      minimap.feature = feature;

      document.querySelector('#property_lat').value = feature.geometry.coordinates[0]  
      document.querySelector('#property_lng').value = feature.geometry.coordinates[1]
    });
  };
}

import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import $ from 'jquery';
import { app } from './bootstrap';
require('select2');

$('select').select2();

let $contactButton = $('#contactButton')
$contactButton.click(
    e=> {
        e.preventDefault()
        $('#contactForm').slideDown();
        $contactButton.slideUp();
    }
);

// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
      e.preventDefault()
      fetch(a.getAttribute('href'), {
        method: 'POST',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({'_token': a.dataset.token})
      }).then(response => response.json())
        .then(data => {
          if (data.success) {
            a.parentNode.parentNode.removeChild(a.parentNode)
          } else {
            alert(data.error)
          }
        })
        .catch(e => alert(e))
    })
  })
  