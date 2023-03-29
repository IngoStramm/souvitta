// jQuery(document).ready(function ($) {
//     $('li.cat-item:has(ul.children)').addClass('i-have-kids');
// });

document.addEventListener('DOMContentLoaded', function () {
    // SVT Toggle List
    const childrens = document.getElementsByClassName('children');
    Array.from(childrens).forEach(children => {

        // adiciona a classe 'has-children' para as cat pai
        const trigger_toggle = children.parentNode;
        trigger_toggle.classList.add('has-children');

        // cria o link de toggle
        const expand = document.createElement('a');
        expand.classList.add('toggle');
        expand.classList.add('clearfix');
        expand.setAttribute('href', '#');

        // cria o icon
        const icon = document.createElement('i');
        icon.classList.add('icon-plus');
        icon.classList.add('fa');

        // adiciona o icon ao link de toggle
        expand.appendChild(icon);
        // adiciona o link de toggle às cat pai
        trigger_toggle.querySelectorAll('a')[0].insertAdjacentElement('afterend', expand);

        // evento para exibir as cat filho
        expand.addEventListener('click', (e) => {
            e.preventDefault();
            children.classList.toggle('visible');
            if (icon.classList.contains('icon-plus')) {
                icon.classList.remove('icon-plus');
                icon.classList.add('icon-minus');
            } else if (icon.classList.contains('icon-minus')) {
                icon.classList.remove('icon-minus');
                icon.classList.add('icon-plus');
            }
        }, false);

        // Veirifica se alguma subcat é a cat atual e expande a lista de subcat
        const children_lis = children.querySelectorAll('li');
        Array.from(children_lis).forEach(children_li => {
            if (children_li.classList.contains('current-cat')) {
                children.classList.add('visible');
                icon.classList.remove('icon-plus');
                icon.classList.add('icon-minus');
            }
        });

    });
});