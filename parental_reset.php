<?php
if(isset($_POST['submit'])){
	$pin =  ord(substr(@$_POST['mastercode'], 0, 1)).ord(substr(@$_POST['mastercode'],-1));
	}
include ('includes/header.php');
?>

    <div class="col-md-8 mx-auto">
      <center>
        <div class="card no-b">
          <div class="card-body">
            <div class="card bg-primary text-white">
              <div class="card-header">
                <h2><i class="icon icon-lock"></i> Parental PIN Reset</h2>
              </div>
              <div class="card-body">
                <form method="post">
                  <div class="form-group">
                    <label class="control-label" >
                      <h4>Enter Reset Code</h4>
                    </label>
                    <div class="row clearfix">
                      <div class="col mx-auto">
                        <div class="form-group">
                            <input id="mastercode" name="mastercode" placeholder="Master Code" type="text" value="<?=isset($_POST['mastercode']) ? $_POST['mastercode'] : '' ?>"/>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <hr>

                  <div class="form-group">
                    <div>
                      <button class="btn btn-info " name="submit" type="submit">
                        <i class="icon icon-check"></i>Generate PIN
                      </button>
                      <br><br>
                      <div class="blue1 counter-box p-40">
                        <h4>Generated Reset Code</h4>
                        <input class="text-primary" id="code" name="code" placeholder="New Pin"  value="<?php echo @$pin?>" type="text"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </center>
    </div>

<?php include ('includes/footer.php');?>

</body>

</html>
