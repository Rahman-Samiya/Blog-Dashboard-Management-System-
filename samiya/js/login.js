
(function(){
	  const container = document.getElementById('container');
	  const formTitle = document.getElementById('form-title');
	  const toggleButton = document.getElementById('toggle-button');
	  const formToggleText = document.getElementById('form-toggle-text');
	  const loginForm = document.getElementById('login-form');
	  const registerForm = document.getElementById('register-form');
	  const loginMessage = document.getElementById('login-message');
	  const registerMessage = document.getElementById('register-message');

	  // Switch to register form
	  function showRegister() {
	    formTitle.textContent = 'Register';
	    toggleButton.textContent = 'Log in here';
	    loginForm.classList.add('hidden');
	    registerForm.classList.remove('hidden');
	    loginMessage.textContent = '';
	    registerMessage.textContent = '';
	  }


	  // Switch to login form
	  function showLogin() {
	    formTitle.textContent = 'Login';
	    toggleButton.textContent = 'Create an account';
	    registerForm.classList.add('hidden');
	    loginForm.classList.remove('hidden');
	    loginMessage.textContent = '';
	    registerMessage.textContent = '';
	  }

	  // Toggle handler
	  formToggleText.addEventListener('click', function(e) {
	    if (loginForm.classList.contains('hidden')) {
	      showLogin();
	    } else {
	      showRegister();
	    }
	  });

	  // // login validation and feedback
	  // loginForm.addEventListener('submit', function(e){
	  //   e.preventDefault();
	  //   loginMessage.style.color = '#ff3b3b'; // error color
	  //   const email = document.getElementById('login-email').value.trim();
	  //   const password = document.getElementById('login-password').value;

	  //   if (!email || !password) {
	  //     loginMessage.textContent = 'Please fill in all fields.';
	  //     return;
	  //   }

	  //   if (!validateEmail(email)) {
	  //     loginMessage.textContent = 'Please enter a valid email.';
	  //     return;
	  //   }

	  //   loginForm.reset();
	  // });

	  // // Fake registration validation and feedback
	  // registerForm.addEventListener('submit', function(e){
	  //   e.preventDefault();
	  //   registerMessage.style.color = '#ff3b3b';
	  //   const username = document.getElementById('register-username').value.trim();
	  //   const email = document.getElementById('register-email').value.trim();
	  //   const password = document.getElementById('register-password').value;
	  //   const passwordConfirm = document.getElementById('register-password-confirm').value;

	  //   if (!username || !email || !password || !passwordConfirm) {
	  //     registerMessage.textContent = 'Please complete all fields.';
	  //     return;
	  //   }
	  //   if (!validateEmail(email)) {
	  //     registerMessage.textContent = 'Please enter a valid email.';
	  //     return;
	  //   }
	  //   if (password.length < 6) {
	  //     registerMessage.textContent = 'Password must be at least 6 characters.';
	  //     return;
	  //   }
	  //   if (password !== passwordConfirm) {
	  //     registerMessage.textContent = 'Passwords do not match.';
	  //     return;
	  //   }
	    
	  //   registerForm.reset();
	  // });

	  function validateEmail(email) {
	    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	    return re.test(email);
	  }
})();