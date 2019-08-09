<?php 

include_once('../layouts/header.php');
include_once('../layouts/sidebar.php');
?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 mb-7">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12 col-lg-12">
                <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                  <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="../index.html">Users</a>
                    <!-- Form -->
                    <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
                      <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                          </div>
                          <input class="form-control" placeholder="Search" type="text">
                        </div>
                      </div>
                    </form>
                  </div>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-1">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Position</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id = "user-table">
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0" id = "pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php 

include_once('../layouts/js.php');
?>

<script>
  $(document).ready(function() {

    var page = 1;
    var userTable = $("#user-table");
    
    function loadPage() {
        $.ajax({
        method: "GET",
        url: "http://localhost/kal-skills/task-monitoring-back/router/user.php?page="+page,
        success: function(response) {
          userTable.empty();

          var data = response.data;
          var users = data.users;
          var page = data.page;

          users.forEach(function(row) {
            var keys = Object.keys(row);
            var tr = $('<tr></tr>');

            keys.forEach(function(key) {
              var td = $('<td></td>');
              
              td.html(row[key]);
              tr.append(td);
            })

            var action = $('<td></td>');

            var editButton = $('<button></button>');
            var deleteButton = $('<button></button>');

            editButton.attr('data-id', row.id);
            deleteButton.attr('data-id', row.id);

            editButton.html("Change Pass");
            deleteButton.html("Delete");

            editButton.attr('class', "btn btn-success edit-btn");
            deleteButton.attr('class', "btn btn-danger delete-btn");

            action.append(editButton);
            action.append(deleteButton);

            tr.append(action);

            userTable.append(tr);
          });

        },
        error: function(event) {
          var data = event.responseJSON;

          alert(data.message);
        }
      });
    }

    $("#user-table").on('click', '.edit-btn' ,function() {
      var id = $(this).attr('data-id');
      var password = prompt("Please enter your new password");

      if (password != null) {
        $.ajax({
          type: "PATCH",
          url: "http://localhost/kal-skills/task-monitoring-back/router/user.php",
          data: { id: id, password: password },
          success: function(response) {
            alert(response.message)
          },
          error: function(resp) {
            console.log(resp);
          }
        });
      }

    });

    $("#user-table").on('click', '.delete-btn' ,function() {
      var id = $(this).attr('data-id');
      var retVal = confirm("Do you want to delete this record?");
      
      if ( retVal == true ) {
        $.ajax({
          type: "DELETE",
          url: "http://localhost/kal-skills/task-monitoring-back/router/user.php",
          data: { id: id },
          success: function(response) {
            alert(response.message)
          }
        });
      }
    });


    loadPage();
  });
</script>
<?php
include_once('../layouts/footer.php');
?>
