<?php $__env->startSection('body'); ?>
    <div class="page-content-wrapper">
        <div class="page-content">

            <h3 class="page-title uppercase bold"> <?php echo e($page_title); ?>


            </h3>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption uppercase bold">
                                <i class="fa fa-user"></i> PROFILE </div>
                        </div>
                        <div class="portlet-body text-center" style="overflow:hidden;">
                            <?php if( $user->image == null): ?>
                                <img src=" <?php echo e(url('assets/user/images/user-default.png')); ?> " class="img-responsive propic" alt="Profile Pic">
                            <?php else: ?>
                                <img src=" <?php echo e(url('assets/images/user/'.$user->image)); ?> " class="img-responsive propic" alt="Profile Pic">
                            <?php endif; ?>


                            <hr><h4 class="bold">User Name : <?php echo e($user->username); ?></h4>
                            <h4 class="bold">Name : <?php echo e($user->name); ?></h4>
                            <h4 class="bold">BALANCE : <?php echo e(number_format(floatval($user->balance), $basic->decimal, '.', '')); ?> <?php echo e($basic->currency); ?></h4>
                            <hr>
                            <p>
                                <strong>Last Login : <?php if($user->login_time != ''): ?> <?php echo e(Carbon\Carbon::parse($user->login_time)->diffForHumans()); ?> <?php else: ?> Never <?php endif; ?></strong> <br>
                            </p>
                            <hr>
                            <?php if($last_login != null): ?>
                                <p>
                                    <strong>Last Login From</strong> <br> <?php if($user->login_time != ''): ?> <?php echo e($last_login->user_ip); ?> -  <?php echo e($last_login->location); ?> <br> Using <?php echo e($last_login->details); ?> <br><?php else: ?> Never <?php endif; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>



                <div class="col-md-9">
                    <div class="portlet light bordered">

                        <div class="portlet-body">
                            <div class="row">
                                <div class="portlet box purple">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-desktop"></i>Details
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">

                                            <!-- START -->
                                            <a href="<?php echo e(route('user.trans',$user->id)); ?>">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                                    <div class="dashboard-stat blue">
                                                        <div class="visual">
                                                            <i class="fa fa-th"></i>
                                                        </div>
                                                        <div class="details">
                                                            <div class="number">
                                                                <?php
                                                                $trans = \App\Deposit::whereUser_id($user->id)->count();
                                                                $transAmount = \App\Deposit::whereUser_id($user->id)->sum('amount');

                                                                $deposit = \App\Deposit::whereUser_id($user->id)->whereStatus(1)->count();
                                                                $depositAmount = \App\Deposit::whereUser_id($user->id)->whereStatus(1)->sum('amount');

                                                                $withDraw = \App\WithdrawLog::whereUser_id($user->id)->count();
                                                                $withDrawAmount = \App\WithdrawLog::whereUser_id($user->id)->sum('amount');

                                                                ?>
                                                                <span data-counter="counterup" data-value="<?php echo e($trans); ?>"><?php echo e($trans); ?></span>
                                                            </div>
                                                            <div class="desc uppercase">  TRANSACTED</div>
                                                        </div>
                                                        <div class="more">
                                                            <div class="desc uppercase bold text-center">
                                                                <?php echo e($basic->currency); ?>

                                                                <span data-counter="counterup" data-value="<?php echo e($transAmount); ?>"><?php echo e($transAmount); ?></span> TRANSACTED
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- END -->
                                            <!-- START -->
                                            <a href="<?php echo e(route('user.deposit',$user->id)); ?>">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                                    <div class="dashboard-stat yellow">
                                                        <div class="visual">
                                                            <i class="fa fa-download"></i>
                                                        </div>
                                                        <div class="details">
                                                            <div class="number">
                                                                <span data-counter="counterup" data-value="<?php echo e($deposit); ?>"><?php echo e($deposit); ?></span>
                                                            </div>
                                                            <div class="desc uppercase"> Deposits </div>
                                                        </div>
                                                        <div class="more">
                                                            <div class="desc uppercase bold text-center">
                                                                <?php echo e($basic->currency); ?>

                                                                <span data-counter="counterup" data-value="<?php echo e($depositAmount); ?>"><?php echo e($depositAmount); ?></span> Deposited
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- END -->
                                            <!-- START -->
                                            <a href="<?php echo e(route('user.withdraw',$user->id)); ?>">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
                                                    <div class="dashboard-stat red">
                                                        <div class="visual">
                                                            <i class="fa fa-upload"></i>
                                                        </div>
                                                        <div class="details">
                                                            <div class="number">
                                                                <span data-counter="counterup" data-value="<?php echo e($withDraw); ?>"><?php echo e($withDraw); ?></span>
                                                            </div>
                                                            <div class="desc uppercase"> WITHDRAW REQUEST </div>
                                                        </div>
                                                        <div class="more">
                                                            <div class="desc uppercase bold text-center">
                                                                <?php echo e($basic->currency); ?>

                                                                <span data-counter="counterup" data-value="<?php echo e($withDrawAmount); ?>"><?php echo e($withDrawAmount); ?></span> WITHDRAWN
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <!-- END -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="portlet box blue-ebonyclay">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i>Operations
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="<?php echo e(route('user.balance',$user->id)); ?>" class="btn btn-lg btn-block btn-success" ><i class="fa fa-money"></i> Add/Substract Balance</a>
                                                <br>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="<?php echo e(route('user.login.history',$user->id)); ?>" class="btn btn-lg btn-block btn-success" ><i class="fa fa-sign-out"></i> Login History</a>
                                                <br>
                                            </div>

                                            <div class="col-md-6">
                                                <a href="<?php echo e(route('user.email',$user->id)); ?>" class="btn btn-lg btn-block btn-primary" style="margin-bottom:10px;"> <i class="fa fa-envelope"></i> Send Email</a>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#changepass"> <i class="fa fa-lock"></i> Change Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i>Update Profile</div>
                                    </div>
                                    <div class="portlet-body">
                                        <form id="form" method="POST" action="<?php echo e(route('user.status', $user->id)); ?>" enctype="multipart/form-data" name="editForm">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('put')); ?>


                                            <div class="row">
                                                <div class="form-group col-md-6 <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                                    <label> <strong>Name</strong></label>
                                                    <input type="text" name="name" class="form-control input-lg" value="<?php echo e($user->name); ?>">
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="help-block">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group col-md-6 <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                                    <label><strong>Phone</strong></label>
                                                    <input type="text" name="phone" class="form-control input-lg" value="<?php echo e($user->phone); ?>">
                                                    <?php if($errors->has('phone')): ?>
                                                        <span class="help-block">
                                                <strong><?php echo e($errors->first('phone')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>


                                            <div class="row">


                                                <div class="form-group col-md-6 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                    <label><strong>Email</strong></label>
                                                    <input type="email" name="email" class="form-control input-lg" value="<?php echo e($user->email); ?>">
                                                    <?php if($errors->has('email')): ?>
                                                        <span class="help-block">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="form-group col-md-6 ">
                                                    <label><strong>Country</strong></label>

                                                    <select name="country"
                                                            class="form-control select input-lg"
                                                            id="country">
                                                        <option value="">Select Country</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="Afghanistan">Afghanistan</option>
                                                        <option value="Albania">Albania</option>
                                                        <option value="Algeria">Algeria</option>
                                                        <option value="American Samoa">American Samoa</option>
                                                        <option value="Andorra">Andorra</option>
                                                        <option value="Angola">Angola</option>
                                                        <option value="Anguilla">Anguilla</option>
                                                        <option value="Antarctica">Antarctica</option>
                                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                        <option value="Argentina">Argentina</option>
                                                        <option value="Armenia">Armenia</option>
                                                        <option value="Aruba">Aruba</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Austria">Austria</option>
                                                        <option value="Azerbaijan">Azerbaijan</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                        <option value="Bahrain">Bahrain</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Barbados">Barbados</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Belgium">Belgium</option>
                                                        <option value="Belize">Belize</option>
                                                        <option value="Benin">Benin</option>
                                                        <option value="Bermuda">Bermuda</option>
                                                        <option value="Bhutan">Bhutan</option>
                                                        <option value="Bolivia">Bolivia</option>
                                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                        <option value="Botswana">Botswana</option>
                                                        <option value="Bouvet Island">Bouvet Island</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="British Indian Ocean Territory">British Indian Ocean
                                                            Territory
                                                        </option>
                                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                        <option value="Bulgaria">Bulgaria</option>
                                                        <option value="Burkina Faso">Burkina Faso</option>
                                                        <option value="Burundi">Burundi</option>
                                                        <option value="Cambodia">Cambodia</option>
                                                        <option value="Cameroon">Cameroon</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Cape Verde">Cape Verde</option>
                                                        <option value="Cayman Islands">Cayman Islands</option>
                                                        <option value="Central African Republic">Central African Republic
                                                        </option>
                                                        <option value="Chad">Chad</option>
                                                        <option value="Chile">Chile</option>
                                                        <option value="China">China</option>
                                                        <option value="Christmas Island">Christmas Island</option>
                                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                        <option value="Colombia">Colombia</option>
                                                        <option value="Comoros">Comoros</option>
                                                        <option value="Congo">Congo</option>
                                                        <option value="Congo, The Democratic Republic of The">Congo, The
                                                            Democratic
                                                            Republic of The
                                                        </option>
                                                        <option value="Cook Islands">Cook Islands</option>
                                                        <option value="Costa Rica">Costa Rica</option>
                                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                        <option value="Croatia">Croatia</option>
                                                        <option value="Cuba">Cuba</option>
                                                        <option value="Cyprus">Cyprus</option>
                                                        <option value="Czech Republic">Czech Republic</option>
                                                        <option value="Denmark">Denmark</option>
                                                        <option value="Djibouti">Djibouti</option>
                                                        <option value="Dominica">Dominica</option>
                                                        <option value="Dominican Republic">Dominican Republic</option>
                                                        <option value="Ecuador">Ecuador</option>
                                                        <option value="Egypt">Egypt</option>
                                                        <option value="El Salvador">El Salvador</option>
                                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                        <option value="Eritrea">Eritrea</option>
                                                        <option value="Estonia">Estonia</option>
                                                        <option value="Ethiopia">Ethiopia</option>
                                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)
                                                        </option>
                                                        <option value="Faroe Islands">Faroe Islands</option>
                                                        <option value="Fiji">Fiji</option>
                                                        <option value="Finland">Finland</option>
                                                        <option value="France">France</option>
                                                        <option value="French Guiana">French Guiana</option>
                                                        <option value="French Polynesia">French Polynesia</option>
                                                        <option value="French Southern Territories">French Southern Territories
                                                        </option>
                                                        <option value="Gabon">Gabon</option>
                                                        <option value="Gambia">Gambia</option>
                                                        <option value="Georgia">Georgia</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="Ghana">Ghana</option>
                                                        <option value="Gibraltar">Gibraltar</option>
                                                        <option value="Greece">Greece</option>
                                                        <option value="Greenland">Greenland</option>
                                                        <option value="Grenada">Grenada</option>
                                                        <option value="Guadeloupe">Guadeloupe</option>
                                                        <option value="Guam">Guam</option>
                                                        <option value="Guatemala">Guatemala</option>
                                                        <option value="Guinea">Guinea</option>
                                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                                        <option value="Guyana">Guyana</option>
                                                        <option value="Haiti">Haiti</option>
                                                        <option value="Heard Island and Mcdonald Islands">Heard Island and
                                                            Mcdonald
                                                            Islands
                                                        </option>
                                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City
                                                            State)
                                                        </option>
                                                        <option value="Honduras">Honduras</option>
                                                        <option value="Hong Kong">Hong Kong</option>
                                                        <option value="Hungary">Hungary</option>
                                                        <option value="Iceland">Iceland</option>
                                                        <option value="India">India</option>
                                                        <option value="Indonesia">Indonesia</option>
                                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of
                                                        </option>
                                                        <option value="Iraq">Iraq</option>
                                                        <option value="Ireland">Ireland</option>
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Jamaica">Jamaica</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Jordan">Jordan</option>
                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                        <option value="Kenya">Kenya</option>
                                                        <option value="Kiribati">Kiribati</option>
                                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic
                                                            People's Republic of
                                                        </option>
                                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                                        <option value="Kuwait">Kuwait</option>
                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                        <option value="Lao People's Democratic Republic">Lao People's Democratic
                                                            Republic
                                                        </option>
                                                        <option value="Latvia">Latvia</option>
                                                        <option value="Lebanon">Lebanon</option>
                                                        <option value="Lesotho">Lesotho</option>
                                                        <option value="Liberia">Liberia</option>
                                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                        <option value="Liechtenstein">Liechtenstein</option>
                                                        <option value="Lithuania">Lithuania</option>
                                                        <option value="Luxembourg">Luxembourg</option>
                                                        <option value="Macao">Macao</option>
                                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia,
                                                            The
                                                            Former Yugoslav Republic of
                                                        </option>
                                                        <option value="Madagascar">Madagascar</option>
                                                        <option value="Malawi">Malawi</option>
                                                        <option value="Malaysia">Malaysia</option>
                                                        <option value="Maldives">Maldives</option>
                                                        <option value="Mali">Mali</option>
                                                        <option value="Malta">Malta</option>
                                                        <option value="Marshall Islands">Marshall Islands</option>
                                                        <option value="Martinique">Martinique</option>
                                                        <option value="Mauritania">Mauritania</option>
                                                        <option value="Mauritius">Mauritius</option>
                                                        <option value="Mayotte">Mayotte</option>
                                                        <option value="Mexico">Mexico</option>
                                                        <option value="Micronesia, Federated States of">Micronesia, Federated
                                                            States
                                                            of
                                                        </option>
                                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                        <option value="Monaco">Monaco</option>
                                                        <option value="Mongolia">Mongolia</option>
                                                        <option value="Montserrat">Montserrat</option>
                                                        <option value="Morocco">Morocco</option>
                                                        <option value="Mozambique">Mozambique</option>
                                                        <option value="Myanmar">Myanmar</option>
                                                        <option value="Namibia">Namibia</option>
                                                        <option value="Nauru">Nauru</option>
                                                        <option value="Nepal">Nepal</option>
                                                        <option value="Netherlands">Netherlands</option>
                                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                        <option value="New Caledonia">New Caledonia</option>
                                                        <option value="New Zealand">New Zealand</option>
                                                        <option value="Nicaragua">Nicaragua</option>
                                                        <option value="Niger">Niger</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                        <option value="Niue">Niue</option>
                                                        <option value="Norfolk Island">Norfolk Island</option>
                                                        <option value="Northern Mariana Islands">Northern Mariana Islands
                                                        </option>
                                                        <option value="Norway">Norway</option>
                                                        <option value="Oman">Oman</option>
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="Palau">Palau</option>
                                                        <option value="Palestinian Territory, Occupied">Palestinian Territory,
                                                            Occupied
                                                        </option>
                                                        <option value="Panama">Panama</option>
                                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                                        <option value="Paraguay">Paraguay</option>
                                                        <option value="Peru">Peru</option>
                                                        <option value="Philippines">Philippines</option>
                                                        <option value="Pitcairn">Pitcairn</option>
                                                        <option value="Poland">Poland</option>
                                                        <option value="Portugal">Portugal</option>
                                                        <option value="Puerto Rico">Puerto Rico</option>
                                                        <option value="Qatar">Qatar</option>
                                                        <option value="Reunion">Reunion</option>
                                                        <option value="Romania">Romania</option>
                                                        <option value="Russian Federation">Russian Federation</option>
                                                        <option value="Rwanda">Rwanda</option>
                                                        <option value="Saint Helena">Saint Helena</option>
                                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                        <option value="Saint Lucia">Saint Lucia</option>
                                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon
                                                        </option>
                                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The
                                                            Grenadines
                                                        </option>
                                                        <option value="Samoa">Samoa</option>
                                                        <option value="San Marino">San Marino</option>
                                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                                        <option value="Senegal">Senegal</option>
                                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                                        <option value="Seychelles">Seychelles</option>
                                                        <option value="Sierra Leone">Sierra Leone</option>
                                                        <option value="Singapore">Singapore</option>
                                                        <option value="Slovakia">Slovakia</option>
                                                        <option value="Slovenia">Slovenia</option>
                                                        <option value="Solomon Islands">Solomon Islands</option>
                                                        <option value="Somalia">Somalia</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="South Georgia and The South Sandwich Islands">South
                                                            Georgia
                                                            and The South Sandwich Islands
                                                        </option>
                                                        <option value="Spain">Spain</option>
                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                        <option value="Sudan">Sudan</option>
                                                        <option value="Suriname">Suriname</option>
                                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                        <option value="Swaziland">Swaziland</option>
                                                        <option value="Sweden">Sweden</option>
                                                        <option value="Switzerland">Switzerland</option>
                                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                        <option value="Taiwan, Province of China">Taiwan, Province of China
                                                        </option>
                                                        <option value="Tajikistan">Tajikistan</option>
                                                        <option value="Tanzania, United Republic of">Tanzania, United Republic
                                                            of
                                                        </option>
                                                        <option value="Thailand">Thailand</option>
                                                        <option value="Timor-leste">Timor-leste</option>
                                                        <option value="Togo">Togo</option>
                                                        <option value="Tokelau">Tokelau</option>
                                                        <option value="Tonga">Tonga</option>
                                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                        <option value="Tunisia">Tunisia</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="Turkmenistan">Turkmenistan</option>
                                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands
                                                        </option>
                                                        <option value="Tuvalu">Tuvalu</option>
                                                        <option value="Uganda">Uganda</option>
                                                        <option value="Ukraine">Ukraine</option>
                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United States Minor Outlying Islands">United States Minor
                                                            Outlying Islands
                                                        </option>
                                                        <option value="Uruguay">Uruguay</option>
                                                        <option value="Uzbekistan">Uzbekistan</option>
                                                        <option value="Vanuatu">Vanuatu</option>
                                                        <option value="Venezuela">Venezuela</option>
                                                        <option value="Viet Nam">Viet Nam</option>
                                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                        <option value="Western Sahara">Western Sahara</option>
                                                        <option value="Yemen">Yemen</option>
                                                        <option value="Zambia">Zambia</option>
                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                    </select>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label>User Status</label>
                                                    <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Active" data-off="Deactive" type="checkbox" value="1" name="status" <?php echo e($user->status == "1" ? 'checked' : ''); ?>>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Email Verification</label>
                                                    <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No" type="checkbox" value="1" name="email_verify" <?php echo e($user->email_verify == "1" ? 'checked' : ''); ?>>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Phone Verification</label>
                                                    <input class="form-control" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No" type="checkbox" value="1" name="phone_verify" <?php echo e($user->phone_verify == "1" ? 'checked' : ''); ?>>
                                                </div>
                                            </div>
                                            <hr/>
                                            <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal for Edit button -->
    <div id="changepass" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><strong>Change Password</strong> </h4>
            </div>
            <div class="modal-body">
            <form role="form" method="POST" action="<?php echo e(route('user.passchange', $user->id)); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('put')); ?>


                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label for="password" class="control-label"><strong>Password</strong></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Passowrd" required>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                    <label for="password-confirm" class="control-label"><strong>Confirm Password</strong></label>
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Passowrd" name="password_confirmation" required>
                    <?php if($errors->has('password_confirmation')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Change Password
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        document.forms['editForm'].elements['country'].value = "<?php echo e($user->country); ?>"
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>