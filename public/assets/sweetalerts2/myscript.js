const flashData = $(".flash-data").data("flashdata");
if (flashData) {
  Swal.fire({
    title: "System",
    text: flashData,
    icon: "success",
    confirmButtonText: "OK",
  });
}

//Button Delete Brand
$("#delete-brand").on("click", function (e) {
  e.preventDefault();
  var form = $(this).parents("form");
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      form.submit();
    }
  });
});
