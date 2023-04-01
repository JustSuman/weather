function time() {
    let time = new Date();
    let weekDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    document.querySelector(".month").innerHTML = weekDays[time.getDay() - 1] + ", " + months[time.getMonth()] + " " + time.getDate();
}
time()

async function weather(city) {
    let appId = "ff481f559fea02934cdb1cf3a79b991a";
    try {
      const resp = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${appId}`);
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
    //background image according to the location 
    document.body.style.backgroundImage = "url('https://source.unsplash.com/1600x900/?" + data.name + "')";
    //tempreture
    document.querySelector(".temperature").innerHTML = `${data.main.temp} °C`;
    //country name
    document.querySelector(".city").innerHTML = `${data.name}, ${data.sys.country}`;
    //weather icon
    document.querySelector(".weather img").src = `http://openweathermap.org/img/w/${data.weather[0].icon}.png`;
    //weather description
    document.querySelector(".description").innerHTML = data.weather[0].description;
    //wind
    document.querySelector(".wind").innerHTML = `WIND: ${data.wind.speed} km/hr`;
    //humidity
    document.querySelector(".humidity").innerHTML = `HUMIDITY: ${data.main.humidity}%`;
    //loading message not to be displayed when add are loaded
    document.querySelector("#loading-message").style.display = "none";
}

document.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        inputEnter()
    }
});
function inputEnter() {
    let input = "";
    input = document.querySelector("input").value;
    weather(input)
}
weather("Paterson")
