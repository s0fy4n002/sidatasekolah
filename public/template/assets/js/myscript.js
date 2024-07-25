function getParts(pathname){
    if (pathname.startsWith('/')) {
        pathname = pathname.substring(1);
    }
    let parts = pathname.split('/');
    return parts;
}
let pathname = window.location.pathname;
let parentPart = getParts(pathname);

const sidebar_menu = document.querySelectorAll(".sidebar-menu-item");
Array.from(sidebar_menu).forEach(sidebar_menu_item => {
    let url = sidebar_menu_item.querySelector('a').href
    let urlObject = new URL(url);
    let pathname = urlObject.pathname;
    let childPart = getParts(pathname);
    console.log({childPart})

    if(parentPart[1] == childPart[1]){
        sidebar_menu_item.classList.add('active');
        return;
    }

    if(sidebar_menu_item.classList.contains("has-dropdown")){
        // console.log(sidebar_menu_item)
        let ul = sidebar_menu_item.querySelector(".sidebar-dropdown-menu")
        Array.from(ul.querySelectorAll('.sidebar-dropdown-menu-item')).forEach(li => {
            let a_item = li.querySelector('a')
            let url = a_item.href
            let urlObject = new URL(url)
            let pathname = urlObject.pathname
            let itemPart = getParts(pathname)
            // console.log(itemPart)

            if(itemPart[2] == parentPart[2]){
                sidebar_menu_item.classList.add('focused')
                li.classList.add('focused')
                ul.style.display='block'
                setTimeout(() => {
                    ul.removeAttribute('style')
                }, 250);
            }
            
        })
        
    }
    
});