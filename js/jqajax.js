$("tbody").on("click","del",function()
{
    console.log("Delete icon clicked");
    let id = $(this).attr("data-sid");
    console.log(id);
});




Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      )
    }
  })


  document.getElementById("cancelbutton").onclick = function()
{
    location.herf = "welcome.php";
}

  document.getElementById("btnadd").onclick = function()
  {
    location.herf = "welcome.php";
  }