<?php
$jsondata = file_get_contents("./api/connv2.json");
$json = json_decode($jsondata, true);

if (isset($_POST['submit'])){
    $replacementData = array(
        'success' => ($_POST["ann_status"] == 'ACTIVE') ? '1' : '0',
        "announcement" => (empty($_POST["announcement"])) ? 'Example Announcement' : $_POST["announcement"],
        "ann_status" => (empty($_POST["ann_status"])) ? 'INACTIVE' : $_POST["ann_status"],
        "ann_expire" => (empty($_POST["ann_expire"])) ? '2020-01-01 23:59:59' : $_POST["ann_expire"],
        "ann_interval" => (empty($_POST["ann_interval"])) ? '5' : $_POST["ann_interval"],
        "ann_disappear" => (empty($_POST["ann_disappear"])) ? '1' : $_POST["ann_disappear"]
    );
    $newArrayData = array_replace_recursive($json, $replacementData);
    $newJsonData = json_encode($newArrayData, JSON_PRETTY_PRINT);
    file_put_contents("./api/connv2.json", $newJsonData);
    header("Location: ". basename($_SERVER["SCRIPT_NAME"])."?status=1");
}

include ('includes/header.php');
?>

        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i> In-app Announcement</h2>
                        </center>
                    </div>
                    
                    <div class="card-body">
                            <div class="col-12">
                                <h3> Edit Announcement</h3>
                            </div>
                            <form method="post">
                                <div class="form-group ">
                                    <label class="form-label" for="announcement">Announcement</label>
                                    <input class="form-control" id="announcement" name="announcement" value="<?=$json['announcement']?>" type="text">
                                </div>

                                <div class="form-group ">
                                    <label class="form-label" for="ann_status">Status</label>
                                    <select class="form-control" id="select" name="ann_status">
                                        <option value="INACTIVE" <?=$json['ann_status']=='INACTIVE'?'selected':'' ?> >INACTIVE</option>
                                        <option value="ACTIVE" <?=$json['ann_status']=='ACTIVE'?'selected':'' ?> >ACTIVE</option>
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label" for="datetimepicker">Expiration</label>
									<input type="text" autocomplete="off" readonly id="form_datetime"  autocomplete="off" id="datetimepicker" class="date-time-picker form-control" name="ann_expire" value="<?=$json['ann_expire'] ?>"/>
                                </div>

                                <div class="form-group ">
                                    <label class="form-label" for="interval">Display for (mins)</label>
                                    <input type="text" class="form-control" id="interval" name="ann_interval" placeholder="0 min" value="<?=$json['ann_interval'] ?>">
                                </div>
                                  
                                <div class="form-group ">
                                    <label class="form-label" for="disappear">Disappear after(mins)</label>
                                    <input  type="text" class="form-control" id="disappear" name="ann_disappear" placeholder="0 min" value="<?=$json['ann_disappear'] ?>">
                                </div>

                                <hr>

                                <div class="form-group">
                                  <center>
                                      <button class="btn btn-info" name="submit" type="submit">
                                          <i class="icon icon-check"></i>Submit
                                      </button>
                                  </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>


<?php include ('includes/footer.php');?>

</body>
</html>