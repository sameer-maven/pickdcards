$(document).ready(function(){
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  
  Toast.fire({
    icon: 'success',
    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
  });
});