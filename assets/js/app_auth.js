import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, GoogleAuthProvider, signInWithPopup } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

// API key
const firebaseConfig = {
  apiKey: "AIzaSyBvAV1Id3SNM9S1kKYfwEM4dq--sMiioIo",
  authDomain: "primo-progetto-7f9e7.firebaseapp.com",
  databaseURL: "https://primo-progetto-7f9e7-default-rtdb.firebaseio.com",
  projectId: "primo-progetto-7f9e7",
  storageBucket: "primo-progetto-7f9e7.appspot.com",
  messagingSenderId: "665658176474",
  appId: "1:665658176474:web:3305f564d2da0ca0ec86e3",
  measurementId: "G-G8TVVF06LG"
};

// Inizializza Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const provider = new GoogleAuthProvider();

// Configurazione provider Google
provider.addScope('email');
provider.addScope('profile');

async function handleGoogleLogin() {
  try {
    const loadingScreen = document.querySelector('.loading-screen');
    const spinnerStop = document.querySelector('.spinner');
    
    if (loadingScreen) {
      loadingScreen.classList.add('fade-out');
    }

    if (spinnerStop) {
      spinnerStop.classList.add('stop');
    }

    const result = await signInWithPopup(auth, provider);
    const user = result.user;
    
    console.log("Login Google avvenuto:", user);
    
    // dati dell'utente per l'invio al server
    const userData = {
      google_id: user.uid,
      email: user.email,
      name: user.displayName?.split(' ')[0] || '',
      surname: user.displayName?.split(' ').slice(1).join(' ') || '',
      username: user.email.split('@')[0], // parte prima della @ come username
      avatar: null,
      provider: 'google'
    };

    // invio dati
    const response = await fetch('/php/API/google_login.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(userData)
    });

    // conversione in txt
    const text = await response.text();

    // parsing JSON
    let serverResponse;
    try {
      serverResponse = JSON.parse(text);
    } catch {
      console.error("Risposta non JSON dal server:", text);
      showError("Errore interno: risposta server non valida");
      return;
    }

    if (!response.ok) {
      console.error("Errore HTTP dal server:", response.status, text);
      showError(`Errore dal server: ${response.status}`);
      return;
    }

    // risposta dal server
    if (serverResponse.success) {
      window.location.href = serverResponse.redirect || '/index.php';
    } else {
      showError(serverResponse.message || 'Errore durante il login con Google');
    }

  } catch (error) {
    console.error("Errore login Google:", error);
    let errorMessage = 'Errore durante il login con Google';
    
    if (error.code === 'auth/popup-closed-by-user') {
      errorMessage = 'Login annullato dall\'utente';

    } else if (error.code === 'auth/popup-blocked') {
      errorMessage = 'Popup bloccato dal browser. Consenti i popup per questo sito.';

    }
    
    showError(errorMessage);
    
  } finally {
    const loadingScreen = document.querySelector('.loading-screen');
    if (loadingScreen) {
      loadingScreen.style.display = 'none';
    }
  }
}


// Event listener principale per google e apple 
window.addEventListener("DOMContentLoaded", () => {
  const loginBtnGoogle = document.getElementById("loginBtnGoogle");
  
  if (loginBtnGoogle) {
    loginBtnGoogle.addEventListener("click", handleGoogleLogin);
  }
  
  // login apple non attivo
  const loginBtnApple = document.getElementById("loginAppleBtn");
  if (loginBtnApple) {
    loginBtnApple.addEventListener("click", () => {
      showError("Login con Apple al momento non disponibile");
    });
  }
});

function showError(message) {
  let errorContainer = document.querySelector('.google-error-message');
  
  if (!errorContainer) {
    // Cantainer per gli errori
    errorContainer = document.createElement('div');
    errorContainer.className = 'error_message google-error-message';
    const form = document.getElementById('form');
    const socialContainer = document.getElementById('social_button_container');
    
    if (form && socialContainer) {
      form.parentNode.insertBefore(errorContainer, socialContainer);
    }
  }
  
  errorContainer.textContent = message;
  errorContainer.style.display = 'block';
  
  // time out 6 secondi 
  setTimeout(() => {
    errorContainer.style.display = 'none';
  }, 6000);
}