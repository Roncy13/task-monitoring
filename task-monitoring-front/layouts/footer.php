  
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
  <script>
    $(document).ready(function() {
      $("#logout").click(function(event) {
        event.preventDefault();
        localStorage.removeItem('user');
        window.location.href = "../login.php";
      });

      var user = window.user;

      if (user.title !== "admin") {
        $(".admin").hide();
      }

      $("#sidebar").removeClass('d-none');

    });
  </script>
</body>

</html>