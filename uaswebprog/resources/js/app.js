import './bootstrap';
import 'flowbite';
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 1000, // animation duration in milliseconds
    offset: 200, // offset (in px) from the original trigger point
    easing: 'ease-in-out', // easing function
    once: false, // whether animation should happen only once
});

window.AOS = AOS;