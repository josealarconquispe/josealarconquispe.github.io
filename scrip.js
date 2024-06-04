const Carrito = document.getAnimations('carrito');
const elementos1 = document.getElementById('lista-1');
const lista = document.getElementById('#lista-carro tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');


document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const closeBtn = document.querySelector('.close');
    const viewButtons = document.querySelectorAll('.btn-1, .btn-2, .btn-3, .btn-4, .btn-5, .btn-6');

    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            modal.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
