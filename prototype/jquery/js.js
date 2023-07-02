function increment() {
    let number = parseInt(document.getElementById("number").innerHTML);
    number++;
    document.getElementById("number").innerHTML = number;
    sendData(number);
  }
  
  function sendData(number) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "increment.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        document.getElementById("result").innerHTML = xhr.responseText;
      }
    };
    xhr.send("number=" + number);
  }