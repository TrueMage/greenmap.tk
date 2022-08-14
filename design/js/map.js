var pp = document.getElementById('paper');
var p = document.getElementById('plastic');
var m = document.getElementById('metal');
var c = document.getElementById('caps');
var b = document.getElementById('batteries');
var g = document.getElementById('glass');


var markers = [];
var icons = {
  glass: {
    name: "Glass",
    icon: "https://greenmap.tk/design/img/sites/pins/mini/glass.png",
  },
  metal: {
    name: "Metal",
    icon: "https://greenmap.tk/design/img/sites/pins/mini/metal.png",
  },
  paper: {
    name: "Paper",
    icon: "https://greenmap.tk/design/img/sites/pins/mini/paper.png",
  },
  plastic: {
    name: "Plastic",
    icon: "https://greenmap.tk/design/img/sites/pins/mini/plastic.png",
  },
  caps: {
    name: "Caps",
    icon: "https://greenmap.tk/design/img/sites/pins/mini/caps.png",
  },
  batteries: {
    name: "Batteries",
    icon: "https://greenmap.tk/design/img/sites/pins/mini/batteries.png",
  },
};
var pins = [
  {
    position: { lat: 49.498817, lng: 30.754077 },
    type: "metal",
    title: "Укрвтормет",
  },
  {
    position: { lat: 46.478936, lng: 30.641445 },
    type: "metal",
    title: 'ООО "РОЯЛ СИТИ"',
  },
  {
    position: { lat: 46.485673, lng: 30.711963 },
    type: "metal",
    title: 'ООО"Раф-плюс"',
  },
  {
    position: { lat: 46.486597, lng: 30.7286 },
    type: "metal",
    title: 'ООО"МП Эфес"',
  },
  {
    position: { lat: 46.483412, lng: 30.743991 },
    type: "metal",
    title: "Три-Стил",
  },
  {
    position: { lat: 46.464684, lng: 30.587681 },
    type: "metal",
    title: "ВТОРМЕТ-ЭКСПО",
  },
  {
    position: { lat: 46.434489, lng: 30.704775 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.433604, lng: 30.747288 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.431543, lng: 30.70645 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.444472, lng: 30.743423 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.453896, lng: 30.753036 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.461803, lng: 30.713666 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.466954, lng: 30.739132 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.471295, lng: 30.73716 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.474717, lng: 30.747158 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.476508, lng: 30.740171 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.574457, lng: 30.778949 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.574171, lng: 30.797651 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.584181, lng: 30.793744 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.590018, lng: 30.790693 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.588961, lng: 30.804639 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.583171, lng: 30.80897 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.577054, lng: 30.808131 },
    type: "caps",
    title: "Море-Пива",
  },
  {
    position: { lat: 46.393539, lng: 30.722059 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.400923, lng: 30.723969 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.430975, lng: 30.762674 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.435123, lng: 30.760706 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.436017, lng: 30.723159 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.442438, lng: 30.707301 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.443994, lng: 30.677437 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.470227, lng: 30.740011 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.46943, lng: 30.73648 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.477362, lng: 30.739606 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.482673, lng: 30.734484 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.579836, lng: 30.798246 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.584376, lng: 30.794692 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.588232, lng: 30.794683 },
    type: "batteries",
    title: "Цитрус",
  },
  {
    position: { lat: 46.477096, lng: 30.73297 },
    type: "batteries",
    title: "Библиотека им. Грушевского",
  },
  {
    position: { lat: 46.465115, lng: 30.74629 },
    type: "batteries",
    title: 'Эко-кафе "Зелень"',
  },
  {
    position: { lat: 46.497803, lng: 30.724717 },
    type: "batteries",
    title: 'Фото-магазин "Папарацции"',
  },
  {
    position: { lat: 46.486605, lng: 30.730697 },
    type: "batteries",
    title: 'Чайный домик "Небесная роса"',
  },
  {
    position: { lat: 46.48998, lng: 30.72732 },
    type: "batteries",
    title: 'Магазин Эко-товаров "Полоскун"',
  },
  {
    position: { lat: 46.467726, lng: 30.728614 },
    type: "batteries",
    title: 'Студия "Печать"',
  },
  {
    position: { lat: 46.472952, lng: 30.738342 },
    type: "batteries",
    title: 'Магазин "Музыкальная лавка"',
  },
  {
    position: { lat: 46.468396, lng: 30.747217 },
    type: "batteries",
    title: 'Центр горячей йоги "YogaHot"',
  },
  {
    position: { lat: 46.450707, lng: 30.670854 },
    type: "batteries",
    title: 'Автосалон "Автотрейдинг Одесса"',
  },
  {
    position: { lat: 46.473378, lng: 30.673876 },
    type: "glass",
    title: 'Компания "ЭКОМИР"',
  },
  {
    position: { lat: 46.41339, lng: 30.711434 },
    type: "glass",
    title: 'ПП "ЭКОМАРИН"',
  },
  {
    position: { lat: 46.463696, lng: 30.656949 },
    type: "plastic",
    title: "Пункт приёма вторсырье, метала и макулатуры",
  },
  {
    position: { lat: 46.473378, lng: 30.673876 },
    type: "plastic",
    title: 'Компания "ЭКОМИР"',
  },
  {
    position: { lat: 46.429551, lng: 30.695298 },
    type: "plastic",
    title: "Одесский центр приёма вторсырья",
  },
  {
    position: { lat: 46.468924, lng: 30.676435 },
    type: "plastic",
    title: 'Фирма "Сил-верк"',
  },
  {
    position: { lat: 46.501182, lng: 30.635125 },
    type: "paper",
    title: 'ООО "ВТОРРЕСУРСЫ КИЕВСКОГО КАРТОННО-БУМАЖНОГО КОМБИНАТА"',
  },
  {
    position: { lat: 46.51165, lng: 30.688267 },
    type: "paper",
    title: "ТОВ Елизавета-ОД",
  },
  {
    position: { lat: 46.483363, lng: 30.750541 },
    type: "paper",
    title: "Корпорация ЮКАС",
  },
  {
    position: { lat: 46.515065, lng: 30.72261 },
    type: "paper",
    title: "ООО «Капитель Одесса»",
  },
  {
    position: { lat: 46.472035, lng: 30.668942 },
    type: "paper",
    title: "ООО «ЭКО ПРО»",
  },
  {
    position: { lat: 46.605397, lng: 30.815309 },
    type: "paper",
    title: "ЧП «Аргумент»",
  },
  {
    position: { lat: 46.504445, lng: 30.695422 },
    type: "paper",
    title: "ООО, ПЭФ «Уникум»",
  },
];
var paper = false;
var plastic = false;
var metal = false;
var caps = false;
var batteries = false;
var glass = false;
var anim;
var person;

