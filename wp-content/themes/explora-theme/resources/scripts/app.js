import domReady from '@roots/sage/client/dom-ready';

import {
  Swiper,
  Pagination,
  Navigation,
  Autoplay,
  FreeMode
} from 'swiper';
Swiper.use([Pagination,Navigation,Autoplay,FreeMode]);

// Initialization for ES Users
// import { Select, initTE } from "tw-elements";
// initTE({ Select });


/**
 * Application entrypoint
 */
domReady(async () => {

  var menuItems = document.querySelectorAll('.menu-button');

  // Add a click event listener to each matching element
  menuItems.forEach(function(menuItem) {
    menuItem.addEventListener('click', function() {
      this.classList.toggle('active');
      // Toggle the visibility of the sub-menu
      var subMenu = this.nextElementSibling; // Assuming the sub-menu is a sibling element
      if (subMenu) {
        subMenu.classList.toggle('active');
      }
      console.log('asa')
    });
  });

  
  const bannerButton = document.querySelector('#banner-close');
  if(bannerButton){
    const bannerDiv = document.querySelector('#banner-advise');
    bannerButton.addEventListener('click', () => { 
      bannerDiv.remove();
    });
  }

  const buttonListbox = document.querySelector('button[aria-haspopup="listbox"]');
  function initializeSelect() {
    
    const listbox = document.querySelector('ul[role="listbox"]');
    const options = document.querySelectorAll('li[role="option"]');

    // Function to close the listbox
    function closeListbox() {
        listbox.classList.add('opacity-0');
        setTimeout(() => {
          listbox.classList.add('hidden');
          listbox.classList.remove('opacity-0');
          listbox.setAttribute('aria-expanded', 'false');
          document.removeEventListener('click', closeListbox);
        }, 100);
    }

    


    buttonListbox.addEventListener('click', (e) => {
        e.stopPropagation(); // Prevent click event from propagating to document
        if (listbox.classList.contains('hidden')) {
            listbox.classList.remove('hidden');
            listbox.setAttribute('aria-expanded', 'true');
            document.addEventListener('click', closeListbox);
        } else {
            closeListbox();
        }
    });

    options.forEach((option, index) => {
        
        option.setAttribute('tabindex', '0');
        option.addEventListener('click', () => {
            const elements = document.querySelectorAll('.block.truncate');
            elements.forEach(element => {
                element.classList.remove('font-semibold');
            });

            const checkmarks = document.querySelectorAll('.checkmark');
            checkmarks.forEach(element => {
                element.classList.add('text-white');
                element.classList.remove('text-indigo-600');
            });

            const selectedOption = option.querySelector('.block.truncate');
            const value = selectedOption.getAttribute('data-value');
            const categoryInput = document.querySelector('input[name="category"]');
            categoryInput.value = value;
            const checkmark = option.querySelector('.checkmark');
            checkmark.classList.remove('text-white');
            checkmark.classList.add('text-indigo-600');

            selectedOption.classList.add('font-semibold');
            buttonListbox.querySelector('.block.truncate').innerText = selectedOption.innerText;



            closeListbox();
        });

        option.addEventListener('keydown', (e) => {
          if (e.key === 'Enter') {
            const elements = document.querySelectorAll('.block.truncate');
            elements.forEach(element => {
                element.classList.remove('font-semibold');
            });
            const checkmarks = document.querySelectorAll('.checkmark');
            checkmarks.forEach(element => {
                element.classList.add('text-white');
                element.classList.remove('text-indigo-600');
            });
            const selectedOption = option.querySelector('.block.truncate');
            const checkmark = option.querySelector('.checkmark');
            checkmark.classList.remove('text-white');
            checkmark.classList.add('text-indigo-600');
            selectedOption.classList.add('font-semibold');
            buttonListbox.querySelector('.block.truncate').innerText = selectedOption.innerText;
            closeListbox();
          }
      });
    });

    // Keyboard navigation (up and down arrow keys)
    buttonListbox.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowUp' && selectedOptionIndex > 0) {
          e.preventDefault();
          highlightOption(selectedOptionIndex - 1);
      } else if (e.key === 'ArrowDown' && selectedOptionIndex < options.length - 1) {
          e.preventDefault();
          highlightOption(selectedOptionIndex + 1);
      } else if (e.key === 'Enter' && selectedOptionIndex >= 0) {
          const selectedOptionText = options[selectedOptionIndex].querySelector('.block.truncate').innerText;
          button.querySelector('.block.truncate').innerText = selectedOptionText;
          closeListbox();
      }
  });
  
}

