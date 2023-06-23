<?php require_once('header.php'); ?>

<h3 class="h3 mb-3 color-success">All Payments History</h3>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Payment History</h4>
            </div>

            <div class="card-body">
                <div class="serching d-flex justify-content-between align-items-center">
                    <div id="slider-wrap" class="mr-4">
                        <div>
                            <label>Amount Between:</label>
                            <span id="age"></span>
                        </div>
                        <div id="slider-range"></div>
                    </div>

                    <div id="table-form">
                        <form id="search-form" class="d-flex">
                            <div id="autocomplete" class="form-group">

                                <input type="text" id="search-box" class="form-control" placeholder="Enter Ammout"
                                    autocomplete="off">
                                <div id="searchList"></div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="height: 41px;margin-left: 10px;" id="search-btn">Serech</button>
                        </form>
                    </div>
                </div>


                <div id="content" class=" mt-4 table-responsive">
                    <table id="table-data" class="table table-striped" id="table-1">
                        <thead>
                            <tr class="">
                                <th class="text-center"> #</th>
                                <th style="min-width: 100px;">Accout Number</th>
                                <th style="min-width: 105px;">Payment Method</th>
                                <th style="min-width: 105px;">Payment Amount</th>
                                <th style="min-width: 105px;">Transaction ID</th>
                                <th>Pay Date</th>
                                <th>Stats</th>
                                <th style="min-width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <!-- jquery ui -->
    <script src="assets/js/jquery-ui-1.12.1.min.js"></script>
    <script>
    $(document).ready(function() {

        var v1 = 0;
        var v2 = 1000;

        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000,
            values: [v1, v2],
            slide: function(event, ui) {
                $("#age").html(ui.values[0] + " - " + ui.values[1]);
                v1 = ui.values[0];
                v2 = ui.values[1];
                loadTable(v1, v2);

            }
        });
        $("#age").html($("#slider-range").slider("values", 0) +
            " - " + $("#slider-range").slider("values", 1));

        function loadTable(range1, range2) {
            $.ajax({
                url: "get-data.php",
                type: "POST",
                data: {
                    range1: range1,
                    range2: range2
                },
                success: function(data) {
                    $("#table-data tbody").html(data);
                }
            });
        }

        loadTable(v1, v2);
    });


    $(document).ready(function(){

// Autocomplete Textbox
$("#search-box").keyup(function(){
  var searchInput = $(this).val();

  if(searchInput != ''){
     $.ajax({
        url: "load-result.php",
        method: "POST",
        data: { searchInput: searchInput},
        success: function(data){
          console.log(data);
          $("#searchList").fadeIn("fast").html(data);
        }
     }); 
  }else{
    $("#searchList").fadeOut();
    $("#table-data").html("");
  }
});

// Autocomplete List Click Code
$(document).on('click','#searchList li',function(){
  $('#search-box').val($(this).text());
  $("#searchList").fadeOut();
});

// Search Button Code
$("#search-btn").on('click', function(e){
  e.preventDefault();

  var searchInput = $('#search-box').val();

  if(searchInput == ""){
    alert("Please enter the city Name.");
    $("#table-data").html("");
  }else{
    $.ajax({
        url: "load-table.php",
        method: "POST",
        data: { searchInput: searchInput},
        success: function(data){
          $("#table-data").html(data);
        }
     }); 
  }
})
});
    </script>
    </body>

    </html>