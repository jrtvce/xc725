<?php
//db call
$db = new SQLite3('./api/.db.db');

//table name
$table_name = "vpn";

//header title
$Htitle = "OVPN Servers";

//current file var
$base_file = basename($_SERVER["SCRIPT_NAME"]);

//create if not
$db->exec("CREATE TABLE IF NOT EXISTS {$table_name}(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, 
													userid text, vpn_appid TEXT, 
													vpn_country TEXT, 
													vpn_state TEXT, 
													vpn_config TEXT, 
													vpn_status TEXT, 
													auth_type TEXT, 
													auth_embedded TEXT, 
													username TEXT, 
													password TEXT, 
													date TEXT)");

//table call
$res = $db->query("SELECT * FROM {$table_name}");

//update call
@$resU = $db->query("SELECT * FROM {$table_name} WHERE id='".$_GET['update']."'");
@$rowU=$resU->fetchArray();
if(isset($_POST['submitU'])){
	$db->exec("UPDATE {$table_name} SET vpn_country='".$_POST['vpn_country']."',
											vpn_state='".$_POST['vpn_state']."', 
											vpn_config='".$_POST['vpn_config']."', 
											vpn_status='".$_POST['vpn_status']."', 
											auth_type='".$_POST['auth_type']."', 
											auth_embedded='".$_POST['auth_embedded']."', 
											username='".$_POST['username']."', 
											password='".$_POST['password']."', 
											date='".$_POST['date']."'
										WHERE 
											id='".$_GET['update']."'");
	$db->close();
	header("Location: {$base_file}?status=1");
}

//submit new
if (isset($_POST['submit'])){

	$db->exec("INSERT INTO {$table_name}(userid,
										 vpn_appid, 
										 vpn_country, 
										 vpn_state, 
										 vpn_config, 
										 vpn_status, 
										 auth_type, 
										 auth_embedded, 
										 username, 
										 password, 
										 date
										 ) 
								VALUES( '".$_POST['userid']."', 
										'".$_POST['vpn_appid']."', 
										'".$_POST['vpn_country']."', 
										'".$_POST['vpn_state']."', 
										'".$_POST['vpn_config']."', 
										'".$_POST['vpn_status']."', 
										'".$_POST['auth_type']."', 
										'".$_POST['auth_embedded']."', 
										'".$_POST['username']."', 
										'".$_POST['password']."', 
										'".$_POST['date']."'
										)");
	$db->close();
	header("Location: {$base_file}?status=1");
	}

//delete row
if(isset($_GET['delete'])){
	$db->exec("DELETE FROM {$table_name} WHERE id=".$_GET['delete']);
	header("Location: {$base_file}?status=1");
}

include ('includes/header.php');

//delete modal
?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Confirm</h2>
            </div>
            <div class="modal-body">
                Do you really want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['create'])){

//create form
?>
        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i><?php echo $Htitle ?></h2>
                        </center>
                    </div>
                    
                    <div class="card-body">

                        <div class="col-12">
                            <h3>Add OVPN Server</h3>
                        </div>
                            <form method="post">
                                <input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d h:i:s"); ?>" type="hidden"/>
                                <input class="form-control" id="userid" name="userid" value='521064' type="hidden"/>
                                <input class="form-control" id="vpn_appid" name="vpn_appid" value='1646' type="hidden"/>
                                <div class="form-group ">
                                    <label class="control-label " for="vpn_state">
                                        State/Province
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="vpn_state" name="vpn_state" placeholder="Enter State/Province" value='' type="text"/>
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="vpn_config">
                                        OpenVPN Config URL
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="vpn_config" name="vpn_config" placeholder="Enter OpenVPN Config URL" value='' type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="auth_type" >
                                        Authentication Type
                                    </label>
                                    <select class="select form-control" id="auth_type" name="auth_type">
                                        <option value="noup">
                                            Username and Password are not required
                                        </option>
                                        <option value="up">
                                            Username and Password required
                                        </option>
                                        <option value="kp">
                                            Key file password Required
                                        </option>
                                                          
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label " for="username">
                                        Embedded Username
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="username" name="username" placeholder="Enter Username" value='' type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="password">
                                        Embedded Password 
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="password" name="password" placeholder="Enter Password" value='' type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="vpn_status" >
                                        Status
                                    </label>
                                    <select class="select form-control" id="vpn_status" name="vpn_status">
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="auth_embedded" >
                                        Auth Embedded
                                    </label>
                                    <select class="select form-control" id="auth_embedded" name="auth_embedded">
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="auth_embedded" hidden>Auth Embedded</label>
                                    <select class="select form-control" id="select" name="auth_embedded" hidden>
                                        <option value="NO">NO</option>
                                        <option value="YES">YES</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="vpn_country">vpn_country</label>
                                    <select class="select form-control" id="select" name="vpn_country">
                                            <option value="AF">Afghanistan</option>
                                            <option value="AX">Åland Islands</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia, Plurinational State of</option>
                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA">Bosnia and Herzegovina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verde</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo, the Democratic Republic of the</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Côte d'Ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curaçao</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernsey</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island and McDonald Islands</option>
                                            <option value="VA">Holy See (Vatican City State)</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran, Islamic Republic of</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IM">Isle of Man</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KP">Korea, Democratic People's Republic of</option>
                                            <option value="KR">Korea, Republic of</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Lao People's Democratic Republic</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia, Federated States of</option>
                                            <option value="MD">Moldova, Republic of</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="ME">Montenegro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigeria</option>
                                            <option value="NU">Niue</option>
                                            <option value="NF">Norfolk Island</option>
                                            <option value="MP">Northern Mariana Islands</option>
                                            <option value="NO">Norway</option>
                                            <option value="OM">Oman</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palau</option>
                                            <option value="PS">Palestinian Territory, Occupied</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papua New Guinea</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="PE">Peru</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Réunion</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="BL">Saint Barthélemy</option>
                                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                            <option value="KN">Saint Kitts and Nevis</option>
                                            <option value="LC">Saint Lucia</option>
                                            <option value="MF">Saint Martin (French part)</option>
                                            <option value="PM">Saint Pierre and Miquelon</option>
                                            <option value="VC">Saint Vincent and the Grenadines</option>
                                            <option value="WS">Samoa</option>
                                            <option value="SM">San Marino</option>
                                            <option value="ST">Sao Tome and Principe</option>
                                            <option value="SA">Saudi Arabia</option>
                                            <option value="SN">Senegal</option>
                                            <option value="RS">Serbia</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra Leone</option>
                                            <option value="SG">Singapore</option>
                                            <option value="SX">Sint Maarten (Dutch part)</option>
                                            <option value="SK">Slovakia</option>
                                            <option value="SI">Slovenia</option>
                                            <option value="SB">Solomon Islands</option>
                                            <option value="SO">Somalia</option>
                                            <option value="ZA">South Africa</option>
                                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                                            <option value="SS">South Sudan</option>
                                            <option value="ES">Spain</option>
                                            <option value="LK">Sri Lanka</option>
                                            <option value="SD">Sudan</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SE">Sweden</option>
                                            <option value="CH">Switzerland</option>
                                            <option value="SY">Syrian Arab Republic</option>
                                            <option value="TW">Taiwan, Province of China</option>
                                            <option value="TJ">Tajikistan</option>
                                            <option value="TZ">Tanzania, United Republic of</option>
                                            <option value="TH">Thailand</option>
                                            <option value="TL">Timor-Leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinidad and Tobago</option>
                                            <option value="TN">Tunisia</option>
                                            <option value="TR">Turkey</option>
                                            <option value="TM">Turkmenistan</option>
                                            <option value="TC">Turks and Caicos Islands</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UG">Uganda</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="AE">United Arab Emirates</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                            <option value="UM">United States Minor Outlying Islands</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="UZ">Uzbekistan</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                                            <option value="VN">Viet Nam</option>
                                            <option value="VG">Virgin Islands, British</option>
                                            <option value="VI">Virgin Islands, U.S.</option>
                                            <option value="WF">Wallis and Futuna</option>
                                            <option value="EH">Western Sahara</option>
                                            <option value="YE">Yemen</option>
                                            <option value="ZM">Zambia</option>
                                            <option value="ZW">Zimbabwe</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-info " name="submit" type="submit">
                                            <i class="icon icon-check"></i> Submit
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

<?php 
}else if (isset($_GET['update'])){ 

//update form
?>
        <div class="col-md-8 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-bullhorn"></i><?php echo $Htitle ?></h2>
                        </center>
                    </div>
                    
                    <div class="card-body">

                        <div class="col-12">
                            <h3>Add OVPN Server</h3>
                        </div>
                            <form method="post">
                                <input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d h:i:s"); ?>" type="hidden"/>
                                <input class="form-control" id="userid" name="userid" value='521064' type="hidden"/>
                                <input class="form-control" id="vpn_appid" name="vpn_appid" value='1646' type="hidden"/>
                                <div class="form-group ">
                                    <label class="control-label " for="vpn_state">
                                        State/Province
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="vpn_state" name="vpn_state" placeholder="Enter State/Province" value="<?=$rowU['vpn_state'] ?>" type="text"/>
                                    </div>

                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="vpn_config">
                                        OpenVPN Config URL
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="vpn_config" name="vpn_config" placeholder="Enter OpenVPN Config URL" value="<?=$rowU['vpn_config'] ?>" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="auth_type" >
                                        Authentication Type
                                    </label>
                                    <select class="select form-control" id="auth_type" name="auth_type">
                                        <option value="noup" <?=$rowU['auth_type']=='noup'?'selected':'' ?>>Username and Password are not required</option>
                                        <option value="up" <?=$rowU['auth_type']=='up'?'selected':'' ?>>Username and Password required</option>
                                        <option value="kp" <?=$rowU['auth_type']=='kp'?'selected':'' ?>>Key file password Required</option>
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label class="control-label " for="username">
                                        Embedded Username
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="username" name="username" placeholder="Enter Username" value="<?=$rowU['username'] ?>" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="password">
                                        Embedded Password 
                                    </label>
                                    <div class="input-group">
                                        <input class="form-control" id="password" name="password" placeholder="Enter Password" value="<?=$rowU['password'] ?>" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="vpn_status" >
                                        Status
                                    </label>
                                    <select class="select form-control" id="vpn_status" name="vpn_status">
                                        <option value="ACTIVE" <?=$rowU['vpn_status']=='ACTIVE'?'selected':'' ?>>ACTIVE</option>
                                        <option value="INACTIVE" <?=$rowU['vpn_status']=='INACTIVE'?'selected':'' ?>>INACTIVE</option>
                  
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label " for="auth_embedded" >
                                        Auth Embedded
                                    </label>
                                    <select class="select form-control" id="auth_embedded" name="auth_embedded">
                                        <option value="NO" <?=$rowU['auth_embedded']=='NO'?'selected':'' ?>>NO</option>
                                        <option value="YES" <?=$rowU['auth_embedded']=='YES'?'selected':'' ?>>YES</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="vpn_country">vpn_country</label>
                                    <select class="select form-control" id="select" name="vpn_country">
                                            <option value="AF" <?=$rowU['vpn_country']=='AF'?'selected':'' ?>>Afghanistan</option>
                                            <option value="AX" <?=$rowU['vpn_country']=='AX'?'selected':'' ?>>Åland Islands</option>
                                            <option value="AL" <?=$rowU['vpn_country']=='AL'?'selected':'' ?>>Albania</option>
                                            <option value="DZ" <?=$rowU['vpn_country']=='DZ'?'selected':'' ?>>Algeria</option>
                                            <option value="AS" <?=$rowU['vpn_country']=='AS'?'selected':'' ?>>American Samoa</option>
                                            <option value="AD" <?=$rowU['vpn_country']=='AD'?'selected':'' ?>>Andorra</option>
                                            <option value="AO" <?=$rowU['vpn_country']=='AO'?'selected':'' ?>>Angola</option>
                                            <option value="AI" <?=$rowU['vpn_country']=='AI'?'selected':'' ?>>Anguilla</option>
                                            <option value="AQ" <?=$rowU['vpn_country']=='AQ'?'selected':'' ?>>Antarctica</option>
                                            <option value="AG" <?=$rowU['vpn_country']=='AG'?'selected':'' ?>>Antigua and Barbuda</option>
                                            <option value="AR" <?=$rowU['vpn_country']=='AR'?'selected':'' ?>>Argentina</option>
                                            <option value="AM" <?=$rowU['vpn_country']=='AM'?'selected':'' ?>>Armenia</option>
                                            <option value="AW" <?=$rowU['vpn_country']=='AW'?'selected':'' ?>>Aruba</option>
                                            <option value="AU" <?=$rowU['vpn_country']=='AU'?'selected':'' ?>>Australia</option>
                                            <option value="AT" <?=$rowU['vpn_country']=='AT'?'selected':'' ?>>Austria</option>
                                            <option value="AZ" <?=$rowU['vpn_country']=='AZ'?'selected':'' ?>>Azerbaijan</option>
                                            <option value="BS" <?=$rowU['vpn_country']=='BS'?'selected':'' ?>>Bahamas</option>
                                            <option value="BH" <?=$rowU['vpn_country']=='BH'?'selected':'' ?>>Bahrain</option>
                                            <option value="BD" <?=$rowU['vpn_country']=='BD'?'selected':'' ?>>Bangladesh</option>
                                            <option value="BB" <?=$rowU['vpn_country']=='BB'?'selected':'' ?>>Barbados</option>
                                            <option value="BY" <?=$rowU['vpn_country']=='BY'?'selected':'' ?>>Belarus</option>
                                            <option value="BE" <?=$rowU['vpn_country']=='BE'?'selected':'' ?>>Belgium</option>
                                            <option value="BZ" <?=$rowU['vpn_country']=='BZ'?'selected':'' ?>>Belize</option>
                                            <option value="BJ" <?=$rowU['vpn_country']=='BJ'?'selected':'' ?>>Benin</option>
                                            <option value="BM" <?=$rowU['vpn_country']=='BM'?'selected':'' ?>>Bermuda</option>
                                            <option value="BT" <?=$rowU['vpn_country']=='BT'?'selected':'' ?>>Bhutan</option>
                                            <option value="BO" <?=$rowU['vpn_country']=='BO'?'selected':'' ?>>Bolivia, Plurinational State of</option>
                                            <option value="BQ" <?=$rowU['vpn_country']=='BQ'?'selected':'' ?>>Bonaire, Sint Eustatius and Saba</option>
                                            <option value="BA" <?=$rowU['vpn_country']=='BA'?'selected':'' ?>>Bosnia and Herzegovina</option>
                                            <option value="BW" <?=$rowU['vpn_country']=='BW'?'selected':'' ?>>Botswana</option>
                                            <option value="BV" <?=$rowU['vpn_country']=='BV'?'selected':'' ?>>Bouvet Island</option>
                                            <option value="BR" <?=$rowU['vpn_country']=='BR'?'selected':'' ?>>Brazil</option>
                                            <option value="IO" <?=$rowU['vpn_country']=='IO'?'selected':'' ?>>British Indian Ocean Territory</option>
                                            <option value="BN" <?=$rowU['vpn_country']=='BN'?'selected':'' ?>>Brunei Darussalam</option>
                                            <option value="BG" <?=$rowU['vpn_country']=='BG'?'selected':'' ?>>Bulgaria</option>
                                            <option value="BF" <?=$rowU['vpn_country']=='BF'?'selected':'' ?>>Burkina Faso</option>
                                            <option value="BI" <?=$rowU['vpn_country']=='BI'?'selected':'' ?>>Burundi</option>
                                            <option value="KH" <?=$rowU['vpn_country']=='KH'?'selected':'' ?>>Cambodia</option>
                                            <option value="CM" <?=$rowU['vpn_country']=='CM'?'selected':'' ?>>Cameroon</option>
                                            <option value="CA" <?=$rowU['vpn_country']=='CA'?'selected':'' ?>>Canada</option>
                                            <option value="CV" <?=$rowU['vpn_country']=='CV'?'selected':'' ?>>Cape Verde</option>
                                            <option value="KY" <?=$rowU['vpn_country']=='KY'?'selected':'' ?>>Cayman Islands</option>
                                            <option value="CF" <?=$rowU['vpn_country']=='CF'?'selected':'' ?>>Central African Republic</option>
                                            <option value="TD" <?=$rowU['vpn_country']=='TD'?'selected':'' ?>>Chad</option>
                                            <option value="CL" <?=$rowU['vpn_country']=='CL'?'selected':'' ?>>Chile</option>
                                            <option value="CN" <?=$rowU['vpn_country']=='CN'?'selected':'' ?>>China</option>
                                            <option value="CX" <?=$rowU['vpn_country']=='CX'?'selected':'' ?>>Christmas Island</option>
                                            <option value="CC" <?=$rowU['vpn_country']=='CC'?'selected':'' ?>>Cocos (Keeling) Islands</option>
                                            <option value="CO" <?=$rowU['vpn_country']=='CO'?'selected':'' ?>>Colombia</option>
                                            <option value="KM" <?=$rowU['vpn_country']=='KM'?'selected':'' ?>>Comoros</option>
                                            <option value="CG" <?=$rowU['vpn_country']=='CG'?'selected':'' ?>>Congo</option>
                                            <option value="CD" <?=$rowU['vpn_country']=='CD'?'selected':'' ?>>Congo, the Democratic Republic of the</option>
                                            <option value="CK" <?=$rowU['vpn_country']=='CK'?'selected':'' ?>>Cook Islands</option>
                                            <option value="CR" <?=$rowU['vpn_country']=='CR'?'selected':'' ?>>Costa Rica</option>
                                            <option value="CI" <?=$rowU['vpn_country']=='CI'?'selected':'' ?>>Côte d'Ivoire</option>
                                            <option value="HR" <?=$rowU['vpn_country']=='HR'?'selected':'' ?>>Croatia</option>
                                            <option value="CU" <?=$rowU['vpn_country']=='CU'?'selected':'' ?>>Cuba</option>
                                            <option value="CW" <?=$rowU['vpn_country']=='CW'?'selected':'' ?>>Curaçao</option>
                                            <option value="CY" <?=$rowU['vpn_country']=='CY'?'selected':'' ?>>Cyprus</option>
                                            <option value="CZ" <?=$rowU['vpn_country']=='CZ'?'selected':'' ?>>Czech Republic</option>
                                            <option value="DK" <?=$rowU['vpn_country']=='DK'?'selected':'' ?>>Denmark</option>
                                            <option value="DJ" <?=$rowU['vpn_country']=='DJ'?'selected':'' ?>>Djibouti</option>
                                            <option value="DM" <?=$rowU['vpn_country']=='DM'?'selected':'' ?>>Dominica</option>
                                            <option value="DO" <?=$rowU['vpn_country']=='DO'?'selected':'' ?>>Dominican Republic</option>
                                            <option value="EC" <?=$rowU['vpn_country']=='EC'?'selected':'' ?>>Ecuador</option>
                                            <option value="EG" <?=$rowU['vpn_country']=='EG'?'selected':'' ?>>Egypt</option>
                                            <option value="SV" <?=$rowU['vpn_country']=='SV'?'selected':'' ?>>El Salvador</option>
                                            <option value="GQ" <?=$rowU['vpn_country']=='GQ'?'selected':'' ?>>Equatorial Guinea</option>
                                            <option value="ER" <?=$rowU['vpn_country']=='ER'?'selected':'' ?>>Eritrea</option>
                                            <option value="EE" <?=$rowU['vpn_country']=='EE'?'selected':'' ?>>Estonia</option>
                                            <option value="ET" <?=$rowU['vpn_country']=='ET'?'selected':'' ?>>Ethiopia</option>
                                            <option value="FK" <?=$rowU['vpn_country']=='FK'?'selected':'' ?>>Falkland Islands (Malvinas)</option>
                                            <option value="FO" <?=$rowU['vpn_country']=='FO'?'selected':'' ?>>Faroe Islands</option>
                                            <option value="FJ" <?=$rowU['vpn_country']=='FJ'?'selected':'' ?>>Fiji</option>
                                            <option value="FI" <?=$rowU['vpn_country']=='FI'?'selected':'' ?>>Finland</option>
                                            <option value="FR" <?=$rowU['vpn_country']=='FR'?'selected':'' ?>>France</option>
                                            <option value="GF" <?=$rowU['vpn_country']=='GF'?'selected':'' ?>>French Guiana</option>
                                            <option value="PF" <?=$rowU['vpn_country']=='PF'?'selected':'' ?>>French Polynesia</option>
                                            <option value="TF" <?=$rowU['vpn_country']=='TF'?'selected':'' ?>>French Southern Territories</option>
                                            <option value="GA" <?=$rowU['vpn_country']=='GA'?'selected':'' ?>>Gabon</option>
                                            <option value="GM" <?=$rowU['vpn_country']=='GM'?'selected':'' ?>>Gambia</option>
                                            <option value="GE" <?=$rowU['vpn_country']=='GE'?'selected':'' ?>>Georgia</option>
                                            <option value="DE" <?=$rowU['vpn_country']=='DE'?'selected':'' ?>>Germany</option>
                                            <option value="GH" <?=$rowU['vpn_country']=='GH'?'selected':'' ?>>Ghana</option>
                                            <option value="GI" <?=$rowU['vpn_country']=='GI'?'selected':'' ?>>Gibraltar</option>
                                            <option value="GR" <?=$rowU['vpn_country']=='GR'?'selected':'' ?>>Greece</option>
                                            <option value="GL" <?=$rowU['vpn_country']=='GL'?'selected':'' ?>>Greenland</option>
                                            <option value="GD" <?=$rowU['vpn_country']=='GD'?'selected':'' ?>>Grenada</option>
                                            <option value="GP" <?=$rowU['vpn_country']=='GP'?'selected':'' ?>>Guadeloupe</option>
                                            <option value="GU" <?=$rowU['vpn_country']=='GU'?'selected':'' ?>>Guam</option>
                                            <option value="GT" <?=$rowU['vpn_country']=='GT'?'selected':'' ?>>Guatemala</option>
                                            <option value="GG" <?=$rowU['vpn_country']=='GG'?'selected':'' ?>>Guernsey</option>
                                            <option value="GN" <?=$rowU['vpn_country']=='GN'?'selected':'' ?>>Guinea</option>
                                            <option value="GW" <?=$rowU['vpn_country']=='GW'?'selected':'' ?>>Guinea-Bissau</option>
                                            <option value="GY" <?=$rowU['vpn_country']=='GY'?'selected':'' ?>>Guyana</option>
                                            <option value="HT" <?=$rowU['vpn_country']=='HT'?'selected':'' ?>>Haiti</option>
                                            <option value="HM" <?=$rowU['vpn_country']=='HM'?'selected':'' ?>>Heard Island and McDonald Islands</option>
                                            <option value="VA" <?=$rowU['vpn_country']=='VA'?'selected':'' ?>>Holy See (Vatican City State)</option>
                                            <option value="HN" <?=$rowU['vpn_country']=='HN'?'selected':'' ?>>Honduras</option>
                                            <option value="HK" <?=$rowU['vpn_country']=='HK'?'selected':'' ?>>Hong Kong</option>
                                            <option value="HU" <?=$rowU['vpn_country']=='HU'?'selected':'' ?>>Hungary</option>
                                            <option value="IS" <?=$rowU['vpn_country']=='IS'?'selected':'' ?>>Iceland</option>
                                            <option value="IN" <?=$rowU['vpn_country']=='IN'?'selected':'' ?>>India</option>
                                            <option value="ID" <?=$rowU['vpn_country']=='ID'?'selected':'' ?>>Indonesia</option>
                                            <option value="IR" <?=$rowU['vpn_country']=='IR'?'selected':'' ?>>Iran, Islamic Republic of</option>
                                            <option value="IQ" <?=$rowU['vpn_country']=='IQ'?'selected':'' ?>>Iraq</option>
                                            <option value="IE" <?=$rowU['vpn_country']=='IE'?'selected':'' ?>>Ireland</option>
                                            <option value="IM" <?=$rowU['vpn_country']=='IM'?'selected':'' ?>>Isle of Man</option>
                                            <option value="IL" <?=$rowU['vpn_country']=='IL'?'selected':'' ?>>Israel</option>
                                            <option value="IT" <?=$rowU['vpn_country']=='IT'?'selected':'' ?>>Italy</option>
                                            <option value="JM" <?=$rowU['vpn_country']=='JM'?'selected':'' ?>>Jamaica</option>
                                            <option value="JP" <?=$rowU['vpn_country']=='JP'?'selected':'' ?>>Japan</option>
                                            <option value="JE" <?=$rowU['vpn_country']=='JE'?'selected':'' ?>>Jersey</option>
                                            <option value="JO" <?=$rowU['vpn_country']=='JO'?'selected':'' ?>>Jordan</option>
                                            <option value="KZ" <?=$rowU['vpn_country']=='KZ'?'selected':'' ?>>Kazakhstan</option>
                                            <option value="KE" <?=$rowU['vpn_country']=='KE'?'selected':'' ?>>Kenya</option>
                                            <option value="KI" <?=$rowU['vpn_country']=='KI'?'selected':'' ?>>Kiribati</option>
                                            <option value="KP" <?=$rowU['vpn_country']=='KP'?'selected':'' ?>>Korea, Democratic People's Republic of</option>
                                            <option value="KR" <?=$rowU['vpn_country']=='KR'?'selected':'' ?>>Korea, Republic of</option>
                                            <option value="KW" <?=$rowU['vpn_country']=='KW'?'selected':'' ?>>Kuwait</option>
                                            <option value="KG" <?=$rowU['vpn_country']=='KG'?'selected':'' ?>>Kyrgyzstan</option>
                                            <option value="LA" <?=$rowU['vpn_country']=='LA'?'selected':'' ?>>Lao People's Democratic Republic</option>
                                            <option value="LV" <?=$rowU['vpn_country']=='LV'?'selected':'' ?>>Latvia</option>
                                            <option value="LB" <?=$rowU['vpn_country']=='LB'?'selected':'' ?>>Lebanon</option>
                                            <option value="LS" <?=$rowU['vpn_country']=='LS'?'selected':'' ?>>Lesotho</option>
                                            <option value="LR" <?=$rowU['vpn_country']=='LR'?'selected':'' ?>>Liberia</option>
                                            <option value="LY" <?=$rowU['vpn_country']=='LY'?'selected':'' ?>>Libya</option>
                                            <option value="LI" <?=$rowU['vpn_country']=='LI'?'selected':'' ?>>Liechtenstein</option>
                                            <option value="LT" <?=$rowU['vpn_country']=='LT'?'selected':'' ?>>Lithuania</option>
                                            <option value="LU" <?=$rowU['vpn_country']=='LU'?'selected':'' ?>>Luxembourg</option>
                                            <option value="MO" <?=$rowU['vpn_country']=='MO'?'selected':'' ?>>Macao</option>
                                            <option value="MK" <?=$rowU['vpn_country']=='MK'?'selected':'' ?>>Macedonia, the former Yugoslav Republic of</option>
                                            <option value="MG" <?=$rowU['vpn_country']=='MG'?'selected':'' ?>>Madagascar</option>
                                            <option value="MW" <?=$rowU['vpn_country']=='MW'?'selected':'' ?>>Malawi</option>
                                            <option value="MY" <?=$rowU['vpn_country']=='MY'?'selected':'' ?>>Malaysia</option>
                                            <option value="MV" <?=$rowU['vpn_country']=='MV'?'selected':'' ?>>Maldives</option>
                                            <option value="ML" <?=$rowU['vpn_country']=='ML'?'selected':'' ?>>Mali</option>
                                            <option value="MT" <?=$rowU['vpn_country']=='MT'?'selected':'' ?>>Malta</option>
                                            <option value="MH" <?=$rowU['vpn_country']=='MH'?'selected':'' ?>>Marshall Islands</option>
                                            <option value="MQ" <?=$rowU['vpn_country']=='MQ'?'selected':'' ?>>Martinique</option>
                                            <option value="MR" <?=$rowU['vpn_country']=='MR'?'selected':'' ?>>Mauritania</option>
                                            <option value="MU" <?=$rowU['vpn_country']=='MU'?'selected':'' ?>>Mauritius</option>
                                            <option value="YT" <?=$rowU['vpn_country']=='YT'?'selected':'' ?>>Mayotte</option>
                                            <option value="MX" <?=$rowU['vpn_country']=='MX'?'selected':'' ?>>Mexico</option>
                                            <option value="FM" <?=$rowU['vpn_country']=='FM'?'selected':'' ?>>Micronesia, Federated States of</option>
                                            <option value="MD" <?=$rowU['vpn_country']=='MD'?'selected':'' ?>>Moldova, Republic of</option>
                                            <option value="MC" <?=$rowU['vpn_country']=='MC'?'selected':'' ?>>Monaco</option>
                                            <option value="MN" <?=$rowU['vpn_country']=='MN'?'selected':'' ?>>Mongolia</option>
                                            <option value="ME" <?=$rowU['vpn_country']=='ME'?'selected':'' ?>>Montenegro</option>
                                            <option value="MS" <?=$rowU['vpn_country']=='MS'?'selected':'' ?>>Montserrat</option>
                                            <option value="MA" <?=$rowU['vpn_country']=='MA'?'selected':'' ?>>Morocco</option>
                                            <option value="MZ" <?=$rowU['vpn_country']=='MZ'?'selected':'' ?>>Mozambique</option>
                                            <option value="MM" <?=$rowU['vpn_country']=='MM'?'selected':'' ?>>Myanmar</option>
                                            <option value="NA" <?=$rowU['vpn_country']=='NA'?'selected':'' ?>>Namibia</option>
                                            <option value="NR" <?=$rowU['vpn_country']=='NR'?'selected':'' ?>>Nauru</option>
                                            <option value="NP" <?=$rowU['vpn_country']=='NP'?'selected':'' ?>>Nepal</option>
                                            <option value="NL" <?=$rowU['vpn_country']=='NL'?'selected':'' ?>>Netherlands</option>
                                            <option value="NC" <?=$rowU['vpn_country']=='NC'?'selected':'' ?>>New Caledonia</option>
                                            <option value="NZ" <?=$rowU['vpn_country']=='NZ'?'selected':'' ?>>New Zealand</option>
                                            <option value="NI" <?=$rowU['vpn_country']=='NI'?'selected':'' ?>>Nicaragua</option>
                                            <option value="NE" <?=$rowU['vpn_country']=='NE'?'selected':'' ?>>Niger</option>
                                            <option value="NG" <?=$rowU['vpn_country']=='NG'?'selected':'' ?>>Nigeria</option>
                                            <option value="NU" <?=$rowU['vpn_country']=='NU'?'selected':'' ?>>Niue</option>
                                            <option value="NF" <?=$rowU['vpn_country']=='NF'?'selected':'' ?>>Norfolk Island</option>
                                            <option value="MP" <?=$rowU['vpn_country']=='MP'?'selected':'' ?>>Northern Mariana Islands</option>
                                            <option value="NO" <?=$rowU['vpn_country']=='NO'?'selected':'' ?>>Norway</option>
                                            <option value="OM" <?=$rowU['vpn_country']=='OM'?'selected':'' ?>>Oman</option>
                                            <option value="PK" <?=$rowU['vpn_country']=='PK'?'selected':'' ?>>Pakistan</option>
                                            <option value="PW" <?=$rowU['vpn_country']=='PW'?'selected':'' ?>>Palau</option>
                                            <option value="PS" <?=$rowU['vpn_country']=='PS'?'selected':'' ?>>Palestinian Territory, Occupied</option>
                                            <option value="PA" <?=$rowU['vpn_country']=='PA'?'selected':'' ?>>Panama</option>
                                            <option value="PG" <?=$rowU['vpn_country']=='PG'?'selected':'' ?>>Papua New Guinea</option>
                                            <option value="PY" <?=$rowU['vpn_country']=='PY'?'selected':'' ?>>Paraguay</option>
                                            <option value="PE" <?=$rowU['vpn_country']=='PE'?'selected':'' ?>>Peru</option>
                                            <option value="PH" <?=$rowU['vpn_country']=='PH'?'selected':'' ?>>Philippines</option>
                                            <option value="PN" <?=$rowU['vpn_country']=='PN'?'selected':'' ?>>Pitcairn</option>
                                            <option value="PL" <?=$rowU['vpn_country']=='PL'?'selected':'' ?>>Poland</option>
                                            <option value="PT" <?=$rowU['vpn_country']=='PT'?'selected':'' ?>>Portugal</option>
                                            <option value="PR" <?=$rowU['vpn_country']=='PR'?'selected':'' ?>>Puerto Rico</option>
                                            <option value="QA" <?=$rowU['vpn_country']=='QA'?'selected':'' ?>>Qatar</option>
                                            <option value="RE" <?=$rowU['vpn_country']=='RE'?'selected':'' ?>>Réunion</option>
                                            <option value="RO" <?=$rowU['vpn_country']=='RO'?'selected':'' ?>>Romania</option>
                                            <option value="RU" <?=$rowU['vpn_country']=='RU'?'selected':'' ?>>Russian Federation</option>
                                            <option value="RW" <?=$rowU['vpn_country']=='RW'?'selected':'' ?>>Rwanda</option>
                                            <option value="BL" <?=$rowU['vpn_country']=='BL'?'selected':'' ?>>Saint Barthélemy</option>
                                            <option value="SH" <?=$rowU['vpn_country']=='SH'?'selected':'' ?>>Saint Helena, Ascension and Tristan da Cunha</option>
                                            <option value="KN" <?=$rowU['vpn_country']=='KN'?'selected':'' ?>>Saint Kitts and Nevis</option>
                                            <option value="LC" <?=$rowU['vpn_country']=='LC'?'selected':'' ?>>Saint Lucia</option>
                                            <option value="MF" <?=$rowU['vpn_country']=='MF'?'selected':'' ?>>Saint Martin (French part)</option>
                                            <option value="PM" <?=$rowU['vpn_country']=='PM'?'selected':'' ?>>Saint Pierre and Miquelon</option>
                                            <option value="VC" <?=$rowU['vpn_country']=='VC'?'selected':'' ?>>Saint Vincent and the Grenadines</option>
                                            <option value="WS" <?=$rowU['vpn_country']=='WS'?'selected':'' ?>>Samoa</option>
                                            <option value="SM" <?=$rowU['vpn_country']=='SM'?'selected':'' ?>>San Marino</option>
                                            <option value="ST" <?=$rowU['vpn_country']=='ST'?'selected':'' ?>>Sao Tome and Principe</option>
                                            <option value="SA" <?=$rowU['vpn_country']=='SA'?'selected':'' ?>>Saudi Arabia</option>
                                            <option value="SN" <?=$rowU['vpn_country']=='SN'?'selected':'' ?>>Senegal</option>
                                            <option value="RS" <?=$rowU['vpn_country']=='RS'?'selected':'' ?>>Serbia</option>
                                            <option value="SC" <?=$rowU['vpn_country']=='SC'?'selected':'' ?>>Seychelles</option>
                                            <option value="SL" <?=$rowU['vpn_country']=='SL'?'selected':'' ?>>Sierra Leone</option>
                                            <option value="SG" <?=$rowU['vpn_country']=='SG'?'selected':'' ?>>Singapore</option>
                                            <option value="SX" <?=$rowU['vpn_country']=='SX'?'selected':'' ?>>Sint Maarten (Dutch part)</option>
                                            <option value="SK" <?=$rowU['vpn_country']=='SK'?'selected':'' ?>>Slovakia</option>
                                            <option value="SI" <?=$rowU['vpn_country']=='SI'?'selected':'' ?>>Slovenia</option>
                                            <option value="SB" <?=$rowU['vpn_country']=='SB'?'selected':'' ?>>Solomon Islands</option>
                                            <option value="SO" <?=$rowU['vpn_country']=='SO'?'selected':'' ?>>Somalia</option>
                                            <option value="ZA" <?=$rowU['vpn_country']=='ZA'?'selected':'' ?>>South Africa</option>
                                            <option value="GS" <?=$rowU['vpn_country']=='GS'?'selected':'' ?>>South Georgia and the South Sandwich Islands</option>
                                            <option value="SS" <?=$rowU['vpn_country']=='SS'?'selected':'' ?>>South Sudan</option>
                                            <option value="ES" <?=$rowU['vpn_country']=='ES'?'selected':'' ?>>Spain</option>
                                            <option value="LK" <?=$rowU['vpn_country']=='LK'?'selected':'' ?>>Sri Lanka</option>
                                            <option value="SD" <?=$rowU['vpn_country']=='SD'?'selected':'' ?>>Sudan</option>
                                            <option value="SR" <?=$rowU['vpn_country']=='SR'?'selected':'' ?>>Suriname</option>
                                            <option value="SJ" <?=$rowU['vpn_country']=='SJ'?'selected':'' ?>>Svalbard and Jan Mayen</option>
                                            <option value="SZ" <?=$rowU['vpn_country']=='SZ'?'selected':'' ?>>Swaziland</option>
                                            <option value="SE" <?=$rowU['vpn_country']=='SE'?'selected':'' ?>>Sweden</option>
                                            <option value="CH" <?=$rowU['vpn_country']=='CH'?'selected':'' ?>>Switzerland</option>
                                            <option value="SY" <?=$rowU['vpn_country']=='SY'?'selected':'' ?>>Syrian Arab Republic</option>
                                            <option value="TW" <?=$rowU['vpn_country']=='TW'?'selected':'' ?>>Taiwan, Province of China</option>
                                            <option value="TJ" <?=$rowU['vpn_country']=='TJ'?'selected':'' ?>>Tajikistan</option>
                                            <option value="TZ" <?=$rowU['vpn_country']=='TZ'?'selected':'' ?>>Tanzania, United Republic of</option>
                                            <option value="TH" <?=$rowU['vpn_country']=='TH'?'selected':'' ?>>Thailand</option>
                                            <option value="TL" <?=$rowU['vpn_country']=='TL'?'selected':'' ?>>Timor-Leste</option>
                                            <option value="TG" <?=$rowU['vpn_country']=='TG'?'selected':'' ?>>Togo</option>
                                            <option value="TK" <?=$rowU['vpn_country']=='TK'?'selected':'' ?>>Tokelau</option>
                                            <option value="TO" <?=$rowU['vpn_country']=='TO'?'selected':'' ?>>Tonga</option>
                                            <option value="TT" <?=$rowU['vpn_country']=='TT'?'selected':'' ?>>Trinidad and Tobago</option>
                                            <option value="TN" <?=$rowU['vpn_country']=='TN'?'selected':'' ?>>Tunisia</option>
                                            <option value="TR" <?=$rowU['vpn_country']=='TR'?'selected':'' ?>>Turkey</option>
                                            <option value="TM" <?=$rowU['vpn_country']=='TM'?'selected':'' ?>>Turkmenistan</option>
                                            <option value="TC" <?=$rowU['vpn_country']=='TC'?'selected':'' ?>>Turks and Caicos Islands</option>
                                            <option value="TV" <?=$rowU['vpn_country']=='TV'?'selected':'' ?>>Tuvalu</option>
                                            <option value="UG" <?=$rowU['vpn_country']=='UG'?'selected':'' ?>>Uganda</option>
                                            <option value="UA" <?=$rowU['vpn_country']=='UA'?'selected':'' ?>>Ukraine</option>
                                            <option value="AE" <?=$rowU['vpn_country']=='AE'?'selected':'' ?>>United Arab Emirates</option>
                                            <option value="GB" <?=$rowU['vpn_country']=='GB'?'selected':'' ?>>United Kingdom</option>
                                            <option value="US" <?=$rowU['vpn_country']=='US'?'selected':'' ?>>United States</option>
                                            <option value="UM" <?=$rowU['vpn_country']=='UM'?'selected':'' ?>>United States Minor Outlying Islands</option>
                                            <option value="UY" <?=$rowU['vpn_country']=='UY'?'selected':'' ?>>Uruguay</option>
                                            <option value="UZ" <?=$rowU['vpn_country']=='UZ'?'selected':'' ?>>Uzbekistan</option>
                                            <option value="VU" <?=$rowU['vpn_country']=='VU'?'selected':'' ?>>Vanuatu</option>
                                            <option value="VE" <?=$rowU['vpn_country']=='VE'?'selected':'' ?>>Venezuela, Bolivarian Republic of</option>
                                            <option value="VN" <?=$rowU['vpn_country']=='VN'?'selected':'' ?>>Viet Nam</option>
                                            <option value="VG" <?=$rowU['vpn_country']=='VG'?'selected':'' ?>>Virgin Islands, British</option>
                                            <option value="VI" <?=$rowU['vpn_country']=='VI'?'selected':'' ?>>Virgin Islands, U.S.</option>
                                            <option value="WF" <?=$rowU['vpn_country']=='WF'?'selected':'' ?>>Wallis and Futuna</option>
                                            <option value="EH" <?=$rowU['vpn_country']=='EH'?'selected':'' ?>>Western Sahara</option>
                                            <option value="YE" <?=$rowU['vpn_country']=='YE'?'selected':'' ?>>Yemen</option>
                                            <option value="ZM" <?=$rowU['vpn_country']=='ZM'?'selected':'' ?>>Zambia</option>
                                            <option value="ZW" <?=$rowU['vpn_country']=='ZW'?'selected':'' ?>>Zimbabwe</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <center>
                                        <button class="btn btn-info " name="submitU" type="submit">
                                            <i class="icon icon-check"></i> Submit
                                        </button>
                                    </center>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
<?php
 }else{
//main table/form
	 ?>
        <div class="col-md-12 mx-auto">
            <div class="card-body">
                <div class="card bg-primary text-white">
                    <div class="card-header card-header-warning">
                        <center>
                            <h2><i class="icon icon-commenting"></i><?php echo $Htitle ?></h2>
                        </center>
                    </div>

                    <div class="card-body">
                        <div class="col-12">
                        	<center>
	        					<a id="button" href="./<?php echo $base_file ?>?create" class="btn btn-info">New OVPN Sever</a>
	        				</center>
    					</div>

    					<hr>

						<div class="table-responsive">
							<table class="table table-striped table-sm">
							<thead style="color:white!important">
								<tr>
								<th>Index</th>
								<th>Country</th>
								<th>State</th>
								<th>OVPN Url</th>
								<th>Status</th>
								<th>Auth Type</th>
								<th>Username</th>
								<th>Password</th>
								<th>Date</th>
								<th>Edit&nbsp&nbsp&nbspDelete</th>
								</tr>
							</thead>
							<?php while ($row = $res->fetchArray()) {?>
							<tbody>
								<tr>
								<td><?=$row['id'] ?></td>
								<td><?=$row['vpn_country'] ?></td>
								<td><?=$row['vpn_state'] ?></td>
								<td><?=$row['vpn_config'] ?></td>
								<td><?=$row['vpn_status'] ?></td>
								<td><?=$row['auth_type'] ?></td>
								<td><?=$row['username'] ?></td>
								<td><?=$row['password'] ?></td>
								<td><?=$row['date'] ?></td>
								<td>
								<a class="btn btn-info btn-ok" href="./<?php echo $base_file ?>?update=<?=$row['id'] ?>"><i class="fa fa-pencil-square-o"></i></a>
								&nbsp&nbsp&nbsp
								<a class="btn btn-danger btn-ok" href="#" data-href="./<?php echo $base_file ?>?delete=<?=$row['id'] ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
								</td>
								</tr>
							</tbody>
							<?php }?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php }?>

<?php include ('includes/footer.php');?>

</body>
</html>