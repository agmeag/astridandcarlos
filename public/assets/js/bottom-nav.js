var bottom_nav = false;


function changeNavState() {
    let options = document.getElementById('options');
    if (!bottom_nav) {
        options.classList.replace("bottom-links-inactive", "bottom-links");
    } else {
        options.classList.replace("bottom-links", "bottom-links-inactive");
    }
    bottom_nav = !bottom_nav;
}

document.getElementById('bottom-nav').addEventListener('swiped-up', (e) => {
    let options = document.getElementById('options');
    // console.log('SWIPED UP');
    options.classList.replace("bottom-links-inactive", "bottom-links");
});

document.getElementById('bottom-nav').addEventListener('swiped-down', (e) => {
    let options = document.getElementById('options');
    // console.log('SWIPED DOWN');
    options.classList.replace("bottom-links", "bottom-links-inactive");
});