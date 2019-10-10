document.addEventListener(
    "DOMContentLoaded", () => {
        const node = document.querySelector("#menu-mobile");
        const menu = new MmenuLight(node, {
            title: 'Меню'
        });

        menu.enable( "(max-width: 1199px)" );
        menu.offcanvas({
            position:'right',
        });

        document.querySelector( '#menu-toggle' )
            .addEventListener( 'click', ( evnt ) => {
                menu.open();
                evnt.preventDefault();
                evnt.stopPropagation();
            });
    }
);