function initMap() {
  var map;
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: { lat: 46.419161, lng: 30.713512 },
    disableDefaultUI: true,
  });

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
        person = new google.maps.Marker({
          position: pos,
          map: map,
          visible: true,
          icon: "https://greenmap.tk/design/img/sites/pins/mini/person.png",
          title: "You are here",
          animation: google.maps.Animation.BOUNCE,
        });
        // markers.push(person);
        map.setCenter(pos);
      },
      function () {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
  anim = google.maps.Animation.DROP;
  var infoWindow = new google.maps.InfoWindow();

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
      browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
  }

  function addMarker(map, array, number) {
    var marker = new google.maps.Marker({
      position: array[number].position,
      map: map,
      title: array[number].title,
      icon: icons[array[number].type].icon,
      visible: false,
    });
    markers.push(marker);
  }

  for (let i = 0; i < pins.length; i++) {
    addMarker(map, pins, i);
  }

  var onMarkermouseover = function () {
    var marke = this;
    infoWindow.setContent(marke.title);
    infoWindow.open(map, marke);
  };
  var kill = function () {
    var markt = this;
    markt.setVisible(false);
  };
  google.maps.event.addListener(map, "mouseover", function () {
    infoWindow.close();
  });
  google.maps.event.addListener(map, "mouseover", onMarkermouseover);
  google.maps.event.addListener(markers, "mouseover", onMarkermouseover);
}

function setAll(bool, type) {
  for (let i = 0; i < pins.length; i++) {
    if (pins[i].type == type) {
      markers[i].setVisible(bool);
      if (!bool) markers[i].setAnimation(null);
      if (bool) markers[i].setAnimation(anim);
    }
  }
}

function Paper() {
  paper = !paper;
  if(paper) pp.style.backgroundColor='#d8d7d6';
  if(!paper) pp.style.backgroundColor='#FFFFFF';
  setAll(paper, "paper");
}

function Plastic() {
  plastic = !plastic;
  if(plastic) p.style.backgroundColor='#3d6250';
  if(!plastic) p.style.backgroundColor='#FFFFFF';
  setAll(plastic, "plastic");
}

function Metal() {
  metal = !metal;
  if(metal) m.style.backgroundColor='#676461';
  if(!metal) m.style.backgroundColor='#FFFFFF';
  setAll(metal, "metal");
}

function Caps() {
  caps = !caps;
  if(caps) c.style.backgroundColor='#527c95';
  if(!caps) c.style.backgroundColor='#FFFFFF';
  setAll(caps, "caps");
}

function Batteries() {
  batteries = !batteries;
  if(batteries) b.style.backgroundColor='#a48e52';
  if(!batteries) b.style.backgroundColor='#FFFFFF';
  setAll(batteries, "batteries");
}

function Glass() {
  glass = !glass;
  if(glass) g.style.backgroundColor='#e7f4fd';
  if(!glass) g.style.backgroundColor='#FFFFFF';
  setAll(glass, "glass");
}
