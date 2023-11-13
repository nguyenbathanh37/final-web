// change theme
const dark =  document.querySelector('.dark-theme')
const light =  document.querySelector('.light-theme')
const theme =  document.querySelector('.change-theme-btn')

//

dark.addEventListener('click',function(){
    document.body.style.background='black'
    dark.classList.add('d-none')
    light.classList.remove('d-none')
    dark.style.color='black'


    //  custome body
    document.querySelectorAll('.form-video').forEach(function(form){
        form.style.background='black'
    })
    document.querySelectorAll('.inf-video').forEach(function(inf){
        inf.style.color='white'
    })
    document.querySelector('.contain-video-title').style.color='white'

    
    // custome navbar
    document.querySelector('.navbar-main-menu i').style.color='white'
    document.querySelector('.navbar-main').style.background='rgb(30,30,30)'
    document.querySelector('.navbar-main').style.background='linear-gradient(90deg, rgba(30,30,30,1) 22%, rgba(60,21,22,1) 34%, rgba(146,22,24,1) 55%, rgba(75,44,59,1) 98%)'
    document.querySelector('.search-box input').style.background='#1e1e1e'
    document.querySelector('.search-box input').style.color='white'
    





}) 

light.addEventListener('click',function(){
    document.body.style.background='white'
    light.classList.add('d-none')
     dark.classList.remove('d-none')
     light.style.color='white'

    //  custome body
     document.querySelectorAll('.form-video').forEach(function(form){
        form.style.background='white'
    })
    document.querySelectorAll('.inf-video').forEach(function(inf){
        inf.style.color='black'
    })
    document.querySelector('.contain-video-title').style.color='black'


    // custome navbar
    document.querySelector('.navbar-main-menu i').style.color='black'
    document.querySelector('.navbar-main').style.background='rgb(255,196,164)'
    document.querySelector('.navbar-main').style.background='linear-gradient(90deg, rgba(255,196,164,1) 0%, rgba(245,225,164,1) 35%, rgba(137,222,240,1) 100%)'
    document.querySelector('.search-box input').style.background='white'
    document.querySelector('.search-box input').style.color='black'

    

})