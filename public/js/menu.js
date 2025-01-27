// Seleciona todos os itens do menu principal e os subitens
var menuItems = document.querySelectorAll('.item-menu');
var mainLinks = document.querySelectorAll('.sub-btn');
var subLinks = document.querySelectorAll('.sub-item');

// Função para desmarcar todos os itens e ativar o item clicado
function selectLink() {
    // Remove a classe 'ativo' de todos os itens do menu principal e subitens
    menuItems.forEach((item) => {
        item.classList.remove('ativo');
    });
    mainLinks.forEach((link) => {
        link.classList.remove('ativo');
    });
    subLinks.forEach((link) => {
        link.classList.remove('ativo');
    });

    // Adiciona a classe 'ativo' ao item clicado
    this.classList.add('ativo');
}

// Adiciona o evento de clique a todos os itens do menu principal
menuItems.forEach((item) => {
    item.addEventListener('click', selectLink);
});

// Adiciona o evento de clique a todos os links principais e subitens
mainLinks.forEach((link) => {
    link.addEventListener('click', selectLink);
});

subLinks.forEach((link) => {
    link.addEventListener('click', selectLink);
});

// Expandir o menu

//Principal
var btnExp = document.querySelector('#icon-seta')
var menuSide = document.querySelector('.gerenciamento-menu')

btnExp.addEventListener('click', function(){
    menuSide.classList.toggle('expandir')
})
//Container 1
var btnExp2 = document.querySelector('#icon-seta')
var menuSide2 = document.querySelector('.container-itens-menu')

btnExp2.addEventListener('click', function(){
    menuSide2.classList.toggle('expandir')
});
//Container 2
var btnExp3 = document.querySelector('#icon-seta')
var menuSide3 = document.querySelector('.container-itens-menu2')

btnExp3.addEventListener('click', function(){
    menuSide3.classList.toggle('expandir')
});

$(document).ready(function() {
    var botao = $('.sub-btn');
    var dropDown = $('.sub-menu');    
   
       botao.on('click', function(event){
           dropDown.stop(true,true).slideToggle();
           event.stopPropagation();
       });
   });


