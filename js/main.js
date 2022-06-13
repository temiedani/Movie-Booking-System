$(document).ready(function(){
 $('.header').height($(window).height());
 })
 // Basic example to enable sorting of a table based on column
$(document).ready(function () {
$('#dtBasicExample').DataTable({
"ordering": true // false to disable sorting (or any other option)
});
$('.dataTables_length').addClass('bs-select');
});
