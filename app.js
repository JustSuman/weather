function time() {
  let time = new Date();
  let weekDays = [
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday",
  ];
  let months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  document.querySelector(".month").innerHTML =
    weekDays[time.getDay() - 1] +
    ", " +
    months[time.getMonth()] +
    " " +
    time.getDate();
}
time();

async function weather(city) {
  let appId = "ff481f559fea02934cdb1cf3a79b991a";
  try {
    const resp = await fetch(
      `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${appId}`
    );
    if (resp.status == 200) {
      const data = await resp.json();
      display(data);
    } else {
      throw new Error(":( Location not found");
    }
  } catch (error) {
    window.alert("Location not found!!");
  }
}
function display(data) {
  //tempreture
  document.querySelector(".temperature").innerHTML = `${data.main.temp} °C`;
  //country name
  document.querySelector(
    ".city"
  ).innerHTML = `${data.name}, ${data.sys.country}`;
  document.getElementById(
    "city"
  ).innerHTML = `${data.name}, ${data.sys.country}`;
  //weather icon
  document.querySelector(
    ".weather img"
  ).src = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
  //weather description
  document.querySelector(".description").innerHTML =
    data.weather[0].description;
  //wind
  document.querySelector(".wind").innerHTML = `WIND: ${data.wind.speed} km/hr`;
  //humidity
  document.querySelector(
    ".humidity"
  ).innerHTML = `HUMIDITY: ${data.main.humidity}%`;
}

document.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    inputEnter();
  }
});
function inputEnter() {
  let input = "";
  input = document.querySelector("input").value;
  weather(input);
}
weather("Paterson");
// let arr = ["Paterson", "New York", "London", "Paris", "Tokyo", "Moscow"];
// function moreLocation(arr) {
//   let i = 0;
//   setInterval(function () {
//     console.log(weather(arr[i]));
//     i++;
//     if (i == arr.length) {
//       i = 0;
//     }
//   }, 5000);
// }
// console.log(moreLocation(arr));
