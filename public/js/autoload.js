 window.addEventListener("load", function(){
     // show login modal on load
             $('#exampleModalCenter').modal('toggle');
 });

 let loginIcon = document.getElementById('loginIcon')
 loginIcon.onclick = function () {
     $('#exampleModalCenter').modal('toggle');
 }

 let loginModalToggler = document.getElementById('loginModalToggler')
 if (loginModalToggler) {
     loginModalToggler.onclick = function () {
         $('#exampleModalCenter').modal('toggle');
     }
 }
