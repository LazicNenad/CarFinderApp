const contentDivs = document.querySelectorAll('.col-lg-8.col-md-7.mb-5');
const allUserBtns = document.querySelectorAll('.card-nav-link.d');

// const personalInfoBtn = document.getElementById('personal-info-btn');
// const passwordSecurityBtn = document.getElementById('password-security-btn');
// const myCarsBtn = document.getElementById('my-cars-btn');
// const wishListBtn = document.getElementById('wishlist-btn');

// personalInfoBtn.classList.remove('active');
contentDivs.forEach((div) => {
    div.style.display = 'none'
})

contentDivs[0].style.display = 'block';

allUserBtns.forEach((btn, index) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        contentDivs.forEach((div) => {
            div.style.display = 'none';
            contentDivs[index].style.display = 'block';
            allUserBtns.forEach((btn) => {
                btn.classList.remove('active');
            })
            e.target.classList.add('active');
            document.getElementById('breadcrumb').innerText = e.target.text.trim();
        })
    })
})

// personalInfoBtn.addEventListener('click', (e) => {
//     e.preventDefault();
//     contentDivs.forEach((div) => {
//         div.style.display = 'none';
//         contentDivs[0].style.display = 'block';
//         allUserBtns.forEach((btn) => {
//             btn.classList.remove('active');
//         })
//         personalInfoBtn.classList.add('active');
//     })
// })
//
// passwordSecurityBtn.addEventListener('click', (e) => {
//    e.preventDefault();
//     contentDivs.forEach((div) => {
//         div.style.display = 'none';
//         contentDivs[1].style.display = 'block';
//         allUserBtns.forEach((btn) => {
//             btn.classList.remove('active');
//         })
//         passwordSecurityBtn.classList.add('active');
//     })
// });
