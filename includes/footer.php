      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src= "js/switch.js"></script> 
<script src="js/bootstrap-datetimepicker.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="js/particles.js"></script>
</body>

</html>
<script type="text/javascript">
    $("#form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
</script> 




<script>



    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

  $(function() {
    $inp = $("#btn_signup");
    $cb = $("#checkbox");
    if ($cb.is(':checked')) 
    {
      $inp.prop('disabled', false);
    }
    else
    {
      $inp.prop('disabled', true);
    }

    $cb.on('change', function() 
    {
      if ($cb.is(':checked')) {
        $inp.prop('disabled', false);
      } else {
        $inp.prop('disabled', true);
      }
    });
  });

$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").alert('close');
});

  $(".inputs").keyup(function() 
  {
    if (this.value.length == this.maxLength) 
    {
      $(this).nextAll('.inputs:enabled:first').focus();
    }
  });

    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

$('.autosubmit').on('change', function(){  
  $(this).parent('form').submit();
});

//themes
jQuery(function($) {
    $('body').on('click', '.change-style-menu-item', function() {
      var theme_name = $(this).attr('rel');
      var theme = "css/themes/" + theme_name + "/bootstrap.css";
      set_theme(theme);
    });
});
function set_theme(theme) {
  $('link[title="main"]').attr('href', theme);
}
function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
  } catch (e) {
    return false;
  }
}

var supports_storage = supports_html5_storage();

function set_theme(theme) {
  $('link[title="main"]').attr('href', theme);
  if (supports_storage) {
    localStorage.theme = theme;
  }
}
if (supports_storage) {
  var theme = localStorage.theme;
  if (theme) {
    set_theme(theme);
  }
} else {
  $('#theme-dropdown').hide();
}

</script>