// Call the function to initialize the select
if(buttonListbox){
  initializeSelect();
}




  //housr widget
  const hoursWidget = document.getElementById('hours-widget');
  const hoursWidgetMobile = document.getElementById('hours-widget-mobile');
  
  if(hoursWidget || hoursWidgetMobile){
    let today = new Date();
    // https://www.mdbr.it/creaticket/biglietti/day_availability.php?eventId=1&date=20/10/2023
    let url = 'https://mdbr.it/creaticket/biglietti/day_availability.php?eventId=1&date='+formatDate(today);
    let hoursJson = '';
    // const url = 'https://mdbr.it/creaticket/biglietti/day_availability.php?eventId=1&date=16/11/2023';
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const hoursArray = data.dayAvailability;
            popolateHoursWidget(hoursArray)
        })
        .catch(error => {
            console.log(error)
            console.log('There was a problem with the fetch operation:', error.message);
            hoursJson = '{"lastUpdate":"1697726451","dayAvailability":[{"id":37981,"time":"12:00","availability":250},{"id":38025,"time":"15:00","availability":247},{"id":38069,"time":"17:00","availability":243}]}'
            const hoursArray = JSON.parse(hoursJson);
        
            // console.log(hoursArray.dayAvailability.length);
            popolateHoursWidget(hoursArray.dayAvailability)
        
          });

   

  }

  function popolateHoursWidget(hours) {
    const hoursWidget = document.getElementById('hours-widget');
    const hoursWidgetMobile = document.getElementById('hours-widget-mobile');
  
    let today = new Date();

    if(!hours.length){
      if(hoursWidget){
        hoursWidget.innerHTML = '<p class="text-black"><strong>'+AppData.open_message+' '+formatDate(today)+':</strong> '+AppData.closed_message+'</p>';
      }
      if(hoursWidgetMobile){
        hoursWidgetMobile.innerHTML = '<p class="text-black text-sm text-center"><strong>'+AppData.open_message+' '+formatDate(today)+':</strong> '+AppData.closed_message+'</p>';
      }
      
    }else{
      let textArray = [];
      hours.forEach(slot => {
        let slotText =  'H '+slot.time+', '+slot.availability+' '+AppData.available_spot;
        textArray.push(slotText)
      });
      if(hoursWidget){
        hoursWidget.innerHTML = '<p class="text-black"><strong>'+AppData.open_message+' '+formatDate(today)+':</strong> '+textArray.join(" | ")+'</p>';
      }
      if(hoursWidgetMobile){
        hoursWidgetMobile.innerHTML = '<p class="text-black text-sm text-center"><strong>'+AppData.open_message+' '+formatDate(today)+':</strong><br>'+textArray.join(" | ")+'</p>';
      }
    }
   
  }

  


  function formatDate(d) {
    let day = ("0" + d.getDate()).slice(-2);      // Get the day and format it to two digits
    let month = ("0" + (d.getMonth() + 1)).slice(-2);  // Get the month (0-11) and format it to two digits
    let year = d.getFullYear();                    // Get the year
    return `${day}/${month}/${year}`;
  }



  // handle the scroll when anchors
  const hash = window.location.hash;
  if (hash) {
    const targetElement = document.querySelector(hash);
    if(targetElement){
      window.scrollTo({
        top: 0,
        behavior: "auto" // Use "auto" or omit this line for no animation
      });
      const headerHeight = document.getElementById('explora-header').offsetHeight;
        window.scrollTo({
          top: targetElement.offsetTop - headerHeight,
          behavior: 'smooth'
        });
    }
  }
  // hambugers
  const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('#drawer-nav');
  const links = nav.querySelectorAll("a");
  links.forEach(link => {
    const href = link.getAttribute("href");
    if (href && href.includes("#")) {
        link.addEventListener("click", function (event) {
          event.preventDefault();
          href.split("/");
          const targetId = href.split("#");
          const targetDiv = document.getElementById(targetId[1]);
          if (targetDiv) {
            const headerHeight = document.getElementById('explora-header').offsetHeight;
            window.scrollTo({
              top: targetDiv.offsetTop - headerHeight,
              behavior: 'smooth'
            });
            if (nav.getAttribute('aria-expanded') === 'false') {
              nav.setAttribute('aria-expanded', 'true');
            } else {
              nav.setAttribute('aria-expanded', 'false');
            }
            hamburger.classList.toggle('is-active');
            nav.classList.toggle('active');
            document.body.classList.toggle("overflow-hidden");
          }else{
            window.location.href = href
          }
      });
    }
  });
            
  hamburger.addEventListener('click', function (e) {
    e.preventDefault();
    // aria attribute
    if (nav.getAttribute('aria-expanded') === 'false') {
      nav.setAttribute('aria-expanded', 'true');
    } else {
      nav.setAttribute('aria-expanded', 'false');
    }
    hamburger.classList.toggle('is-active');
    nav.classList.toggle('active');
    document.body.classList.toggle("overflow-hidden");
  
  
  
  });


  //swipers home hero
  const homeHeroSwiper = new Swiper("#hero_home_swiper .swiper", {
    spaceBetween: 0,
    slidesPerView: 1,
    threshold:15,
    speed:1000,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
  });

  const eventSlider = new Swiper("#event-slider .swiper", {
    spaceBetween: 0,
    slidesPerView: 1,
    threshold:15,
    speed:1000,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
  });


  //hero page anchors
  if (document.querySelector('.hero_page')) {
    scrollToAnchor();
  }

  function scrollToAnchor() {
    const headerHeight = document.getElementById('explora-header').offsetHeight;
    const scrollToElement = (element) => {
      window.scrollTo({
        top: element.offsetTop - headerHeight,
        behavior: 'smooth'
      });
    };
    const ticketLinks = document.querySelectorAll('.hero_page a');
    ticketLinks.forEach((link) => {
      link.addEventListener('click', (event) => {
        const href = link.getAttribute('href');
        if (href.startsWith('#')) {
          event.preventDefault();
          const targetId = href.slice(1);
          const targetElement = document.getElementById(targetId);
          if (targetElement) {
            scrollToElement(targetElement);
          }
        }
      });
    });
  }


  

});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
