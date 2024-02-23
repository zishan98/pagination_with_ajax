<!-- same as your previous code -->
<!-- START SECTION GALLERY -->
<div id="table-data"></div>

<!-- END SECTION GALLERY -->
<!-- same as your previous code -->

<!-- bottom side script  -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function loadTable(page) {
            $.ajax({
                url: "index_gallery.php",
                type: "POST",
                data: {
                    page_no: page
                },
                success: function(data) {
                    $("#table-data").html(data);
                }
            });
        }
        loadTable();
        //Pagination Code
        $(document).on("click", "#pagination a", function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");

            loadTable(page_id);
        })
    });
</script>
