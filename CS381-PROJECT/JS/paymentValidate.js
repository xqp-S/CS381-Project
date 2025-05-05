function validate_payment(event) {

    var selectedSeat = document.getElementsByClassName('seat_num')[0].innerText;
var firstName = document.getElementById('fn').value;
var lastName = document.getElementById('ln').value;
var email = document.getElementById('email').value;
var phone = document.getElementById('phone').value;


    if (selectedSeat === "") {
        alert("Please select a seat number.");
        return false;
    } 
    else if(/[A-Za-z]{3,}/.test(firstName) === false){
        alert("Please enter a valid first name.");
    }else if(/[A-Za-z]{5,}/.test(lastName) === false){
        alert("Please enter a valid last name.");
    }else if(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/.test(email) === false){
        alert("Please enter a valid email address.");
    }
    else if(/^\d{10}$/.test(phone) === false){
        alert("Please enter a valid phone number.");
    }    
    else {
        fetch("book_ticket.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            seat_num: selectedSeat,
            movie_id: movie_id,
            time_id: time_id
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            window.location.href = "thankyou.html";
          } else {
            alert("Booking failed: " + data.message);
          }
        })
        .catch(err => {
          alert("Error sending booking: " + err.message);
        });
      }
    
}
