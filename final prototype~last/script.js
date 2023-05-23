//weekdays
const weekday = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];

const d = new Date();
let day = weekday[d.getDay()];
//to fetch the data
const phpFetch = (city) => {
  if (localStorage.getItem(city)) {
    data = JSON.parse(localStorage.getItem(city));
    display(data);
    console.log("from local storage");
  } else {
    fetch("weather.php?city=" + city)
      .then((res) => res.json())
      .then((data) => {
        localStorage.setItem(city, JSON.stringify(data));
        console.log("from web api");
        display(data);
      });
  }
};

//to display the data
function display(data) {
  document.body.style.backgroundImage =
    "url('https://cdn.pixabay.com/photo/2015/01/28/23/35/hills-615429_960_720.jpg')";
  document.querySelector(
    ".info h1"
  ).innerHTML = `${data.name}, ${data.sys.country} `;
  document.querySelector(".tempreture").innerHTML = `${data.main.temp} °C`;
  document.querySelector(
    ".weather img"
  ).src = `http://openweathermap.org/img/w/${data.weather[0].icon}.png`;
  document.querySelector(".descripion").innerHTML = data.weather[0].description;
  document.querySelector(".wind").innerHTML = `Wind: ${data.wind.speed} km/hr`;
  document.querySelector(
    ".humidity"
  ).innerHTML = `Humidity: ${data.main.humidity} %`;
  document.querySelector(".month").innerHTML = `${day}`;
}

//if the enter key is pressed
document.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    inputEnter();
  }
});

//take the input
function inputEnter() {
  let input = document.querySelector("input").value;
  phpFetch(input);
}
//default city
phpFetch("Paterson");
