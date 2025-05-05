
var progress = document.querySelector('.booking-progress');


var s1 = document.getElementById('s1');
var s2 = document.getElementById('s2');
var s3 = document.getElementById('s3');
var s4 = document.getElementById('s4');


var div1 = document.getElementById('div1');
var div2 = document.getElementById('div2');
var div3 = document.getElementById('div3');
var div4 = document.getElementById('div4');


div2.addEventListener('mousedown', function() {
    s2.classList.add('active');
});
div3.addEventListener('mousedown', function() {
    s3.classList.add('active');
});
div4.addEventListener('mousedown', function() {
    s4.classList.add('active');
});

