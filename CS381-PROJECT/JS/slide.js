function slideMovies(sec, dir) {
    const section = document.getElementById(sec);
    const scroller = section.querySelector('.w3-row-padding'); 
    const scrollAmount = 200;
  
    if (scroller) {
      if (dir === '<') {
        scroller.scrollLeft -= scrollAmount;
      } else {
        scroller.scrollLeft += scrollAmount;
      }
    }
  }