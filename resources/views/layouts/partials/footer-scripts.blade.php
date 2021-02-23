
<!-- jQuery -->

		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<!-- Bootstrap Core JS -->

        <!-- Bootstrap Core JS -->
        <script src="{{url(asset("js/popper.min.js"))}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.4/popper.js"></script>
        <script src="{{url(asset("js/bootstrap.min.js"))}}"></script>

		<!-- Slimscroll JS -->
		<script src="{{url(asset("js/jquery.slimscroll.min.js"))}}"></script>

		<!-- Select2 JS -->
		<script src="{{url(asset("js/select2.min.js"))}}"></script>

		<script src="{{url(asset("js/jquery-ui.min.js"))}}"></script>
		<script src="{{url(asset("js/jquery.ui.touch-punch.min.js"))}}"></script>

		<!-- Datetimepicker JS -->
		<script src="{{url(asset("js/moment.min.js"))}}"></script>
		<script src="{{url(asset("js/bootstrap-datetimepicker.min.js"))}}"></script>

		<!-- Calendar JS -->
		<script src="{{url(asset("js/jquery-ui.min.js"))}}"></script>
        <script src="{{url(asset("js/fullcalendar.min.js"))}}"></script>
        <script src="{{url(asset("js/jquery.fullcalendar.js"))}}"></script>

		<!-- Multiselect JS -->
		<script src="{{url(asset("js/multiselect.min.js"))}}"></script>

		<!-- Datatable JS -->
		<script src="{{url(asset("js/jquery.dataTables.min.js"))}}"></script>
		<script src="{{url(asset("js/dataTables.bootstrap4.min.js"))}}"></script>

		<!-- Summernote JS -->
		<script src="{{url(asset("plugins/summernote/dist/summernote-bs4.min.js"))}}"></script>


		<script src="{{url(asset("plugins/sticky-kit-master/dist/sticky-kit.min.js"))}}"></script>

		<!-- Task JS -->
		<script src="{{url(asset("js/task.js"))}}"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>


		<script src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>

		<!-- Dropfiles JS-->
{{--		<script src="js/dropfiles.js"></script>--}}

		<!-- Custom JS -->
		<script src="{{url(asset("js/app.js"))}}"></script>
		<script>
		 $(document).ready(function(){
		     // Read value on page load
        $("#result b").html($("#customRange").val());

        // Read value on change
        $("#customRange").change(function(){
            $("#result b").html($(this).val());
        });
    });
		$(".header").stick_in_parent({

		});
		// This is for the sticky sidebar
		$(".stickyside").stick_in_parent({
			offset_top: 60
		});
		$('.stickyside a').click(function() {
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60
			}, 500);
			return false;
		});
		// This is auto select left sidebar
		// Cache selectors
		// Cache selectors
		var lastId,
			topMenu = $(".stickyside"),
			topMenuHeight = topMenu.outerHeight(),
			// All list items
			menuItems = topMenu.find("a"),
			// Anchors corresponding to menu items
			scrollItems = menuItems.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		// Bind click handler to menu items


		// Bind to scroll
		$(window).scroll(function() {
			// Get container scroll position
			var fromTop = $(this).scrollTop() + topMenuHeight - 250;

			// Get id of current scroll item
			var cur = scrollItems.map(function() {
				if ($(this).offset().top < fromTop)
					return this;
			});
			// Get the id of the current element
			cur = cur[cur.length - 1];
			var id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				lastId = id;
				// Set/remove active class
				menuItems
					.removeClass("active")
					.filter("[href='#" + id + "']").addClass("active");
			}
		});
		$(function () {
			$(document).on("click", '.btn-add-row', function () {
				var id = $(this).closest("table.table-review").attr('id');  // Id of particular table
				console.log(id);
				var div = $("<tr />");
				div.html(GetDynamicTextBox(id));
				$("#"+id+"_tbody").append(div);
			});
			$(document).on("click", "#comments_remove", function () {
				$(this).closest("tr").prev().find('td:last-child').html('<button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button>');
				$(this).closest("tr").remove();
			});
			function GetDynamicTextBox(table_id) {
				$('#comments_remove').remove();
				var rowsLength = document.getElementById(table_id).getElementsByTagName("tbody")[0].getElementsByTagName("tr").length+1;
				return '<td>'+rowsLength+'</td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><input type="text" name = "DynamicTextBox" class="form-control" value = "" ></td>' + '<td><button type="button" class="btn btn-danger" id="comments_remove"><i class="fa fa-trash-o"></i></button></td>'
			}
		});
		</script>
