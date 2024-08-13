// Countdown Timer Script
const countdown = () => {
    const countDate = new Date("August 24, 2024 00:00:00").getTime();
    const now = new Date().getTime();
    const gap = countDate - now;
  
    // Time calculations
    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;
  
    const days = Math.floor(gap / day);
    const hours = Math.floor((gap % day) / hour);
    const minutes = Math.floor((gap % hour) / minute);
    const seconds = Math.floor((gap % minute) / second);
  
    // Display the result in the element with id
    document.getElementById("days").innerText = days;
    document.getElementById("hours").innerText = hours;
    document.getElementById("minutes").innerText = minutes;
    document.getElementById("seconds").innerText = seconds;
  };
  
  // Update the countdown every second
  setInterval(countdown, 1000);
  