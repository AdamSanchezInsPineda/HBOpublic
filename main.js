const domBody = document.getElementById('body');
const botonAceptarCookies = document.getElementById('btn-aceptar-cookies');
const avisoCookies = document.getElementById('section-cookies');
const fondoAvisoCookies = document.getElementById('fondo-cookies');
const enlaceCookies = document.getElementById("enlace-cookie");
const warningCookies = document.getElementById("warning-cookies");
const enlaceCookies2 = document.getElementById("enlace-cookie2");

dataLayer = [];

if(!localStorage.getItem('cookies-aceptadas')){
	avisoCookies.classList.add('active');
	fondoAvisoCookies.classList.add('active');
	domBody.classList.add('active');
} else {
	dataLayer.push({'event': 'cookies-aceptadas'});
}

botonAceptarCookies.addEventListener('click', () => {
	avisoCookies.classList.remove('active');
	fondoAvisoCookies.classList.remove('active');
	domBody.classList.remove('active');

	localStorage.setItem('cookies-aceptadas', true);

	dataLayer.push({'event': 'cookies-aceptadas'});
});

enlaceCookies.addEventListener('click', () => {
    avisoCookies.classList.remove('active');
	warningCookies.classList.add('active');

});

enlaceCookies2.addEventListener('click', () => {
    avisoCookies.classList.add('active');
    warningCookies.classList.remove('active');
});