window.addEventListener("beforeunload",function(e){
    document.body.classList.add("page-loading");
    alert('hello')
},false);