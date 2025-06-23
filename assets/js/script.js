// Impostando subito il tema pagina sul tag html e non body si evita il flickering per il caricamento della pagina
(function () {
  const tema = localStorage.getItem("tema");
  if (tema === "true") {
    document.documentElement.classList.add("dark-theme");
  }
})();

window.addEventListener('load', function () {
  const loadingScreen = document.querySelector('.loading-screen');
  const spinnerStop = document.querySelector('.spinner');
  
  if (loadingScreen) {
    loadingScreen.classList.add('fade-out');
  }

  if (spinnerStop) {
    spinnerStop.classList.add('stop');
  }
  
});

document.addEventListener('DOMContentLoaded', () => {
  initPage();
});

const initPage = () => {
  if (window.location.pathname.endsWith("index.php")) {
    searchModule.init();
  }

  let tema = localStorage.getItem("tema");

  if (tema === null) {
    tema = "false";
    localStorage.setItem("tema", tema);
  }

  if (tema === "false") {
    document.documentElement.classList.remove("dark-theme");
  }

  aggiornaIconeTema(tema === "true");

  const projectImageContainers = document.querySelectorAll('.project-card');

  projectImageContainers.forEach(projectCard => {
    const mainImage = projectCard.querySelector('.main-project-image');
    const thumbnails = projectCard.querySelectorAll('.thumbnail-image');

    if (mainImage && thumbnails.length > 0) {
      thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function () {
          thumbnails.forEach(t => t.classList.remove('active-thumbnail'));

          this.classList.add('active-thumbnail');

          mainImage.src = this.src;
        });
      });
    }
  });

  const sliderContainer = document.querySelector('.slider-container');
  const prevButton = document.querySelector('.prev-button');
  const nextButton = document.querySelector('.next-button');
  const slides = document.querySelectorAll('.slide');

  if (!sliderContainer || !prevButton || !nextButton || slides.length === 0) {
    return;
  }

  const slideWidth = slides[0].offsetWidth + 20;
  let currentSlide = 0;
  let autoScrollInterval;

  const scrollToSlide = (index) => {
    if (index < 0) {
      currentSlide = slides.length - 1;
    } else if (index >= slides.length) {
      currentSlide = 0;
    } else {
      currentSlide = index;
    }
    sliderContainer.scrollTo({
      left: currentSlide * slideWidth,
      behavior: 'smooth'
    });
  };

  prevButton.addEventListener('click', () => {
    scrollToSlide(currentSlide - 1);
  });

  nextButton.addEventListener('click', () => {
    scrollToSlide(currentSlide + 1);
  });

  const startAutoScroll = () => {
    autoScrollInterval = setInterval(() => {
      scrollToSlide(currentSlide + 1);
    }, 3000);
  };

  const stopAutoScroll = () => {
    clearInterval(autoScrollInterval);
  };

  startAutoScroll();

  sliderContainer.style.overflowX = 'hidden';
  sliderContainer.style.scrollSnapType = 'none';

  prevButton.addEventListener('mouseenter', stopAutoScroll);
  nextButton.addEventListener('mouseenter', stopAutoScroll);
  prevButton.addEventListener('mouseleave', startAutoScroll);
  nextButton.addEventListener('mouseleave', startAutoScroll);

};

const searchModule = {
  init: function () {
    const searchInput = document.getElementById('search-input');
    const clearButton = document.getElementById('reset-button');

    if (searchInput) {
      searchInput.addEventListener('focus', function () {
        if (this.value === 'Ricerca') {
          this.value = '';
        }
      });

      searchInput.addEventListener('blur', function () {
        if (this.value === '') {
          this.value = 'Ricerca';
        }
      });
    }

    if (clearButton && searchInput) {
      clearButton.addEventListener('click', function () {
        searchInput.value = '';
      });
    }
  }
}

function clearSearch() {
  const searchInput = document.getElementById('search-input');
  if (searchInput) {
    searchInput.value = '';
  }
}

function colorChange() {
  let tema = localStorage.getItem("tema");

  if (tema === "false") {
    tema = "true";
    document.documentElement.classList.add("dark-theme");
  } else {
    tema = "false";
    document.documentElement.classList.remove("dark-theme");
  }

  localStorage.setItem("tema", tema);
  aggiornaIconeTema(tema === "true");
}

function aggiornaIconeTema(tema) {
  const lightIcon = document.getElementById('light');
  const darkIcon = document.getElementById('dark');

  if (lightIcon && darkIcon) {
    if (tema) {
      lightIcon.classList.remove('fa-sun');
      darkIcon.classList.add('fa-moon');
    } else {
      lightIcon.classList.add('fa-sun');
      darkIcon.classList.remove('fa-moon');
    }
  }
}