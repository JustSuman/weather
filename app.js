function time() {
    let time = new Date();
    let weekDays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    document.querySelector(".month").innerHTML = weekDays[time.getDay() - 1] + ", " + months[time.getMonth()] + " " + time.getDate();
}
time()

function weather(city) {
    let appId = "ff481f559fea02934cdb1cf3a79b991a"
    fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${appId}`)
        .then(resp => resp.json())
        .then(data => {
            console.log(data)
            display(data)
        })
}
function display(data) {
    document.body.style.backgroundImage = "url('https://source.unsplash.com/1600x900/?" + data.name + "')";
    document.querySelector(".temperature").innerHTML = `${data.main.temp} °C`;
    document.querySelector(".city").innerHTML = `${data.name}, ${data.sys.country}`;
    document.querySelector(".weather img").src = `http://openweathermap.org/img/w/${data.weather[0].icon}.png`;
    document.querySelector(".description").innerHTML = data.weather[0].description;
    document.querySelector(".wind").innerHTML = `WIND: ${data.wind.speed} km/hr`;
    document.querySelector(".humidity").innerHTML = `HUMIDITY: ${data.main.humidity}%`;
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
