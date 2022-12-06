function validation()
{
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear()-18;
    if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

    today = yyyy+'-'+mm+'-'+dd;
    if(document.getElementById("register_dateNaissance").value < today)
    {
        return true;
    }else{
       alert('vous devez avoir plus de 18ans')
        return false; 
    }
    
}
    //pro
let foo = document.getElementById("register_type");
let bar = document.getElementById("bar");
bar.style.display = 'none';
foo.addEventListener('change', (event) => {
    if (event.target.value === 'Professionnel') {
    bar.style.display = 'inline'; // Show the element.
    document.getElementById("register_siret").required = true;
    document.getElementById("register_raisonSociale").required = true;
    document.getElementById("register_statutJuridique").required = true;
  } else {
    bar.style.display = 'none';
    document.getElementById("register_siret").required = false; 
    document.getElementById("register_raisonSociale").required = false;
    document.getElementById("register_statutJuridique").required = false;// Hide the element.
  }
});
//end pro

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear()-18;
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
   function validatePassword() {
    const passwordConfirm = $('#register_password_second').val();
    const password = $('#register_password_first').val();
    if ( passwordConfirm == password ) {
            return true;
    } else {
            return false;
    }
}
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')
  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity() || !validatePassword() ) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()