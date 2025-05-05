document.addEventListener('DOMContentLoaded', function() {
      
    const seats = document.querySelectorAll('.seat:not(.occupied)');
   
    
    seats.forEach(seat => {
      seat.addEventListener('click', function() {
        const selectedSeats = document.querySelectorAll('.seat.selected');
        selectedSeats.forEach(el => {
          el.classList.remove('selected');
        })
        this.classList.toggle('selected');
        document.querySelectorAll(".seat_num").forEach(el => el.textContent = seat.textContent);
        
       
        
       
      });
    });
    
  });