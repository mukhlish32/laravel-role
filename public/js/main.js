
// Event DOMContentLoaded
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Simple-DataTables Tabel
    // https://github.com/fiduswriter/Simple-DataTables/wiki
    
    const datatablesSimple = document.getElementById('datatable');
    if (datatablesSimple) {
        
        new simpleDatatables.DataTable(datatablesSimple);
        
    }
    // let table = $('#datatable').DataTable({sDom: 'lrtip'});
});

// Event Button Go to Top
let goTop = document.getElementById("btn-go-top");
goTop.addEventListener('click', event => {
    // Fitur Button go to top
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

// function checkAll(ele) {
//     var checkboxes = document.getElementsById('chk_akses');
//     if (ele.checked) {
//         for (var i = 0; i < checkboxes.length; i++) {
//             if (checkboxes[i].type == 'checkbox' ) {
//                 checkboxes[i].checked = true;
//             }
//         }
//     } else {
//         for (var i = 0; i < checkboxes.length; i++) {
//             if (checkboxes[i].type == 'checkbox') {
//                 checkboxes[i].checked = false;
//             }
//         }
//     }
// }

$('button#deletebox').on('click', function (event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Are you sure you want to delete ${name}?`,
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit();
      }
    });
});

function warningbox(event) {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
            swal({
      title: "Are you sure?",
      text: "But you will still be able to retrieve this file.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, Delete it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
          window.location.href="delete.php?delete_id="+id;
        swal("Updated!", "Your imaginary file has been Deleted.", "success");   
    
      } else {
        swal("Cancelled", "Your file is safe :)", "error");
      }
    });
}

