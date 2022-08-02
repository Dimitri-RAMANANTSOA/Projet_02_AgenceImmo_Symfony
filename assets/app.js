/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

const ACCESS_TOKEN = 'pk.eyJ1IjoiZGltaXRyaXJhbWFuYW50c29hIiwiYSI6ImNsNmJ3ejZpMjAwcW8zam8xajRnbW14MmkifQ.UpCFZNaipaV6FGFudt6UPQ';

let inputAddress = document.querySelector('#property_address')
if (inputAddress !== null)
{
  const script = document.getElementById('search-js');
  script.onload = () => {
      const autofill = document.querySelector('mapbox-address-autofill');
      
      autofill.accessToken = ACCESS_TOKEN;
      
      autofill.addEventListener('retrieve', (event) => {
        const featureCollection = event.detail;
        if (!featureCollection || !featureCollection.features.length) {
        return;
        }
        
        const feature = featureCollection.features[0];

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
  