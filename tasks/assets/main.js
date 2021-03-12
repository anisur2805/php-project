(function ($) {
  $(document).ready(function () {
    $(".complete").on("click", function () {
      var id = $(this).data("taskid");
      $("#taskid").val(id);
      $("#completeForm").submit();
    });

    $(".delete").on("click", function () {
      if (confirm("Are you sure?")) {
        var id = $(this).data("taskid");
        $("#dtaskid").val(id);
        $("#deleteForm").submit();
      }
    });

    $(".incomplete").on("click", function () {
      var id = $(this).data("taskid");
      $("#itaskid").val(id);
      $("#incompleteForm").submit();
    });

    $("#builsubmit").on("click", function () {
		if($("#bulkdelete").val() == "bulkdelete") {
			if( !confirm("Are you sure to delete?")) {
				return false;
			}
		}
	});
  });
})(jQuery);
