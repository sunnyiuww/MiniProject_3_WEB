// scrool reveral
ScrollReveal({
    distance: '80px',
    duration: 2000,
    delay: 200,
});

ScrollReveal().reveal('.home-content, heading', {origin: 'top'});
ScrollReveal().reveal('.home-img, .educations-container, .certificates-box, .contact form', {origin: 'buttom'});
ScrollReveal().reveal('.home-contact h1, .about-img', {origin: 'left'});
ScrollReveal().reveal('.home-contact p, .about-content', {origin: 'right'});

// typed js
var typed = new Typed('.multiple-text', {
    strings: ['Toraja Inspires'],
    typeSpeed: 70,
    loop: true,
    showCursor: true,
    cursorChar: '|',
    startDelay: 1000,
    fadeOut: true,
});


document.querySelectorAll('.about .video-container .controls .control-btn').forEach(btn =>{
    btn.onclick = () =>{
        let src = btn.getAttribute('data-src');
        document.querySelector('.about .video-container .video').src = src;
    }
})

