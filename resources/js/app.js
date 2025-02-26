import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Select the section element
const section = document.getElementById('animated-section');

// Create an IntersectionObserver for section
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Add classes to trigger the fade-in effect
            section.classList.remove('opacity-0');
            section.classList.add('opacity-100');
            observer.disconnect();
        }
    });
}, { threshold: 0.9 });

observer.observe(section);

// Select the element for the slide-right animation
const element = document.getElementById('animateRight');

// Create an IntersectionObserver for the slide-right element
const observer2 = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Add classes to trigger slide-right and fade-in effects
            element.classList.remove('opacity-0', '-translate-x-full');
            element.classList.add('opacity-100', 'translate-x-0');
            observer2.disconnect();
        }
    });
}, { threshold: 0.5 });

observer2.observe(element);

  // Select the elements
  const elements = document.querySelectorAll('#quality, #distribution, #pricing, #support');

  // Create an IntersectionObserver
  const observer3 = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
          // If the element is in view
          if (entry.isIntersecting) {
              // Add classes to trigger the slide-up effect
              entry.target.classList.remove('opacity-0', 'translate-y-20');
              entry.target.classList.add('opacity-100', 'translate-y-0');
              observer3.unobserve(entry.target); // Stop observing once it's in view
          }
      });
  }, { threshold: 0.5 }); // Trigger when 50% of the element is in view

  // Start observing each element
  elements.forEach(element => observer3.observe(element));




