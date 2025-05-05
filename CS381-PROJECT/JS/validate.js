function validate(event)
{
  event.preventDefault();

  var un_message=document.getElementById('un-error-message');
  var em_message=document.getElementById('em-error-message');
  var pw_message=document.getElementById('pw-error-message');
  var cp_message=document.getElementById('cp-error-message');

  un_message.innerHTML='';
  em_message.innerHTML='';
  pw_message.innerHTML='';
  cp_message.innerHTML='';



  var username=document.querySelector("input[name='username']").value;
  var email=document.querySelector("input[name='email']").value;
  var password=document.querySelector("input[name='password']").value;
  var confirm=document.querySelector("input[name='confirm']").value;

  let valid=true;

  if(username.trim() == '') {
    un_message.innerHTML = 'Username must not be empty';
    valid=false;
  } else if(username.length < 3) {
    un_message.innerHTML = 'Username must be at least 3 characters';
    valid=false;
  }
  if(username.trim() == '') {
    un_message.innerHTML = 'Username must not be empty';
    valid=false;
  } else if(username.length < 3) {
    un_message.innerHTML = 'Username must be at least 3 characters';
    valid=false;
  }

  if(email.trim() == '') {
    em_message.innerHTML = 'Email must not be empty';
    valid=false;
  } else if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    em_message.innerHTML = 'Invalid email format';
    valid=false;
  }

  if(password.trim() == '') {
    pw_message.innerHTML = 'Password must not be empty';
    valid=false;}
   else if(password.length < 6) {
    pw_message.innerHTML = 'Password must be at least 6 characters';
    valid=false;
  }else if(!/[A-Z]/.test(password)) {
    pw_message.innerHTML = 'Password must contain at least one uppercase letter';
    valid=false;
  } else if(!/[a-z]/.test(password)) {
    pw_message.innerHTML = 'Password must contain at least one lowercase letter';
    valid=false;
  } else if(!/[0-9]/.test(password)) {
    pw_message.innerHTML = 'Password must contain at least one number';
    valid=false;
  } else if(!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
    pw_message.innerHTML = 'Password must contain @';
    valid=false;
      } else if(/[^a-zA-Z0-9$_\-@#]/.test(password)) {
    pw_message.innerHTML = 'Password contains invalid special characters';
    valid=false;
  }

  if(confirm.trim() == '') {
    cp_message.innerHTML = 'Confirm Password must not be empty';
    valid=false;
  } else if(confirm !== password) {
    cp_message.innerHTML = 'Passwords do not match';
    valid=false;
  }
  
  if(valid) {
    fetch("post.register.php", {
      method: "POST",
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        username: username.trim(),
        email: email.trim(),
        password: password.trim(),
      }) 
    }).then(res => res.json()).then(data => {
      if (data.error) {
        console.log(data.error)
        return;
      } else {
        if (data.msg_num == "0") {
          localStorage.setItem("signedIn",'true');
          window.location.href = "homepage.php";
        } else if (data.msg_num == "1") {
          
        }
        console.log(data.msg);
      }
    })
    
  }
  
}